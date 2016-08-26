<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_game_list extends CI_Controller {
    private $status = false;
    private $id     = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_game_list");
        $this->load->helper('download');
    }

    public function openPage($page)
    {
        if (!empty($this->input->get("id"))) {
            $this->id   = $this->input->get("id");
            $this->insertViewers($this->id);

            $this->Model_game_list->setTable("tbl_game");
            $this->Model_game_list->setKey("id");
            $game['id']     = $this->id;
            $query_game     = $this->Model_game_list->selectedData($game);

            $this->Model_game_list->setTable("tbl_group_genre");
            $this->Model_game_list->setKey("id_game");
            $genre['id_game']   = $this->id;
            $query_genre        = $this->Model_game_list->selectedData($genre);

            $this->Model_game_list->setTable("tbl_file_game");
            $this->Model_game_list->setKey("id_game");
            $file['id_game']    = $this->id;
            $query_file         = $this->Model_game_list->selectedData($file);

            $setReturn  = array(
                'query_game'     => $query_game,
                'query_genre'    => $query_genre,
                'query_file'     => $query_file,
            );
        }else{
            $this->id   = 0;
        }

        $this->template->display(
            'page_game_list/'.$page, 
            $setReturn
        );
    }

    private function insertViewers($id)
    {
        $this->Model_game_list->setTable("tbl_game");
        $this->Model_game_list->setKey("id");

        $data = array(
            'id'   => $id,
        );

        $query = $this->Model_game_list->selectedData($data);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $result) {
                $data['game']       = $result['game'];
                $data['viewers']    = $result['viewers'];
            }
            $data['viewers']        = $data['viewers']+1;
            $this->Model_game_list->update($data);
        }

        //echo json_encode($status);
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

    public function playGame()
    {
        $this->Model_game_list->setTable("tbl_file_game");
        $this->Model_game_list->setKey("file");

        $file       = $this->input->post("file");
        $data       = array(
            'file'  => $file,
        );
        $query = $this->Model_game_list->selectedData($data);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $data) {
                $deskripsi = $data['deskripsi'];
            }
        }else{
            $deskripsi = "";
        }


        $this->template->display(
            'page_game_list/play_game', 
            array(
                'file'      => $file,
                'deskripsi' => $deskripsi,
            )
        );
    }

    public function downloadGame($file)
    {
        //$file   = $this->input->post("file");
        force_download('./file/games/'.$file, NULL);
    }
}