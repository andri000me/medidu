<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Model_main extends CI_Model
	{
		private $key	= 'id';
		private $table 	= "";

		function __construct()
		{
			parent::__construct();
		}

		public function setTable($table){
			$this->table= $table;
		}

		public function setKey($key){
			$this->key 	= $key;
		}

		public function show(){
			$this->db->select('*');
			$this->db->from($this->table);
			return $this->db->get();
		}

		public function showJoin($table){
			$this->db->select("*, ".$this->table.".".$this->key." AS ".$table['AS_id']);
			$this->db->from($this->table);
			$this->db->join($table['table'], $table['table'].".".$this->key." = ".$this->table.".".$table['foreign']);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function showSelectJoin($table){
			if ($table['id']>0) {
				$this->db->select("*, ".$this->table.".".$this->key." AS ".$table['AS_id']);						
				$this->db->from($this->table);
				$this->db->where($this->table.".".$this->key, $table['id']);
				$this->db->join($table['table'], $table['table'].".".$this->key." = ".$this->table.".".$table['foreign']);
				$query = $this->db->get();
				return $query->result_array();
			}else{
				return false;
			}
		}

		public function selectedItem($id){
			if ($id>0) {
				$this->db->select('*');
				$this->db->where($this->key, $id);
				$this->db->from($this->table);
				$query = $this->db->get();
				return $query->result_array();
			}else{
				return false;
			}
		}

		public function selectedData($data){
			$this->db->select('*');
			$this->db->where($data);
			$this->db->from($this->table);
			return $this->db->get();
		}
	}
?>