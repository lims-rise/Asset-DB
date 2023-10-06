<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    require 'vendor/autoload.php';
    
    // use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    use Google\Client as google_client;
    use Google\Service\Drive as google_drive;


class Reports extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Reports_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        
        // $cat_id = $this->input->get('cat_id', TRUE);
        // $data = array(
        //     'category_id' => $cat_id,
        //     'sub_category_id' => set_value('sub_category_id'),
	    // );

        $this->template->load('template','reports/reports_list');
    } 
    
    public function json() {
        $date1=$this->input->get('date1');
        $date2=$this->input->get('date2');
        $cat=$this->input->get('cat');
        $subcat=$this->input->get('subcat');
        $fund=$this->input->get('fund');
        $loc=$this->input->get('loc');
        $con=$this->input->get('con');
        header('Content-Type: application/json');
        echo $this->Reports_model->json($date1,$date2,$cat,$fund,$loc,$con,$subcat);
    }

    public function read($id) 
    {
        $row = $this->Reports_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'name' => $row->name,
	    );
            $this->template->load('template','reports/reports_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('reports'));
        }
    }

    public function create() 
    {
        $cat_id = $this->input->get('cat_id', TRUE);
        $data = array(
            // 'button' => 'Create',
            // 'action' => site_url('reports/create_action'),
            'category_id' => $cat_id,
            // 'sub_category_id' => set_value('sub_category_id'),
            // 'fund_id' => set_value('fund_id'),
            // 'location_det_id' => set_value('loc_det_name'),
            // 'condition_id' => set_value('condition_id'),
	 
	);
        $this->template->load('template','reports/reports_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'status' => 1,
		'created_at' => date('Y-m-d H:i:s'),
		'created_by' => $this->session->userdata('id_users'),
	    );

            $this->Reports_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('reports'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Reports_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('reports/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
	    );
            $this->template->load('template','reports/reports_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('reports'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
	    );

            $this->Reports_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('reports'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Reports_model->get_by_id($id);

        if ($row) {
            $this->Reports_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('reports'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('reports'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }



    public function excel()
	{
        /* Data */
        $date1=$this->input->get('date1');
        $date2=$this->input->get('date2');
        $cat=$this->input->get('cat');
        $subcat=$this->input->get('subcat');
        $fund=$this->input->get('fund');
        $loc=$this->input->get('loc');
        $con=$this->input->get('con');
        $data = $this->Reports_model->get_report($date1,$date2,$cat,$fund,$loc,$con,$subcat);

        /* Spreadsheet Init */
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $hcolumn = 'A';
        $hrow = 1;

        //logo
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Monash');
        $drawing->setDescription('Monash');
        $drawing->setPath('image/monash.png'); // put your path and image here
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(10);
        // $drawing->setRotation(25);
        // $drawing->getShadow()->setVisible(true);
        // $drawing->getShadow()->setDirection(45);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Monash2');
        $drawing->setDescription('Monash2');
        $drawing->setPath('image/rise.png'); // put your path and image here
        $drawing->setCoordinates('P1');
        $drawing->setOffsetX(10);
        // $drawing->setRotation(25);
        // $drawing->getShadow()->setVisible(true);
        // $drawing->getShadow()->setDirection(45);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        
        $sheet->setCellValue('B6', "Fixed Inventory List");
        $sheet->setCellValue('P6', "RISE - " . date('Y-m-d'));

        /* Excel Header */
        $start = 8;
        $sheet->setCellValue($hcolumn++ . $start, "No");
        $sheet->setCellValue($hcolumn++ . $start, "Inventory_number");
        $sheet->setCellValue($hcolumn++ . $start, "Name");
        $sheet->setCellValue($hcolumn++ . $start, "Description");
        $sheet->setCellValue($hcolumn++ . $start, "Type/Model");
        $sheet->setCellValue($hcolumn++ . $start, "Serial_number");
        $sheet->setCellValue($hcolumn++ . $start, "Purchase_date");
        $sheet->setCellValue($hcolumn++ . $start, "Purchase_price");
        $sheet->setCellValue($hcolumn++ . $start, "Category");
        $sheet->setCellValue($hcolumn++ . $start, "Sub_category");
        $sheet->setCellValue($hcolumn++ . $start, "Fund");
        $sheet->setCellValue($hcolumn++ . $start, "Manufacture");
        $sheet->setCellValue($hcolumn++ . $start, "Supplier");
        $sheet->setCellValue($hcolumn++ . $start, "Qty");
        $sheet->setCellValue($hcolumn++ . $start, "Location");
        $sheet->setCellValue($hcolumn++ . $start, "Location_detail");
        $sheet->setCellValue($hcolumn++ . $start, "Responsible_Person");
        $sheet->setCellValue($hcolumn++ . $start, "Condition");
        $sheet->setCellValue($hcolumn++ . $start, "Purpose");
        $sheet->setCellValue($hcolumn++ . $start, "Remark");
        
        /* Excel Data */
        $row_number = $start+1;

        foreach($data as $key => $row)
        {
            $column = 'A';
            $sheet->setCellValue($column++ .$row_number, $key+1);
            $sheet->setCellValue($column++ .$row_number, $row->inventory_number);
            $sheet->setCellValue($column++ .$row_number, $row->name);
            $sheet->setCellValue($column++ .$row_number, $row->description);
            $sheet->setCellValue($column++ .$row_number, $row->type);
            $sheet->setCellValue($column++ .$row_number, $row->serial_number);
            $sheet->setCellValue($column++ .$row_number, $row->purchase_date);
            $sheet->setCellValue($column++ .$row_number, $row->purchase_price);
            $sheet->setCellValue($column++ .$row_number, $row->category);
            $sheet->setCellValue($column++ .$row_number, $row->sub_category);
            $sheet->setCellValue($column++ .$row_number, $row->fund);
            $sheet->setCellValue($column++ .$row_number, $row->manufacture);
            $sheet->setCellValue($column++ .$row_number, $row->supplier);
            $sheet->setCellValue($column++ .$row_number, $row->qty);
            $sheet->setCellValue($column++ .$row_number, $row->location);
            $sheet->setCellValue($column++ .$row_number, $row->location_detail);
            $sheet->setCellValue($column++ .$row_number, $row->staffname);
            $sheet->setCellValue($column++ .$row_number, $row->condition);
            $sheet->setCellValue($column++ .$row_number, $row->purpose);
            $sheet->setCellValue($column++ .$row_number, $row->remark);
        
            $row_number++;
        }
        $row_number--;
        $sheet->getStyle("A8:T".$row_number)->applyFromArray(
            array(
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        // 'color' => ['argb' => '000000'],
                    ],
                ],
            )
        );

        /* Excel File Format */
        $writer = new Xlsx($spreadsheet);
        $filename = 'RISE_Inventory_Report_' . date('Ymd');
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }


    // public function excel()
    // {
    //     $date1=$this->input->get('date1');
    //     $date2=$this->input->get('date2');
    //     $cat=$this->input->get('cat');
    //     $fund=$this->input->get('fund');
    //     $loc=$this->input->get('loc');

    //     $this->load->helper('exportexcel');
    //     $namaFile = "reports.xlsx";
    //     $judul = "reports";
    //     $tablehead = 0;
    //     $tablebody = 1;
    //     $nourut = 1;
    //     //penulisan header
    //     header("Pragma: public");
    //     header("Expires: 0");
    //     header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    //     header("Content-Type: application/force-download");
    //     header("Content-Type: application/octet-stream");
    //     header("Content-Type: application/download");
    //     header("Content-Disposition: attachment;filename=" . $namaFile . "");
    //     header("Content-Transfer-Encoding: binary ");

    //     xlsBOF();

    //     $kolomhead = 0;
    //     xlsWriteLabel($tablehead, $kolomhead++, "No");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Inventory_number");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Name");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Descriptions");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Type");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Serial_number");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Purchase_date");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Purchase_price");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Category");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Sub_category");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Fund");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Manufacture");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Supplier");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Qty");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Location");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Location_detail");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Staffname");
	//     xlsWriteLabel($tablehead, $kolomhead++, "Condition");


	// foreach ($this->Reports_model->get_report($date1,$date2,$cat,$fund,$loc) as $data) {
    //         $kolombody = 0;

    //         //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
    //         xlsWriteNumber($tablebody, $kolombody++, $nourut);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->inventory_number);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->name);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->description);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->type);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->serial_number);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->purchase_date);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->purchase_price);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->category);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->sub_category);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->fund);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->manufacture);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->supplier);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->qty);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->location);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->location_detail);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->staffname);
	//         xlsWriteLabel($tablebody, $kolombody++, $data->condition);


	//     $tablebody++;
    //         $nourut++;
    //     }

    //     xlsEOF();
    //     exit();
    // }





}

/* End of file Reports.php */
/* Location: ./application/controllers/Reports.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-18 01:09:04 */
/* http://harviacode.com */