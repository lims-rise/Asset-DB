<?php



if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    use Google\Client as google_client;
    use Google\Service\Drive as google_drive;

class Item_master extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Item_master_model');
        $this->load->library('form_validation');        
	$this->load->library(['datatables','datatables3','datatables2']);
    }

    public function testing()
    {
        $client = new google_client();
        $client->addScope("https://www.googleapis.com/auth/drive");
        $service = new google_drive($client);
    }
    public function index()
    {
        $this->template->load('template','item_master/item_master_list');
    } 
    
    public function json() {
        // $getinput = $this->input->post('cat_id',true);
        header('Content-Type: application/json');
        // if(Str::length($getinput) > 0){
        //     $input = 'category_id = ' + $getinput;
        //     echo $this->Item_master_model->get_all_with_detail($input);    
        // }
        // else {  
        //     echo $this->Item_master_model->get_all_with_detail();    
        // }
        echo $this->Item_master_model->get_all_with_detail();    
        // echo $this->Item_master_model->json();
    }

    // public function json2() {
    //     $getinput = $this->input->post('cat_id',true);
    //     header('Content-Type: application/json');
    //     echo $this->Item_master_model->get_all_with_detail2($getinput);    
    //     // echo $this->Item_master_model->json();
    // }

 
    public function read() 
    {
        $id = $this->input->get('id', TRUE);
        $row = $this->Item_master_model->get_by_id($id);
        if ($row) {
            $row->images = $this->Item_master_model->get_image_show($id);
            $this->template->load('template','item_master/item_master_read', $row);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('item_master'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('item_master/create_action'),
            // 'inventory_number' => $this->Item_master_model->get_id(),
            'inventory_number' => set_value('inventory_number'),
            'fund_id' => set_value('fund_name'),
            'description' => set_value('description'),
            'name' => set_value('name'),
            'type' => set_value('type'),
            'serial_number' => set_value('serial_number'),
            'category_id' => set_value('category_id'),
            'sub_category_id' => set_value('sub_category_id'),
            'manufacture_id' => set_value('manufacture_name'),
            'supplier_id' => set_value('supplier_name'),
            'id_location' => set_value('loc_name'),
            'location_det_id' => set_value('loc_det_name'),
            'scheduled' => set_value('scheduled'),
            
	);
        $this->template->load('template','item_master/item_master_form', $data);
    }
    
    public function create2() 
    {
        $cat_id = $this->input->get('cat_id', TRUE);
        $data = array(
            'button' => 'Create',
            'action' => site_url('item_master/create_action'),
            'inventory_number' => $this->Item_master_model->get_id2($cat_id),
            'fund_id' => set_value('fund_name'),
            'description' => set_value('description'),
            'name' => set_value('name'),
            'type' => set_value('type'),
            'serial_number' => set_value('serial_number'),
            // 'category_id' => set_value('category_id'),
            'category_id' => $cat_id,
            'sub_category_id' => set_value('sub_category_id'),
            'manufacture_id' => set_value('manufacture_name'),
            'supplier_id' => set_value('supplier_name'),
            'id_location' => set_value('loc_name'),
            'location_det_id' => set_value('loc_det_name'),
            'scheduled' => set_value('scheduled'),
	    );
        $this->template->load('template','item_master/item_master_form', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'inventory_number' => $this->input->post('inventory_number',TRUE),
                'description' => $this->input->post('description',TRUE),
                'name' => $this->input->post('name',TRUE),
                'type' => $this->input->post('type',TRUE),
                'serial_number' => $this->input->post('serial_number',TRUE),
                'category_id' => $this->input->post('category_id',TRUE),
                'sub_category_id' => $this->input->post('sub_category_id',TRUE),
                'purchase_date' => $this->input->post('purchase_date',TRUE),
                'purchase_price' => $this->input->post('purchase_price',TRUE),
                'currency' => $this->input->post('currency',TRUE),
                'fund_id' => $this->input->post('fund_id',TRUE),
                'manufacture_id' => $this->input->post('manufacture_id',TRUE),
                'supplier_id' => $this->input->post('supplier_id',TRUE),
                'location_det_id' => $this->input->post('location_det_id',TRUE),
                'scheduled' => $this->input->post('scheduled',TRUE),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id_users'),
                'status' => 1,
	    );

            $this->Item_master_model->insert($data);
            $image = $this->input->post('image_upload');
            if(is_array($image)){
                $image_data = [];
                for($x=0; $x < sizeof($image); $x++){
                    $image_data[] = ['inventory_number' => $this->input->post('inventory_number',true),
                                    'image' => $image[$x]];
                }
                $this->Item_master_model->insertImage($image_data);

            }

            $dataqty = array(
                'inventory_number' => $this->input->post('inventory_number',TRUE),
                'qty' => $this->input->post('qty',TRUE),
    	    );

            $this->Item_master_model->insertqty($dataqty);

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('item_master'));
        }
    }
    
    public function update() 
    {
        $id = $this->input->get('id', TRUE);
        $data = $this->Item_master_model->get_by_id($id);
        if($data){
         $data->images = $this->Item_master_model->get_image($id);
         $data->button = 'Update';
         $data->action = site_url('item_master/update_action');
            $this->template->load('template','item_master/item_master_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('item_master'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('inventory_number', TRUE));
        } else {
            $data = array(
                'description' => $this->input->post('description',TRUE),
                'name' => $this->input->post('name',TRUE),
                'type' => $this->input->post('type',TRUE),
                'serial_number' => $this->input->post('serial_number',TRUE),
                'category_id' => $this->input->post('category_id',TRUE),
                'sub_category_id' => $this->input->post('sub_category_id',TRUE),
                'purchase_date' => $this->input->post('purchase_date',TRUE),
                'purchase_price' => $this->input->post('purchase_price',TRUE),
                'currency' => $this->input->post('currency',TRUE),
                'fund_id' => $this->input->post('fund_id',TRUE),
                'manufacture_id' => $this->input->post('manufacture_id',TRUE),
                'supplier_id' => $this->input->post('supplier_id',TRUE),
                'location_det_id' => $this->input->post('location_det_id',TRUE),
                'scheduled' => $this->input->post('scheduled',TRUE),
	    );

            $this->Item_master_model->update($this->input->post('inventory_number', TRUE), $data);

            $image = $this->input->post('image_upload');
            if(is_array($image)){
                $image_data = [];
                for($x=0; $x < sizeof($image); $x++){
                    $image_data[] = ['inventory_number' => $this->input->post('inventory_number',true),
                                    'image' => $image[$x]];
                }
                $this->Item_master_model->insertImage($image_data);

            }

            $updqty = array(
                'qty' => $this->input->post('qty',TRUE),
            );
            $dataqty = array(
                'inventory_number' => $this->input->post('inventory_number',TRUE),
                'qty' => $this->input->post('qty',TRUE),
            );
            $this->Item_master_model->updateqty($this->input->post('inventory_number', TRUE), $updqty, $dataqty);


            // if ($this->item_master_model->qty_check($this->input->post('inventory_number',TRUE)) > 0) {
            //     $updqty = array(
            //         'qty' => $this->input->post('qty',TRUE),
            //     );

            //     $this->Item_master_model->updateqty($this->input->post('inventory_number', TRUE), $updqty);
            // }
            // else {
            //     $dataqty = array(
            //         'inventory_number' => $this->input->post('inventory_number',TRUE),
            //         'qty' => $this->input->post('qty',TRUE),
            //     );

            //     $this->Item_master_model->insertqty($dataqty);
            // }
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('item_master'));
        }
    }
    public function upload()
    {
        $config['upload_path']          = './assets/item-images/';
            $config['allowed_types']='gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload',$config);
            $data = array('error' => false);
            if(!$this->upload->do_upload("image"))
                $data['error'] = $this->upload->display_errors();
            else {
                $upload = $this->upload->data();
                $image = $upload['file_name'];
                $data['data'] =  '<div class="image-area" style="margin-right:25px;">
                <a href="../assets/item-images/'.$image.'" target="_blank"><img src="../assets/item-images/'.$image.'"  alt="Preview"></a>
                                    <a class="remove-image" href="javascript:void(0)" style="display: inline;">&#215;</a>
                                    <input type="hidden" name="image_upload[]" value="'.$image.'">
                                </div>';
            }
            echo json_encode($data);
    }
    public function delete() 
    {
        $id = $this->input->get('id', TRUE);
        $row = $this->Item_master_model->get_by_id($id);

        if ($row) {
            $this->Item_master_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('item_master'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('item_master'));
        }
    }
    public function remove_image()
    {
        $id = $this->input->post('id', true);
        $image = $this->input->post('image', true);
        $result = $this->Item_master_model->removeImage($id, $image);
        echo json_encode($result);
    }
    public function _rules() 
    {
	$this->form_validation->set_rules('description', 'description', 'trim');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('type', 'type id', 'trim');
	$this->form_validation->set_rules('serial_number', 'serial number', 'trim');
	$this->form_validation->set_rules('category_id', 'category id', 'trim');
	$this->form_validation->set_rules('sub_category_id', 'sub category id', 'trim');
	$this->form_validation->set_rules('inventory_number', 'inventory_number', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

  
    public function excel()
	{
        /* Data */
        $data = $this->Item_master_model->get_all_with_detail_excel();

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
        $drawing->setCoordinates('N1');
        $drawing->setOffsetX(10);
        // $drawing->setRotation(25);
        // $drawing->getShadow()->setVisible(true);
        // $drawing->getShadow()->setDirection(45);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        
        $sheet->setCellValue('B6', "Fixed Inventory List");
        $sheet->setCellValue('N6', "RISE - " . date('Y-m-d'));

        /* Excel Header */
        $start = 8;
        $sheet->setCellValue($hcolumn++ . $start, "No");
        $sheet->setCellValue($hcolumn++ . $start, "Inventory Number");
        $sheet->setCellValue($hcolumn++ . $start, "Name");
        $sheet->setCellValue($hcolumn++ . $start, "Description");
        $sheet->setCellValue($hcolumn++ . $start, "Type/Model");
        $sheet->setCellValue($hcolumn++ . $start, "Serial Number");
        $sheet->setCellValue($hcolumn++ . $start, "Category");
        $sheet->setCellValue($hcolumn++ . $start, "Sub Category");
        $sheet->setCellValue($hcolumn++ . $start, "Location");
        $sheet->setCellValue($hcolumn++ . $start, "Department");
        $sheet->setCellValue($hcolumn++ . $start, "Responsible Person");
        $sheet->setCellValue($hcolumn++ . $start, "Purpose");
        $sheet->setCellValue($hcolumn++ . $start, "Condition");
        $sheet->setCellValue($hcolumn++ . $start, "Remark");
        $sheet->setCellValue($hcolumn++ . $start, "Purchase Date");
        $sheet->setCellValue($hcolumn++ . $start, "Purchase Price");
        
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
            $sheet->setCellValue($column++ .$row_number, $row->category_name);
            $sheet->setCellValue($column++ .$row_number, $row->sub_category_name);
            $sheet->setCellValue($column++ .$row_number, $row->location_name);
            $sheet->setCellValue($column++ .$row_number, $row->department_name);
            $sheet->setCellValue($column++ .$row_number, $row->staff_name);
            $sheet->setCellValue($column++ .$row_number, $row->purpose);
            $sheet->setCellValue($column++ .$row_number, $row->condition_name);
            $sheet->setCellValue($column++ .$row_number, $row->remark);
            $sheet->setCellValue($column++ .$row_number, $row->purchase_date);
            $sheet->setCellValue($column++ .$row_number, $row->purchase_price);
        
            $row_number++;
        }
        $row_number--;
        $sheet->getStyle("A8:P".$row_number)->applyFromArray(
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
        $filename = 'Inventory_List_' . date('Ymd');
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

}

/* End of file Item_master.php */
/* Location: ./application/controllers/Item_master.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-18 02:55:12 */
/* http://harviacode.com */