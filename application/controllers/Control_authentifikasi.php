<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control_authentifikasi extends CI_Controller {
	private $status = false;
	function __construct(){
		parent::__construct();
		$this->load->model('Model_authentifikasi','',TRUE);
        $this->load->library('encrypt');
	}

	public function sendEmail(){
		$emailConfig = array(
		   'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'yourEmail@gmail.com',
		    'smtp_pass' => 'yourEmailPassword',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);

		$this->load->library('email', $emailConfig);
		$this->email->set_newline("rn");

		$from_email 	= "forgothboyz@gmail.com"; 
        $to_email 		= $this->input->post("email"); 
     
        $this->email->from($from_email, "Hadad Al Gojali"); 
        $this->email->to($to_email);
        $this->email->subject($this->input->post("subject")); 
        $this->email->message($this->input->post("text")); 
   		//$this->email->send();
   		if($this->email->send()) {
        	$status = true;
   		}
        else {
        	$status = show_error($this->email->print_debugger());
        }
        echo json_encode($status);
	}

	public function cekAccount(){
		$table = array(
			'table' 	=> $this->input->post("table"),
			'field' 	=> $this->input->post("key"),
			'value' 	=> $this->input->post('value'),
		);

		$count = $this->Model_authentifikasi->selectedData($table);
		if ($count->num_rows()>0) {
			$status = true;
		}else{
			$status = false;
		}

		echo json_encode($status);
	}

	public function differentAccount(){
		$this->Model_authentifikasi->setTable($this->input->post("table"));
		$this->Model_authentifikasi->setKey($this->input->post("key"));
		$table = array(
			'table' 	=> $this->input->post("table"),
			'field' 	=> $this->input->post("key"),
			'value' 	=> $this->input->post('value'),
		);

		$count = $this->Model_authentifikasi->selectedData($table);
		if ($count->num_rows()>0) {
				$data = array(
					'logged' 	=> 0, 
					'jam' 		=> date("h:i:s A", strtotime("now")),
					'tanggal'	=> date("Y-m-d"),
					'browser'	=> "",
					'version'	=> "",
					'ip'		=> 0,
				);
				$status = $this->Model_authentifikasi->setLogged($table['value'], $data);
		}else{
			$status = false;
		}

		echo json_encode($status);
	}

	public function checkLogin(){
		$this->Model_authentifikasi->setTable($this->input->post("table"));
		$field 	= $this->input->post("field");
		$data 	= array(
			$field 		=> $this->input->post("username"),
			'password' 	=> md5($this->input->post("password")),
		);
		$count = $this->Model_authentifikasi->checkLogin($data);
		if ($count->num_rows() > 0) {
			$this->Model_authentifikasi->setKey("id");
			foreach ($count->result_array() as $row) {
				$session_data = array(
					'id' 			=> $row['id_user'], 
					'nama_depan' 	=> $row['nama_depan'], 
					'nama_belakang'	=> $row['nama_belakang'], 
					'kelamin'		=> $row['kelamin'], 
					'telepon'		=> $row['telepon'], 
					'tgl_lahir'		=> $row['tgl_lahir'], 
					'alamat'		=> $row['alamat'], 
					'email'			=> $row['email'], 
					'username'		=> $row['username'], 
					'language'		=> $row['bahasa'], 
					'akses'			=> $row['akses'], 
					'photo'			=> $row['poto_profil'], 
				);
				$this->session->set_userdata($session_data);

				$data = array(
					'logged' 	=> 1, 
					'jam' 		=> date("h:i:s A", strtotime("now")),
					'tanggal'	=> date("Y-m-d"),
					'browser'	=> $this->agent->browser(),
					'version'	=> $this->agent->version(),
					'ip'		=> $this->input->ip_address(),
				);
				$this->Model_authentifikasi->setLogged($session_data['id'], $data);
			}
			$status = true;
		}else{
			$status = false;
		}
		echo json_encode($status);
	}

	public function sessionDestroy(){
		$this->Model_authentifikasi->setTable("tbl_user");
		$this->Model_authentifikasi->setKey("id");
		$data = array(
			'logged'	=> 0,
			'jam' 		=> date("h:i:s A", strtotime("now")),
			'tanggal'	=> date("Y-m-d"),
			'browser'	=> "",
			'version'	=> "",
			'ip'		=> 0,
		);
		$check = $this->Model_authentifikasi->setLogged($this->session->userdata('id'), $data);
		if ($check == true) {
			$this->session->sess_destroy();
			$status = true;
		}else{
			$status = false;
		}
		echo json_encode($status);
	}

	public function cekPhoneEmail(){
		$data['id'] 		= "";
		$data['status'] 	= false;
		$table = array(
			'table' 	=> $this->input->post("table"),
			'field' 	=> $this->input->post("key"),
			'value' 	=> $this->input->post('value'),
		);
		$count = $this->Model_authentifikasi->selectedData($table);
		if ($count->num_rows()>0) {
			foreach ($count->result_array() as $row) {
				$id 	 	= $row['id'];
			}
			$data['id'] 	= $id;
			$data['status'] = true;
		}else{
			$data['id'] 	= "";
			$data['status'] = false;
		}

		echo json_encode($data);
	}
}
