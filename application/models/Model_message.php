<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Model_message extends CI_Model
	{
		private $key			= "";
		private $table 			= "";
		private $selectType 	= "";
		private $tableForeign 	= "";
		private $fieldForeign 	= "";
		private $valueForeign 	= "";

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

		public function setSelectType($data){
			$this->selectType 	= $data;
		}
		public function setForeignTable($data){
			$this->tableForeign 	= $data;
		}
		public function setForeignField($data){
			$this->fieldForeign 	= $data;
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
			$query = $this->db->get();	
			return $query;
		}

		public function selectedData($data){
			if (!empty($this->selectType)) {
				if ($this->selectType == "or") {
					$this->db->or_where($data);
				}else{
					$this->db->where($this->key, $data[$this->key]);
				}
			}else{
				$this->db->where($this->key, $data[$this->key]);				
			}

			if (!empty($this->tableForeign)) {
				$this->db->join($this->tableForeign, $this->tableForeign.".".$this->fieldForeign." = ".$this->table.".".$this->key);
			}
			
			$this->db->order_by($this->key, "ASC");
			$this->db->from($this->table);
			$query = $this->db->get();	
			return $query;
		}

		public function selectedDataOnline($data){
			if (!empty($this->selectType)) {
				if ($this->selectType == "or") {
					$this->db->or_where($this->table.".".$data);
				}else{
					$this->db->where($this->key, $data[$this->key]);
				}
			}

			$this->db->from($this->table);
			$query = $this->db->get();	
			return $query;
		}
		

		public function selectDataHead($data){
			$this->db->where("(penerima='".$data['penerima']."' AND pengirim='".$data['pengirim']."') OR 
				(pengirim='".$data['penerima']."' AND penerima='".$data['pengirim']."')");
			$this->db->from($this->table);
			$query = $this->db->get();
			return $query;
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