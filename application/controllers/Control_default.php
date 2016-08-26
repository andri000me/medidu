<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_default extends CI_Controller {
    private $status = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("Model_user", "Model_default"), "", TRUE);
    }

    public function getDetailData($page)
    {
        if (!empty($this->input->post("id_user"))) {
            $id_user = $this->input->post("id_user");
        }else{
            $id_user = "";
        }

            // ======================================================= SELEKSI data akses
            $this->Model_user->setTable("tbl_akses");
            $this->Model_user->setKey("akses");
            $akses = array(
                'akses' => "admin",
            );
            $query_akses = $this->Model_user->selectData($akses);
            foreach ($query_akses->result_array() as $data) {
                $id_akses = $data['id'];
            }

            // ======================================================= SELEKSI data USER
            $this->Model_user->setTable("tbl_user");
            $this->Model_user->setKey("id_akses");
            $user = array(
                'id_akses'  => $id_akses,
            );
            $query_user = $this->Model_user->selectData($user);
            foreach ($query_user->result_array() as $data) {
                $id_user = $data['id'];
            }

            // ======================================================= SELEKSI data WACANA
            $this->Model_user->setTable("tbl_wacana");
            $this->Model_user->setKey("id");
            $wacana = array(
                'id_user'   => $id_user,
            );

            $this->Model_user->setTableForeign("tbl_user");
            $this->Model_user->setOrder("DESC");
            $query_wacana   = $this->Model_user->selectData($wacana);
            
            $this->Model_user->setTable("tbl_komentar");
            $this->Model_user->setOrder("ASC");
            $this->Model_user->setTableForeign("tbl_user");
            $query_komentar = $this->Model_user->show();


            $senderData     = array(
                'query_wacana'  => $query_wacana,
                'query_komentar'=> $query_komentar,
            );

        $this->template->display(
            'page_user/_user/'.$page,
            $senderData
        );
    }

    public function count_read_message(){
        $this->Model_default->setTable($this->input->post('table'));
        $this->Model_default->setKey($this->input->post('key'));
        $data_message = array(
            'status'    => $this->input->post('value'),
            'penerima'  => $this->input->post('id'),            
        );
        $query = $this->Model_default->selectData($data_message);
        if (!empty($query)) {
            $count = $query->num_rows();
        }

        echo json_encode($count);
    }

    public function read_message_come(){
        $this->Model_default->setTable($this->input->post('table'));
        $this->Model_default->setKey($this->input->post('key'));
        $data_message = array(
            'status'    => $this->input->post('value'),
            'penerima'  => $this->input->post('id'),            
        );
        $query = $this->Model_default->selectData($data_message);
        if (!empty($query)) {
            $count = $query->num_rows();
        }

        $senderData = array(
            'count'         => $count, 
            'query_head'    => $this->Model_default->selectData($data_message),  
        );

        $this->template->display(
            'template/list_message',
            $senderData
        );
    }
}