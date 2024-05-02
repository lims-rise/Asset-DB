<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
	public function index()
	{

		// Konfigurasi email
        $config = array(
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'notification.rise@gmail.com',  // Email gmail
            'smtp_pass'   => 'crsikfrjloabalxd',  // Password gmail
            'smtp_crypto' => 'tls',
            'smtp_port'   => 587,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
		);
	
        // Load library email dan konfigurasinya
        $this->load->library('email', $config);


		$cek = $this->db->from('v_item_notif')->get()->row();
		if ($cek) {
			$catlog = array($cek->category_id . $cek->id_location, '1');
		}
		else {
			$catlog = array('1');
		}
		$num = $this->db->count_all_results('v_item_notif');
		if($num > 0){

			$data = array(
				'id' => $cek->inventory_number . $cek->next_service,
				'last_services' => $cek->next_service,
				'updated' => date('Y-m-d H:i:s')
			);

			try {
				$to = $this->db->from('email_notif')
								->select('email')
								->where('status',1)
								->where_in('catlog', $catlog)
								->get()
								->result_array();
				$to = array_column($to, 'email');
				  // Email dan nama pengirim
				  $this->email->from($config['smtp_user'], 'RISE Inventory');

				  // Email penerima
				  $this->email->to($to); // Ganti dengan email tujuan
				//   $this->email->to('Zainal.Handis@monash.edu'); // Ganti dengan email tujuan
		  
				  // Subject email
				  $this->email->subject('RISE Assets DB - Equipment services notification ' . date('Y-m-d'));

				  $test = 'Hi There, <br />' ;
				  $test .= 'This is an automatic notification email sent from Assets DB application to notify you that the following equipment is need to "' .$cek->services. '" <br />';
				  $test .= '<br />' ;
				  $test .= 'Equipment name : ' . $cek->name . '<br />';
				  $test .= 'Type : ' .$cek->type . '<br />';
				  $test .= 'Serial number : ' .$cek->serial_number . '<br />';
				  $test .= 'Location : ' . $cek->loc_det . ', ' . $cek->loc . '<br />';
				  $test .= 'Latest services : ' . $cek->last_services . '<br />';
				  $test .= 'Frequency : ' . $cek->frequency . '<br />';
				  $test .= 'Next services : ' . $cek->next_service . '<br />';
				  $test .= 'Services type : ' . $cek->services . '<br />';
				  $test .= '<br />' ;
				  $test .= 'Don`t forget to add the current maintenance service to this item once the "' .$cek->services. '" is completed.<br />';
				  $test .= '<br />' ;
				  $test .= '<br />' ;
				  $test .= 'Regards, <br />' ;
				  $test .= 'RISE - Inventory' ;
				  $this->email->message($test);
		  
				  // Isi email
				//   $this->email->message($cek->name . ' ' .$cek->serial_number .' date:' . date('Y-m-d H:i:s'));
				//   $this->email->message('Test kirim email' . ' ' .' serial number : 9921100' .' date:' . date('Y-m-d H:i:s'));
				//   $this->email->message('Test kirim email' . ' ' .' serial number : 9921100' .' date:');
				  // Tampilkan pesan sukses atau error
				//   echo $this->email->message;
				  if ($this->email->send()) {
					//   echo $test;
					  echo 'Sukses! email berhasil dikirim.';
				  } else {
					  echo 'Error! email tidak dapat dikirim.';
				  }
			} catch (\Throwable $th) {
				
			}
			$this->db->insert('item_notif',$data);
		}

		// $this->load->view('welcome_message');
	}

	
}
