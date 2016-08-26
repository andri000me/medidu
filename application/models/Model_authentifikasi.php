<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/

	class Model_authentifikasi extends CI_Model
	{
		private $status = false;
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

		public function setLogged($key, $data){
			$this->db->where($this->key, $key);
    		$this->db->update($this->table, $data);
			$afftectedRows=$this->db->affected_rows();
			if($afftectedRows>0)
			{
			    return true;
			}
			else{
			    return false;
			}
		}

		public function show(){
			$this->db->select('*');
			$this->db->from($this->table);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function selectedData($data){
			$this->db->select('*');
			$this->db->where($data['field'], $data['value']);
			$this->db->from($data['table']);
			return $this->db->get();
		}

		public function checkLogin($data){
			$this->db->select('*, tbl_user.id AS id_user');
			$this->db->where($data);
			$this->db->from($this->table);
			$this->db->join("tbl_akses", $this->table.".id_akses = tbl_akses.id");
			$this->db->join("tbl_pengaturan", $this->table.".id = tbl_pengaturan.id");
			return $this->db->get();
		}
	}
?>