<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Model_akses extends CI_Model
	{
		private $key	= "";
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

		public function insert($data){
			$this->db->insert($this->table, $data);
			$afftectedRows=$this->db->affected_rows();
			if($afftectedRows>0)
			{
			    return true;
			}
			else{
			    return false;
			}
		}

		public function update($data){
			$this->db->where($this->key, $data[$this->key]);
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

		public function delete($data){
			$this->db->where($this->key, $data[$this->key]);
			$this->db->delete($this->table);
			$afftectedRows=$this->db->affected_rows();
			if($afftectedRows>0)
			{
			    return true;
			}
			else{
			    return false;
			}
		}
	}
?>