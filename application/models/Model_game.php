<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Model_game extends CI_Model
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

		public function show(){
			$this->db->select("*");
			$this->db->from($this->table);
			return $this->db->get();	
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

		public function selectedData($data){
			$this->db->where($this->key, $data[$this->key]);
			$this->db->from($this->table);
			if ($this->table == "tbl_group_genre") {
				$this->db->join("tbl_genre", "tbl_genre.id = ".$this->table.".id_genre");
			}
			$query = $this->db->get();	
			return $query;
		}

		public function find($keyword){
			$this->db->like($keyword['field'], $keyword['keyword'],'after');
			$this->db->group_by($keyword['field']);
			$query = $this->db->get($keyword['table']);
			return $query->result_array();
		}
	}
?>