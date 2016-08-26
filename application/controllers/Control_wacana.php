<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Control_wacana extends CI_Controller{	
	private $status = false;

	function __construct(){
		parent::__construct();
		$this->load->model('Model_wacana','',TRUE);
	}

	public function insert(){
		$this->Model_wacana->setTable($this->input->post("table"));
		if ($this->input->post("table") == "tbl_wacana") {
			$data = array(
				'id_user' 	=> $this->input->post("id_user"),
				'wacana' 	=> $this->input->post("wacana"),
				'type' 		=> $this->input->post("type"),
				'tanggal'	=> date("Y-m-d"),
				'jam' 		=> date("h:i:s A", strtotime("now")),
			);
		}else if($this->input->post("table") == "tbl_komentar"){
			$data = array(
				'id_wacana'	=> $this->input->post("id_wacana"),
				'id_user' 	=> $this->input->post("id_user"),
				'komentar' 	=> $this->input->post("komentar"),
				'tanggal'	=> date("Y-m-d"),
				'jam' 		=> date("h:i:s A", strtotime("now")),
			);
		}
		
		$status = $this->Model_wacana->insert($data);
		echo json_encode($status);
	}

	public function update(){
        $this->Model_wacana->setTable($this->input->post("table"));
        $this->Model_wacana->setKey($this->input->post("key"));
		$data = array(
			'id' 		=> $this->input->post("id"),
			'id_user' 	=> $this->input->post("id_user"),
			'wacana' 	=> $this->input->post("wacana"),
			'type' 		=> $this->input->post("type"),
			'tanggal'	=> date("Y-m-d"),
			'jam'		=> date("Y-m-d"),
		);
		$status = $this->Model_wacana->update($data);
		echo json_encode($status);
	}

    public function delete()
    {
        $this->Model_wacana->setTable($this->input->post("table"));
        $this->Model_wacana->setKey($this->input->post("key"));

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_wacana->delete($data);
        echo json_encode($status);
    }

	public function openFormulir(){
		$this->Model_wacana->setTable($this->input->post("table"));
		$this->Model_wacana->setKey($this->input->post("field"));
		$page 		= $this->input->post("page");
		$id 		= $this->input->post("id");
		$operasi 	= $this->input->post("operasi");
		$data = array(
			'id' => $id, 
		);
		$query 		= $this->Model_wacana->selectData($data);
		$this->template->display(
			'page_'.$page.'/form',
			array(
				'id' 		=> $id,
				'operasi' 	=> $operasi,
				'query' 	=> $query,
			)
		);
	}
}