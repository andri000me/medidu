<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_level extends CI_Controller {
    private $status = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_level");
    }

    public function insert()
    {
        $this->Model_level->setTable($this->input->post("table"));
        $data = array(
            'level'     => $this->input->post("level"),
            'exp'       => $this->input->post("exp"),
        );

        $status = $this->Model_level->insert($data);
        echo json_encode($status);
    }

    public function update()
    {
        $this->Model_level->setTable($this->input->post("table"));
        $this->Model_level->setKey($this->input->post("key"));
        $data = array(
            'level'     => $this->input->post("level"),
            'exp'       => $this->input->post("exp"),
        );

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_level->update($data);
        echo json_encode($status);
    }

    public function delete()
    {
        $this->Model_level->setTable($this->input->post("table"));
        $this->Model_level->setKey($this->input->post("key"));

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_level->delete($data);
        echo json_encode($status);
    }

}