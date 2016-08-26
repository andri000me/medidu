<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_file extends CI_Controller {
    private $status = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_file");
    }

    public function uploadFile()
    {
        $new_name                   = time()."_file_user";
        $config['file_name']        = $new_name;
        $config['upload_path']      = './file/images/users/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = '0';
        $config['max_width']        = '0';
        $config['max_height']       = '0';

        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        if ($this->upload->do_upload("file")) {
            $this->response = $this->upload->data();
            $status['file_type']= $this->response['file_type'];
            $status['operasi']  = "create";
            $status['name_file']= $this->response['file_name'];
            $status['status']   = true;

        }else{
            $status['error']    = $this->upload->display_errors();
            $status['status']   = false;
        }
        echo json_encode($status);
    }

    public function uploadFileSWF()
    {
        $new_name                   = time()."_games";
        $config['file_name']        = $new_name;
        $config['upload_path']      = './file/games/';
        $config['allowed_types']    = 'swf|SWF';
        $config['max_size']         = 0;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload("file")) {
            $this->response = $this->upload->data();
            $status['file_type']= $this->response['file_type'];
            $status['operasi']  = "create";
            $status['name_file']= $this->response['file_name'];
            $status['status']   = true;

        }else{
            $status['error']    = $this->upload->display_errors();
            $status['status']   = false;
        }
        echo json_encode($status);
    }

    public function insert()
    {
        $this->Model_file->setTable($this->input->post("table"));
            $data = array(
                'id_game'   => $this->input->post("id_game"),
                'file'      => $this->input->post("file"),
                'deskripsi' => $this->input->post("deskripsi"),
                'versi'     => $this->input->post("versi"),
                'enabled'   => $this->input->post("enabled"),
            );

        $status = $this->Model_file->insert($data);
        echo json_encode($status);
    }

    public function insertFile()
    {
        $this->Model_file->setTable($this->input->post("table"));
        $data = array(

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
                'jawaban_d' => $this->input->post("jawaban_d"),
                'enabled'   => $this->input->post("enabled"),
            );

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_soal->update($data);
        echo json_encode($status);
    }

    public function delete()
    {
        $this->Model_file->setTable($this->input->post("table"));
        $this->Model_file->setKey($this->input->post("key"));

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_file->delete($data);
        echo json_encode($status);
    }
}