<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_soal extends CI_Controller {
    private $status = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_soal");
    }

    public function insert()
    {
        $this->Model_soal->setTable($this->input->post("table"));
            $data = array(
                'id_game'   => $this->input->post("id_game"),
                'soal'      => $this->input->post("soal"),
                'jawaban_a' => $this->input->post("jawaban_a"),
                'jawaban_b' => $this->input->post("jawaban_b"),
                'jawaban_c' => $this->input->post("jawaban_c"),
                'enabled'   => $this->input->post("enabled"),
                'exp'       => $this->input->post("exp"),
            );

        $status = $this->Model_soal->insert($data);
        echo json_encode($status);
    }

    public function update()
    {
        $this->Model_soal->setTable($this->input->post("table"));
        $this->Model_soal->setKey($this->input->post("key"));
            $data = array(
                'id_game'   => $this->input->post("id_game"),
                'soal'      => $this->input->post("soal"),
                'jawaban_a' => $this->input->post("jawaban_a"),
                'jawaban_b' => $this->input->post("jawaban_b"),
                'jawaban_c' => $this->input->post("jawaban_c"),
                'enabled'   => $this->input->post("enabled"),
                'exp'       => $this->input->post("exp"),
            );

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_soal->update($data);
        echo json_encode($status);
    }

    public function delete()
    {
        $this->Model_soal->setTable($this->input->post("table"));
        $this->Model_soal->setKey($this->input->post("key"));

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_soal->delete($data);
        echo json_encode($status);
    }
}