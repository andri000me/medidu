<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Model_user extends CI_Model
	{
		private $key	= "";
		private $group	= "";
		private $table 	= "";
		private $table_foreign 	= "";
		private $field_select 	= "";
		private $order 	= "";

		function __construct()
		{
			parent::__construct();
		}

		public function setTable($table){
			$this->table = $table;
		}

		public function setFieldSelect($data){
			$this->field_select = $data;
		}

		public function setGroup($group){
			$this->group = $group;
		}

		public function setTableForeign($table){
			$this->table_foreign = $table;
		}

		public function setKey($key){
			$this->key 	= $key;
		}

		public function setOrder($data){
			$this->order= $data;
		}

		public function selectData($data){
			if (!empty($this->field_select)) {
					$this->db->select("*, 
						sum(".$this->field_select.") AS total".$this->field_select.", 
						count(".$this->field_select.") AS count".$this->field_select."
					");
			}
			else if ($this->table == "tbl_wacana") {
				$this->db->select('*, tbl_wacana.id AS id_wacana');				
			}else{				
				$this->db->select('*');
			}
			
			if ($this->table_foreign == "tbl_pengaturan") {
				$this->db->where($this->table.".".$this->key." = ".$data[$this->key]);
			}
			else{
				$this->db->where($data);
			}

			$this->db->from($this->table);
			if (!empty($this->table_foreign)) {
				if ($this->table_foreign == "tbl_game") {
					$this->db->join($this->table_foreign, $this->table.".id_game = ".$this->table_foreign.".".$this->key);
				}
				else if ($this->table_foreign == "tbl_user") {
					$this->db->join($this->table_foreign, $this->table.".id_user = ".$this->table_foreign.".".$this->key);
					$this->db->join("tbl_pengaturan", "tbl_pengaturan.id = ".$this->table_foreign.".".$this->key);
				}
				else if ($this->table_foreign == "tbl_pengaturan") {
					$this->db->join($this->table_foreign, $this->table.".".$this->key." = ".$this->table_foreign.".".$this->key);
				}
			}

			if (!empty($this->order)) {
				$this->db->order_by($this->table.".".$this->key, $this->order);
			}
			$this->db->group_by($this->group); 
			return $this->db->get();
		}

		public function show(){		
			if ($this->table == "tbl_komentar") {
				$this->db->select('*, tbl_komentar.id AS id_komentar');				
			}else{				
				$this->db->select('*');
			}
			$this->db->from($this->table);
			if (!empty($this->table_foreign)) {
				if ($this->table_foreign == "tbl_user") {
					$this->db->join($this->table_foreign, $this->table.".id_user = ".$this->table_foreign.".".$this->key);
					$this->db->join("tbl_pengaturan", "tbl_pengaturan.id = ".$this->table_foreign.".".$this->key);
				}
			}
			if (!empty($this->order)) {
				$this->db->order_by($this->table.".".$this->key, $this->order);
			}
			return $this->db->get();
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
			$this->delete_pengaturan($data);

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

		private function delete_pengaturan($data){
			$this->db->where($this->key, $data[$this->key]);
			$this->db->delete("tbl_pengaturan");
		}

		public function countDataSkor($data){
			$this->db->select("*, count(skor) AS count_skor, sum(skor) AS total_skor");
			$this->db->where('id_user', $data['id_user']);
			$this->db->where('id_game', $data['id_game']);
			$this->db->from("tbl_skor");
			$this->db->group_by("tanggal");
			$this->db->order_by("tanggal DESC");
			$query = $this->db->get();	
			return $query;
		}
	}
?>