<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_message extends CI_Controller {
    private $status = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_message");
    }

    public function insert()
    {
        $this->Model_message->setTable($this->input->post("table"));
        $this->Model_message->setSelectType("or");
        $data = array(
            'pengirim'  => $this->input->post("pengirim"),
            'penerima'  => $this->input->post("penerima"),
            'status'    => "0",
        );

        $message = array(
            'pesan'     => $this->input->post("message"),
            'tanggal'   => date("Y-m-d"),
            'jam'       => date("h:i:s A", strtotime("now")),
            'pengirim'  => $this->input->post("pengirim"),
        );

        $query_head = $this->Model_message->selectDataHead($data);
        if ($query_head->num_rows() > 0) {
            $this->Model_message->setKey("id");
            foreach ($query_head->result_array() as $result) {
                $data['id']         = $result['id'];
                $message['id_head'] = $result['id'];
            }

            $this->Model_message->setTable("tbl_detail_message");
            $insertMessage = $this->Model_message->insert($message);

            if ($insertMessage == true) {
                $this->Model_message->setTable($this->input->post("table"));
                $this->Model_message->update($data);
                $status = $insertMessage;
            }else{                
                $status = $insertMessage;
            }
        }else{
            $query_head = $this->Model_message->insert($data);
            if ($query_head == true) {
                $query_head = $this->Model_message->selectedData($data);
                if (!empty($query_head)) {
                    $this->Model_message->setKey("id");
                    foreach ($query_head->result_array() as $result) {
                        $message['id_head'] = $result['id'];
                    }

                    $this->Model_message->setTable("tbl_detail_message");
                    $status = $this->Model_message->insert($message);
                }
            }else{
                $status = false;
            }
        }
        
        echo json_encode($status);
    }

    public function update()
    {
        $this->Model_message->setTable($this->input->post("table"));
        $this->Model_message->setKey($this->input->post("key"));
        $data = array(
            'akses'      => $this->input->post("akses"),
            'keterangan' => $this->input->post("keterangan"),
        );

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_message->update($data);
        echo json_encode($status);
    }

    public function delete()
    {
        $this->Model_message->setTable($this->input->post("table"));
        $this->Model_message->setKey($this->input->post("key"));

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_message->delete($data);
        echo json_encode($status);
    }

    public function data_online()
    {
        $this->Model_message->setTable($this->input->post("table"));
        $this->Model_message->setKey($this->input->post("key"));
        $this->Model_message->setSelectType("and");

        if (!empty($this->input->post("value"))) {
            $data['logged'] =  $this->input->post("value");
        }

        $this->template->display(
            'page_message/list_online',
            array(
                'query'     => $this->Model_message->selectedDataOnline($data),
            )
        );
    }

    public function data_recent()
    {
        $this->Model_message->setTable($this->input->post("table"));
        $this->Model_message->setSelectType("or");
        $id_user = $this->input->post("id");
        $data = array(
            'pengirim' => $id_user,
            'penerima' => $id_user,
        );
        $query_h_message = $this->Model_message->selectedData($data);

        $this->Model_message->setTable("tbl_user");
        $query_user = $this->Model_message->show();

        $this->template->display(
            'page_message/list_recent',
            array(
                'query_h_message'   => $query_h_message,
                'query_user'        => $query_user,
            )
        );
    }

    public function openFormulir(){ 
        $this->Model_message->setTable("tbl_head_message");
        $data = array(
            'pengirim'  => $this->session->userdata("id"),
            'penerima'  => $this->input->post("id"),
        );

        $query_head = $this->Model_message->selectDataHead($data);
        if ($query_head->num_rows()>0) {
            foreach ($query_head->result_array() as $result) {
                $data['id_head']     = $result['id'];
            }
        }else{
            $data['status'] = 0;
            $this->Model_message->insert($data);
            $query_head = $this->Model_message->selectDataHead($data);
            if (!empty($query_head)) {
                foreach ($query_head->result_array() as $result) {
                    $data['id_head']     = $result['id'];
                }
            }
        }

        $this->Model_message->setTable($this->input->post("table"));
        $this->Model_message->setKey($this->input->post("field"));
        $page = $this->input->post("page");

        if (!empty($this->input->post("operasi"))) {
            $operasi    = $this->input->post("operasi");
        }else{
            $operasi    = "";
        }
        $this->template->display(
            'page_'.$page."/form",
            array(
                'pengirim'      => $this->session->userdata("id"),
                'penerima'      => $this->input->post("id"),
                'id_head'       => $data['id_head'] ,
                'operasi'       => $operasi,
            )
        );
    }

    public function openMessage($id){ 
        $this->Model_message->setTable("tbl_head_message");
        $this->Model_message->setKey("id");
        $data_head  = array(
            'id'    => $id,
        );
        $query_head = $this->Model_message->selectedData($data_head);
        if (!empty($query_head)) {
            foreach ($query_head->result_array() as $data) {
                $data = array(
                    'pengirim'  => $data["pengirim"],
                    'penerima'  => $data["penerima"],
                );
            }
        }

        $query_head = $this->Model_message->selectDataHead($data);
        $query_h_message = $query_head;
        if ($query_head->num_rows()>0) {
            foreach ($query_head->result_array() as $result) {
                $data['id_head']     = $result['id'];
            }

            $this->Model_message->setTable("tbl_detail_message");
            $this->Model_message->setKey("id_head");
            $query_d_message = $this->Model_message->selectedData($data);

            $this->Model_message->setTable("tbl_user");
            $query_user = $this->Model_message->show();

            $this->Model_message->setTable("tbl_pengaturan");
            $query_pengaturan = $this->Model_message->show();

        }
        $this->template->display(
            'page_message/pesan',
            array(
                'query_d_message'   => $query_d_message,
                'query_h_message'   => $query_h_message,
                'query_user'        => $query_user,
                'query_pengaturan'  => $query_pengaturan,
            )
        );
    }

    public function updateRead(){
        $this->Model_message->setTable("tbl_head_message");
        $this->Model_message->setKey("id");
        $data = array(
            'id'        => $this->input->post("id"),
            'status'    => 1,
        );
        $this->Model_message->update($data);
    }
}