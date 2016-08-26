<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* 
	*/
	class Template
	{
		protected $_ci;
		
		function __construct()
		{
			$this->_ci = &get_instance();
		}

		function display($template, $data = null){
			if(!$this->is_ajax())
			{
				$data['_content'] 		= $this->_ci->load->view($template, $data, true);
				$data['_include_meta']	= $this->_ci->load->view('template/include_meta', $data, true);
				$data['_include_head'] 	= $this->_ci->load->view('template/include_head', $data, true);
				$data['_include_footer']= $this->_ci->load->view('template/include_footer', $data, true);
				$data['_navbar_header'] = $this->_ci->load->view('template/navbar_header', $data, true);
				$data['_navbar_side'] 	= $this->_ci->load->view('template/navbar_side', $data, true);
				$data['_navbar_footer'] = $this->_ci->load->view('template/navbar_footer', $data, true);
				$data['_navbar_side_gentellela']	= $this->_ci->load->view('template/navbar_side_gentellela', $data, true);
				$this->_ci->load->view('/index.php', $data);
			}
			else{
				$this->_ci->load->view($template, $data);
			}
		}

		function is_ajax(){
			return(
				$this->_ci->input->server('HTTP_X_REQUESTED_WITH')&&
				($this->_ci->input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest')
			);
		}
	}

?>