<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Model_default extends CI_Model
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

		public function selectData($data){
			if($this->table == "tbl_head_message"){
				$this->db->select("*, tbl_detail_message.id AS id_detail, tbl_head_message.id AS id_head ");
			}else{
				$this->db->select("*");
			}
			$this->db->from($this->table);
			if($this->table == "tbl_head_message"){
				$this->db->join("tbl_detail_message" , "tbl_detail_message.id_head = ".$this->table.".id", "RIGHT JOIN");
				$this->db->join("tbl_user" , "tbl_user.id = ".$this->table.".pengirim", "LEFT JOIN");
				$this->db->join("tbl_pengaturan" , "tbl_pengaturan.id = tbl_user.id");
				$this->db->order_by("tbl_detail_message.id","desc");
				$this->db->limit(1);
			}
			$this->db->where($data);
			return $this->db->get();
		}

		public function listSkor(){
			$this->db->select("tbl_user.id, tbl_user.nama_depan, tbl_user.nama_belakang, tbl_skor.id_user, tbl_skor.skor, SUM(tbl_skor.skor) AS total_skor");
			$this->db->from("tbl_user");
			$this->db->join("tbl_skor", "tbl_user.id = tbl_skor.id_user", "LEFT JOIN");
			$this->db->join("tbl_akses", "tbl_akses.id = tbl_user.id_akses", "INNER JOIN");
			$this->db->where_not_in("tbl_akses.akses", "Admin");
			$this->db->or_where_not_in("tbl_akses.akses", "admin");
			$this->db->group_by("tbl_user.id");
			$this->db->order_by("total_skor", "DESC");
			return $this->db->get();
		}
	}
?>