<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_genre extends CI_Controller {
    private $status = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_genre");
    }

    public function insert()
    {
        $this->Model_genre->setTable($this->input->post("table"));
        $data = array(
            'genre'      => $this->input->post("genre"),
            'keterangan' => $this->input->post("keterangan"),
        );

        $status = $this->Model_genre->insert($data);
        echo json_encode($status);
    }

    public function update()
    {
        $this->Model_genre->setTable($this->input->post("table"));
        $this->Model_genre->setKey($this->input->post("key"));
        $data = array(
            'genre'      => $this->input->post("genre"),
            'keterangan' => $this->input->post("keterangan"),
        );

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_genre->update($data);
        echo json_encode($status);
    }

    public function delete()
    {
        $this->Model_genre->setTable($this->input->post("table"));
        $this->Model_genre->setKey($this->input->post("key"));

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_genre->delete($data);
        echo json_encode($status);
    }

    public function insert_genre()
    {
        $this->Model_genre->setTable("tbl_genre");
        $this->Model_genre->setKey("genre");
        $data = array(
            'id_game'   => $this->input->post("id"),
            'genre'     => $this->input->post("genre"),
        );
        $data_genre = $this->Model_genre->selectedData($data);
        if ($data_genre->num_rows() > 0) {
            $this->Model_genre->setTable("tbl_group_genre");
            foreach ($data_genre->result_array() as $row) {
                $group['id_genre']  = $row['id'];
                $group['id_game']   = $data['id_game'];
            }
            $status = $this->Model_genre->insert($group);
        }else{
            $this->Model_genre->setTable("tbl_genre");
            $genre = array(
                'genre'         => $data['genre'],
                'keterangan'    => "",
            );
            $status = $this->Model_genre->insert($genre);

            $data_genre = $this->Model_genre->selectedData($data);
            foreach ($data_genre->result_array() as $row) {
                $group['id_genre']  = $row['id'];
                $group['id_game']   = $data['id_game'];
            }
            
            $this->Model_genre->setTable("tbl_group_genre");
            $status = $this->Model_genre->insert($group);
        }

        echo json_encode($status);
    }
}