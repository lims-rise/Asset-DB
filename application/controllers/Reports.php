<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    require 'vendor/autoload.php';
    
    // use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
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

    // public function excel()
    // {
    //     $date1='0000-00-00';
    //     $date2='0000-00-00';
    //     $date1=$this->input->get('date1');
    //     $date2=$this->input->get('date2');
    //     $cat=$this->input->get('cat');
    //     $subcat=$this->input->get('subcat');
    //     $fund=$this->input->get('fund');
    //     $loc=$this->input->get('loc');
    //     $con=$this->input->get('con');

    //     $this->load->database();

    //     $spreadsheet = new Spreadsheet();

    //     $sheets = array(
    //         array(
    //             'Sample_reception',
    //             'SELECT a.inventory_number AS `Inventory_Number`, 
    //             a.description AS `Description`, 
    //             a.`name` AS `Name`, 
    //             a.type AS `Type/Model`, 
    //             a.serial_number AS `Serial_Number`, 
    //             a.purchase_date AS `Purchase_Date`, 
    //             a.purchase_price AS `Purchase_Price`, 
    //             b.`name` AS `Category`, 
    //             c.`name` AS `Sub_category`, 
    //             d.`name` AS `Fund`, 
    //             e.`name` AS `Manufacture`, 
    //             f.`name` AS `Supplier`, 
    //             g.qty AS `Qty`, 
    //             i.`name` AS `Location`, 
    //             h.`name` AS `Location_detail`, 
    //             CONCAT(i.`name`, "(", h.`name`, ")") AS `Location_all`,
    //             k.`name` AS `Responsible_Person`, 
    //             a.`status` AS `Status`, 
    //             j.`condition` AS `Condition`, 
    //             j.purpose AS `Purpose`, 
    //             j.remark AS `Remark`, 
    //             a.category_id AS `category_id`, 
    //             a.fund_id AS `fund_id`, 
    //             h.id_location AS `id_location`, 
    //             j.condition_id AS `condition_id`, 
    //             a.location_det_id AS `location_det_id`, 
    //             a.sub_category_id AS `sub_category_id`
    //             FROM item_master a
    //             LEFT JOIN item_category b ON a.category_id = b.id
    //             LEFT JOIN item_sub_category c ON a.sub_category_id = c.id
    //             LEFT JOIN item_fund d ON a.fund_id = d.id
    //             LEFT JOIN item_manufacture e ON a.manufacture_id = e.id
    //             LEFT JOIN item_supplier f ON a.supplier_id = f.id
    //             LEFT JOIN item_qty g ON a.inventory_number = g.inventory_number
    //             LEFT JOIN location_detail h ON a.location_det_id = h.id
    //             LEFT JOIN location i ON h.id_location = i.id
    //             LEFT JOIN (SELECT a.inventory_number, a.staff_id, c.max_date, a.condition_id, b.`name` AS `condition`, d.`name` AS staff, a.purpose, a.remark
    //             FROM item_transaction a
    //             LEFT JOIN item_condition b ON a.condition_id=b.id
    //             LEFT JOIN staff d ON a.staff_id=d.id 
    //             JOIN (SELECT inventory_number, MAX(transaction_at) AS max_date FROM item_transaction
    //             GROUP BY inventory_number) c ON a.inventory_number=c.inventory_number AND a.transaction_at = c.max_date
    //             GROUP BY a.inventory_number) j ON a.inventory_number=j.inventory_number
    //             LEFT JOIN staff k ON j.staff_id = k.id 
                
    //             WHERE a.`status` = 1
    //             AND a.purchase_date >= "'. $date1 . '"
    //             AND a.purchase_date <= "'. $date2 . '"
    //             AND a.category_id <= "'. $cat . '"
    //             AND a.sub_category_id <= "'. $subcat . '"
    //             AND a.fund_id <= "'. $fund . '"
    //             AND a.location_det_id <= "'. $loc . '"
    //             AND j.condition_id <= "'. $con . '"
    //                 ',
    //             array('Inventory_Number', 'Name', 'Description', 'Type/Model', 'Serial_Number', 'Purchase_Date',
    //                 'Purchase_Price', 'Category', 'Sub_category', 'Fund', 'Manufacture', 'Supplier', 'Qty', 
    //                 'Location', 'Location_detail', 'Responsible_Person', 'Condition', 'Purpose', 'Remark'), // Columns for Sheet1
    //         ),
    //         // Add more sheets as needed
    //     );
        
    //     $spreadsheet->removeSheetByIndex(0);
    //     foreach ($sheets as $sheetInfo) {
    //         // Create a new worksheet for each sheet
    //         $worksheet = $spreadsheet->createSheet();
    //         $worksheet->setTitle($sheetInfo[0]);
    
    //         // SQL query to fetch data for this sheet
    //         $sql = $sheetInfo[1];
            
    //         // Use the query builder to fetch data
    //         $query = $this->db->query($sql);
    //         $result = $query->result_array();
            
    //         // Column headers for this sheet
    //         $columns = $sheetInfo[2];
    
    //         // Add column headers
    //         $col = 1;
    //         foreach ($columns as $column) {
    //             $worksheet->setCellValueByColumnAndRow($col, 1, $column);
    //             $col++;
    //         }
    
    //         // Add data rows
    //         $row = 2;
    //         foreach ($result as $row_data) {
    //             $col = 1;
    //             foreach ($columns as $column) {
    //                 $worksheet->setCellValueByColumnAndRow($col, $row, $row_data[$column]);
    //                 $col++;
    //             }
    //             $row++;
    //         }
    //     }        
        
    //     // Create a new Xlsx writer
    //     $writer = new Xlsx($spreadsheet);
        
    //     // Set the HTTP headers to download the Excel file
    //     $datenow=date("Ymd");
    //     $filename = 'RISE_Inventory_Report_'.$datenow.'.xlsx';

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     header('Cache-Control: max-age=0');
        
    //     // Save the Excel file to the output stream
    //     $writer->save('php://output');
        
    // }


    // public function excel()
	// {
    //     /* Data */
    //     $date1=$this->input->get('date1');
    //     $date2=$this->input->get('date2');
    //     $cat=$this->input->get('cat');
    //     $subcat=$this->input->get('subcat');
    //     $fund=$this->input->get('fund');
    //     $loc=$this->input->get('loc');
    //     $con=$this->input->get('con');

    //     $spreadsheet = new Spreadsheet();    
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $sheet->setCellValue('A1', "Inventory_number");
    //     $sheet->setCellValue('B1', "Name");
    //     $sheet->setCellValue('C1', "Description");
    //     $sheet->setCellValue('D1', "Type/Model");
    //     $sheet->setCellValue('E1', "Serial_number");
    //     $sheet->setCellValue('F1', "Purchase_date");
    //     $sheet->setCellValue('G1', "Purchase_price");
    //     $sheet->setCellValue('H1', "Category");
    //     $sheet->setCellValue('I1', "Sub_category");
    //     $sheet->setCellValue('J1', "Fund");
    //     $sheet->setCellValue('K1', "Manufacture");
    //     $sheet->setCellValue('L1', "Supplier");
    //     $sheet->setCellValue('M1', "Qty");
    //     $sheet->setCellValue('N1', "Location");
    //     $sheet->setCellValue('O1', "Location_detail");
    //     $sheet->setCellValue('P1', "Responsible_Person");
    //     $sheet->setCellValue('Q1', "Condition");
    //     $sheet->setCellValue('R1', "Purpose");
    //     $sheet->setCellValue('S1', "Remark");

    //     // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

    //     // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    //     // $rdeliver = $this->DNA_extraction_model->get_all();
    //     $datax = $this->Reports_model->get_report($date1,$date2,$cat,$fund,$loc,$con,$subcat);
    
    //     // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    //     $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
    //     foreach($datax as $data){ // Lakukan looping pada variabel siswa
    //         $sheet->setCellValue('A' .$numrow, $data->inventory_number);
    //         $sheet->setCellValue('B' .$numrow, $data->name);
    //         $sheet->setCellValue('C' .$numrow, $data->description);
    //         $sheet->setCellValue('D' .$numrow, $data->type);
    //         $sheet->setCellValue('E' .$numrow, $data->serial_number);
    //         $sheet->setCellValue('F' .$numrow, $data->purchase_date);
    //         $sheet->setCellValue('G' .$numrow, $data->purchase_price);
    //         $sheet->setCellValue('H' .$numrow, $data->category);
    //         $sheet->setCellValue('I' .$numrow, $data->sub_category);
    //         $sheet->setCellValue('J' .$numrow, $data->fund);
    //         $sheet->setCellValue('K' .$numrow, $data->manufacture);
    //         $sheet->setCellValue('L' .$numrow, $data->supplier);
    //         $sheet->setCellValue('M' .$numrow, $data->qty);
    //         $sheet->setCellValue('N' .$numrow, $data->location);
    //         $sheet->setCellValue('O' .$numrow, $data->location_detail);
    //         $sheet->setCellValue('P' .$numrow, $data->staffname);
    //         $sheet->setCellValue('Q' .$numrow, $data->condition);
    //         $sheet->setCellValue('R' .$numrow, $data->purpose);
    //         $sheet->setCellValue('S' .$numrow, $data->remark);
    //     //   $no++; // Tambah 1 setiap kali looping
    //       $numrow++; // Tambah 1 setiap kali looping
    //     }
    // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    // $datenow=date("Ymd");
    // $fileName = 'RISE_Inventory_Report_'.$datenow.'.csv';

    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header("Content-Disposition: attachment; filename=$fileName"); // Set nama file excel nya
    // header('Cache-Control: max-age=0');

    // }

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

        // var_dump($data);
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
        $sheet->setCellValue($hcolumn++ . $start, "Services_type");
        $sheet->setCellValue($hcolumn++ . $start, "Frequency");
        $sheet->setCellValue($hcolumn++ . $start, "Last_service_date");
        $sheet->setCellValue($hcolumn++ . $start, "Next_service_date");
        $sheet->setCellValue($hcolumn++ . $start, "Provider_contact");
        $sheet->setCellValue($hcolumn++ . $start, "Staff_PIC");
        $sheet->setCellValue($hcolumn++ . $start, "Schedule prior(weeks)");
        
        //updating
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
            $sheet->setCellValue($column++ .$row_number, $row->services);
            $sheet->setCellValue($column++ .$row_number, $row->frequency);
            $sheet->setCellValue($column++ .$row_number, $row->last_service_date);
            $sheet->setCellValue($column++ .$row_number, $row->next_service);
            $sheet->setCellValue($column++ .$row_number, $row->provider_contact);
            $sheet->setCellValue($column++ .$row_number, $row->Staff_PIC);
            $sheet->setCellValue($column++ .$row_number, $row->service_schedule);
        
            $row_number++;
        }
        $row_number--;
        $sheet->getStyle("A8:AA".$row_number)->applyFromArray(
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
        ob_clean();
        $filename = 'RISE_Inventory_Report_' . date('Ymd');
        
        // header('Content-Type: application/vnd.ms-excel');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }    

}

/* End of file Reports.php */
/* Location: ./application/controllers/Reports.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-18 01:09:04 */
/* http://harviacode.com */