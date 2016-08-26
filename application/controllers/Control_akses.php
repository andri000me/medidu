<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_akses extends CI_Controller {
    private $status = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_akses");
    }

    public function insert()
    {
        $this->Model_akses->setTable($this->input->post("table"));
        $data = array(
            'akses'      => $this->input->post("akses"),
            'keterangan' => $this->input->post("keterangan"),
        );

        $status = $this->Model_akses->insert($data);
        echo json_encode($status);
    }

    public function update()
    {
        $this->Model_akses->setTable($this->input->post("table"));
        $this->Model_akses->setKey($this->input->post("key"));
        $data = array(
            'akses'      => $this->input->post("akses"),
            'keterangan' => $this->input->post("keterangan"),
        );

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_akses->update($data);
        echo json_encode($status);
    }

    public function delete()
    {
        $this->Model_akses->setTable($this->input->post("table"));
        $this->Model_akses->setKey($this->input->post("key"));

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_akses->delete($data);
        echo json_encode($status);
    }

}