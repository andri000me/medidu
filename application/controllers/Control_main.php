<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Control_main extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model(array('Model_main', 'Model_default', 'Model_user'),'', TRUE);		
	}

	public function index()
	{

		$this->output->delete_cache();

		$this->Model_main->setTable("tbl_user");

		$ip_address = array(
			'browser'	=> $this->agent->browser(),
			'version'	=> $this->agent->version(),
			'ip' 	=> $this->input->ip_address(),
			'logged'=> 1,
		);
		$query = $this->Model_main->selectedData($ip_address);
		if ((empty($this->session->userdata("id"))) && ($query->num_rows() > 0)){
			$this->Model_main->setTable("tbl_pengaturan");
			$this->Model_main->setKey("id");
			foreach ($query->result_array() as $data) {
				$id_user = $data['id'];
			}
			$data = array(
				'id' 	=> $id_user,
			);
			$query_pengaturan = $this->Model_main->selectedData($data);
			$this->load->view(
				'lock_screen',
				array(
					'query'				=> $query,
					'query_pengaturan'	=> $query_pengaturan,
				)
			);
		}else{
			$query_skor = $this->Model_default->listSkor();

			$this->template->display(
				'beranda',
				array(
					'judul'			=>'Medidu - Media Edukasi Online',
					'query_rank' 	=> $query_skor,
				)
			);
		}
	}

	public function error_page($error)
	{
		$this->template->display($error);
	}


	public function openPage($page){	
		$index = 0;
		if ($page == "game_list") {
			$table = "game";
		}else{
			$table = $page;
		}

		$this->Model_main->setTable("tbl_".$table);
		if (
			$page=="game" ||
			$page=="genre" ||
			$page=="akses" ||
			$page=="game_list" ||
			$page=="level" ||
			$page=="user"
			) {
			$query 	= $this->Model_main->show();
		}else{
			$query 	= 0;
		}

		$this->template->display(
			'page_'.$page."/index",
			array(
				'judul' 	=> strtoupper(substr($page, 0,1))."".strtolower(substr($page, 1)),
				'query' 	=> $query,
			)
		);
	}

	public function openDetail(){	
		$this->Model_main->setTable($this->input->post("table"));
		$this->Model_main->setKey($this->input->post("field"));
		$page = $this->input->post("page");

		$this->template->display(
			'page_'.$page."/view",
			array(
				'query' 	=> $this->Model_main->selectedItem($this->input->post("id")),
			)
		);
	}

	public function openFormulir(){	
		$this->Model_main->setTable($this->input->post("table"));
		$this->Model_main->setKey($this->input->post("field"));
		$page = $this->input->post("page");

		if (!empty($this->input->post("operasi"))) {
			$operasi 	= $this->input->post("operasi");
		}else{
			$operasi 	= "";
		}

		if (!empty($this->input->post("table_foreign"))) {
			$this->Model_main->setTable($this->input->post("table_foreign"));
			$query_foreign 	= $this->Model_main->show();
			$this->Model_main->setTable($this->input->post("table"));
		}else{
			$query_foreign 	= "";
		}

		if (!empty($this->input->post("id")) || $this->input->post("id") != 0) {
			$query 		= $this->Model_main->selectedItem($this->input->post("id"));
		}else{
			$query 		= "";
		}
		$this->template->display(
			'page_'.$page."/form",
			array(
				'query' 		=> $query,
				'query_foreign'	=> $query_foreign,
				'operasi' 		=> $operasi,
			)
		);
	}

	public function pageRelation(){
		$this->Model_main->setTable($this->input->post("table"));
		$this->Model_main->setKey($this->input->post("key"));

		if ($this->input->post("operasi")) {
			$operasi 	= $this->input->post("operasi");
		}else{
			$operasi 	= "";			
		}

		$value 	= $this->input->post("value");
		$folder	= $this->input->post("folder");
		$page	= $this->input->post("page");
		$query 	= $this->Model_main->selectedItem($value);
		$this->template->display(
			'page_'.$folder.'/'.$page,
			array(
				'query' 	=> $query, 
				'operasi' 	=> $operasi, 
			)
		);

	}

	public function page(){	
		$folder	= $this->input->post("folder");
		$page 	= $this->input->post("page");
		if (!empty($this->input->post("operasi"))) {
			$operasi 	= $this->input->post("operasi");
		}else{
			$operasi 	= "";			
		}

		$this->template->display(
			'page_'.$folder."/".$page,
			array(
				'operasi' 	=> $operasi, 
			)
		);
	}
}
