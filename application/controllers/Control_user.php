<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Control_user extends CI_Controller {
	private $status = false;
	
	function __construct(){
		parent::__construct();
		$this->load->model('Model_user','',TRUE);
	}

	public function getDetailData($page)
	{
		if (!empty($this->input->post("id_user"))) {
			$id_user = $this->input->post("id_user");
		}else{
			$id_user = "";
		}

		if ($page == "my_game") {
			$this->Model_user->setTable("tbl_skor");
			$this->Model_user->setKey("id");
			$skor = array(
				'id_user' 	=> $id_user,
			);
			$this->Model_user->setTableForeign("tbl_game");
			$this->Model_user->setGroup("game");
			$this->Model_user->setFieldSelect("skor");

			$query_game 	= $this->Model_user->selectData($skor);
			$senderData 	= array(
				'query_game' 	=> $query_game,
			);
		}else if ($page == "my_gallery"){
			$this->Model_user->setTable("tbl_file");
			$gambar = array(
				'coloumn' 	=> "id_user",
				'id_foreign'=> $id_user,
			);

			$query_gambar 	= $this->Model_user->selectData($gambar);
			$senderData 	= array(
				'query_gambar' 	=> $query_gambar,
				'id_user' 		=> $id_user,
			);
		}else if ($page == "detail_profil"){
			$data = array(
				'id'		=> $id_user,
			);
			$foreign_data = array(
				'id_user' 	=> $id_user,
			);
			$this->Model_user->setKey("id_user");
			$this->Model_user->setTable("tbl_skor");
			$query_skor 		= $this->Model_user->selectData($foreign_data);
			
			$this->Model_user->setKey("id");
			$this->Model_user->setTable("tbl_user");
			$query_profil 		= $this->Model_user->selectData($data);

			$this->Model_user->setTableForeign("tbl_pengaturan");
			$query_pengaturan	= $this->Model_user->selectData($data);
			
			$this->Model_user->setTable("tbl_level");
			$this->Model_user->setOrder("ASC");
			$query_level = $this->Model_user->show();

			$senderData 	= array(
				'query_skor' 		=> $query_skor,
				'query_profil' 		=> $query_profil,
				'query_pengaturan'	=> $query_pengaturan,
				'query_level'	 	=> $query_level,
				'id_user' 			=> $id_user,
			);
		}else if ($page == "timeline"){
			$this->Model_user->setTable("tbl_wacana");
			$this->Model_user->setKey("id");
			$wacana = array(
				'id_user'	=> $id_user,
			);

			$this->Model_user->setTableForeign("tbl_user");
			$this->Model_user->setOrder("DESC");
			$query_wacana 	= $this->Model_user->selectData($wacana);
			
			$this->Model_user->setTable("tbl_komentar");
			$this->Model_user->setOrder("ASC");
			$this->Model_user->setTableForeign("tbl_user");
			$query_komentar = $this->Model_user->show();

			$senderData 	= array(
				'query_wacana' 	=> $query_wacana,
				'query_komentar'=> $query_komentar,
				'id_user' 		=> $id_user,
			);
		}else if ($page == "my_friend"){
			$this->Model_user->setTable("tbl_user");
			$query = $this->Model_user->show();

			$this->Model_user->setTable("tbl_pengaturan");
			$query_pengaturan = $this->Model_user->show();

			$senderData 	= array(
				'query' 			=> $query,
				'query_pengaturan' 	=> $query_pengaturan,
			);
		}else if ($page == "detail_game"){
			$this->Model_user->setTable("tbl_skor");
			$this->Model_user->setKey("id");
			$skor = array(
				'id_user' 	=> $this->input->post("id_user"),
				'id_game' 	=> $this->input->post("id_game"),
			);
			//$this->Model_user->setTableForeign("tbl_game");

			$query_skor 		= $this->Model_user->selectData($skor);
			$query_grafik 		= $this->Model_user->countDataSkor($skor);

			$senderData 	= array(
				'query_grafik' 		=> $query_grafik,
				'query_skor' 		=> $query_skor,

			);
		}else if($page == "pengaturan"){
			$this->Model_user->setTable("tbl_user");
			$this->Model_user->setKey("id");
			$data = array(
				'id' 		=> $id_user,
			);
			$query_user 	= $this->Model_user->selectData($data);

			$this->Model_user->setTable("tbl_akses");
			$query_akses 	= $this->Model_user->show();

			$this->Model_user->setTable("tbl_pengaturan");
			$query_setting 	= $this->Model_user->selectData($data);

			$senderData 	= array(
				'query_user' 	=> $query_user,
				'query_akses' 	=> $query_akses,
				'query_setting' => $query_setting,
			);
		}else{
			$senderData = array(
			);
		}

		$this->template->display(
			'page_user/_user/'.$page,
			$senderData
		);
	}

	public function detail($id)
	{
		$this->Model_user->setTable("tbl_user");
		$this->Model_user->setKey("id");

		if (!empty($this->input->post("id")) || !empty($id)) {
			if (!empty($this->input->post("id"))) {
				$data['id'] 	= $this->input->post("id");
			}else{
				$data['id'] 	= $id;
			}
		}else{
			$data = false;
		}

		if ($data != false) {
			$query = $this->Model_user->selectData($data);
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $data) {
					$id_user 	= $data['id'];
				}
			}

			$this->Model_user->setTable("tbl_pengaturan");
			$setting = array(
				'id' 	=> $id_user,
			);
			$query_setting = $this->Model_user->selectData($setting);
		}
			$this->template->display(
				'page_user/beranda',
				array(
					'query'			=> $query,
					'query_setting'	=> $query_setting,
				)
			);
	}

	public function insert()
	{
		$this->Model_user->setTable($this->input->post('table'));
		$this->Model_user->setKey($this->input->post('key'));

		$data = array(
			'nama_depan'	=> $this->input->post('nama_depan'),
			'nama_belakang' => $this->input->post('nama_belakang'),
			'kelamin' 		=> $this->input->post('gender'),
			'telepon' 		=> $this->input->post('telepon'),
			'tgl_lahir'		=> $this->input->post('tanggal_lahir'),
			'alamat' 		=> $this->input->post('alamat'),
			'email' 		=> $this->input->post('email'),
			'username' 		=> $this->input->post('username'),
			'password' 		=> md5($this->input->post('password')),
			'id_akses' 		=> $this->input->post('akses'),
		);

		$cekData = array(
			'username' 	=> $data['username'],
			'email' 	=> $data['email'],
		);
		$this->Model_user->insert($data);
		$query = $this->Model_user->selectData($cekData);

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$dataSetting = array(
					'id' 		=> $row['id'],
					'bahasa'	=> "id",
				);
			}

			$this->Model_user->setTable("tbl_pengaturan");
			$status = $this->Model_user->insert($dataSetting);
		}else{
			$status = false;
		}

		echo json_encode($status);
	}

	public function update()
	{
		$this->Model_user->setTable($this->input->post('table'));
		$this->Model_user->setKey($this->input->post('key'));

		$data = array(
			'nama_depan'	=> $this->input->post('nama_depan'),
			'nama_belakang' => $this->input->post('nama_belakang'),
			'kelamin' 		=> $this->input->post('gender'),
			'telepon' 		=> $this->input->post('telepon'),
			'tgl_lahir'		=> $this->input->post('tanggal_lahir'),
			'alamat' 		=> $this->input->post('alamat'),
			'email' 		=> $this->input->post('email'),
			'id' 			=> $this->input->post('id'),
			'id_akses' 		=> $this->input->post('akses'),
		);

		$status = $this->Model_user->update($data);

		echo json_encode($status);
	}

	public function updateSetting()
	{
		$this->Model_user->setTable($this->input->post('table'));
		$this->Model_user->setKey($this->input->post('key'));
		$field = $this->input->post('field');
		$data = array(
			'id' 	=> $this->input->post('id'),
			$field 	=> $this->input->post('value'),
		);
		if ($this->input->post('field') == "bahasa") {
			$session_data = array(
				'language'		=> $this->input->post('value'), 
			);
			$this->session->set_userdata($session_data);
		}
		else if ($this->input->post('field') == "poto_profil") {
			$session_data = array(
				'photo'			=> $this->input->post("value"), 
			);
			$this->session->set_userdata($session_data);
		}
		$status = $this->Model_user->update($data);

		echo json_encode($status);
	}

	public function updateItem()
	{
		$this->Model_user->setTable($this->input->post("table"));
		$this->Model_user->setKey($this->input->post("key"));
		$field 	= $this->input->post("field");
		$value 	= $this->input->post("value");

		if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
			if ($this->input->post("key") != "coloumn") {
				$data['id']		=  $this->input->post("id");
			}
			$data[$field]		=  $value;
		}

		if ($this->input->post("key") == "coloumn") {
			$data['coloumn'] 	= "id_user";
			$data['id_foreign'] = $this->input->post("id");
		}

		$status = $this->Model_user->update($data);
		echo json_encode($status);
	}

	public function delete(){
		$this->Model_user->setTable($this->input->post("table"));
		$this->Model_user->setKey($this->input->post("key"));
			
		if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
			$data['id'] =  $this->input->post("id");
		}
			
		$status = $this->Model_user->delete($data);
		echo json_encode($status);
	}

	public function uploadFile(){
		$new_name 					= time()."_file_user";
		$config['file_name'] 		= $new_name;
		$config['upload_path'] 		= './file/images/users/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']      	= '0';
		$config['max_width']     	= '0';
		$config['max_height']    	= '0';
			
		$this->load->library('upload', $config);
			
		$this->upload->initialize($config);
		if ($this->upload->do_upload("file")) {
			$this->response = $this->upload->data();
			$status['file_type']= $this->response['file_type'];
			$status['operasi']	= "create";
			$status['name_file']= $this->response['file_name'];
			$status['status'] 	= true;
		}else{
			$status['error'] 	= $this->upload->display_errors();
			$status['status'] 	= false;
		}
		echo json_encode($status);
	}

	public function insertFile($operasi){
		$this->Model_user->setTable($this->input->post("table"));
				
		$data = array(
			'file' 		=> $this->input->post("file"), 
			'type' 		=> $this->input->post("type"), 
			'kondisi' 	=> $this->input->post("kondisi"), 
			'tanggal' 	=> date("Y-m-d"), 
			'coloumn' 	=> $this->input->post("coloumn"), 
			'id_foreign'=> $this->input->post("id_foreign"), 
		);
				
		if ($operasi == "create") {
			$status = $this->Model_user->insert($data);
		}else if ($operasi == "update") {
			$this->Model_user->setKey($this->input->post("field"));
			$status = $this->Model_user->update($data);
		}
		echo json_encode($status);
	}

}
