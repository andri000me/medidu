<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_game extends CI_Controller {
    private $status = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_game");
    }

    public function page($page){
        $this->Model_game->setTable("tbl_game");

        $this->template->display(
            'page_game/'.$page,
            array(
                'query'     => $this->Model_game->show(),
            )
        );
    }   

    public function openPage($page)
    {
        $operasi= $this->input->post("operasi");
        if ($page == "detail") {
            $this->Model_game->setTable("tbl_game");
            $this->Model_game->setKey("id");

            $game = array(
                'id'        => $this->input->get("id"),
            );
            $data = array(
                'id_game'   => $this->input->get("id"),
            );

            $query      = $this->Model_game->selectedData($game);

            $this->Model_game->setKey("id_game");
            $this->Model_game->setTable("tbl_soal");
            $query_soal = $this->Model_game->selectedData($data);

            $this->Model_game->setTable("tbl_file_game");
            $query_file = $this->Model_game->selectedData($data);

            $this->Model_game->setTable("tbl_group_genre");
            $query_genre= $this->Model_game->selectedData($data);

            $setReturn  = array(
                'query'         => $query,
                'query_soal'    => $query_soal,
                'query_genre'   => $query_genre,
                'query_file'    => $query_file,
                'operasi'       => $operasi,
                'id'            => $this->input->get("id"),
            );
        }else{
            $this->Model_game->setTable($this->input->post("table"));
            $this->Model_game->setKey($this->input->post("field"));

            $data   = array(
                'id'    => $this->input->post("id"),
            );
            $id         = $this->input->post("id");

            $setReturn  = array(
                'query'     => $this->Model_game->selectedData($data),
                'operasi'   => $operasi,
                'id'        => $this->input->post("id"),
            );
        }

        $this->template->display(
            'page_game/'.$page,
            $setReturn
        );
    }

    public function insert()
    {
        $this->Model_game->setTable($this->input->post("table"));
            $data = array(
                'game'      => $this->input->post("game"),
                'deskripsi' => $this->input->post("deskripsi"),
                'viewers'   => $this->input->post("viewers"),
                'likes'     => $this->input->post("likes"),
                'download'  => $this->input->post("download"),
                'enabled'   => $this->input->post("enabled"),
            );
        
        if (!empty($data)) {
            $status = $this->Model_game->insert($data);
        }
        echo json_encode($status);
    }

    public function update()
    {
        $this->Model_game->setTable($this->input->post("table"));
        $this->Model_game->setKey($this->input->post("key"));

            $data = array(
                'game'      => $this->input->post("game"),
                'deskripsi' => $this->input->post("deskripsi"),
                'viewers'   => $this->input->post("viewers"),
                'likes'     => $this->input->post("likes"),
                'download'  => $this->input->post("download"),
                'enabled'   => $this->input->post("enabled"),
            );

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_game->update($data);
        echo json_encode($status);
    }

    public function updateEnabled()
    {
        $this->Model_game->setTable($this->input->post("table"));
        $this->Model_game->setKey($this->input->post("key"));

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id']         =  $this->input->post("id");
            $data['enabled']    =  $this->input->post("enabled");
        }

        $status = $this->Model_game->update($data);
        echo json_encode($status);
    }

    public function delete()
    {
        $this->Model_game->setTable($this->input->post("table"));
        $this->Model_game->setKey($this->input->post("key"));

        if (!empty($this->input->post("id")) ||  $this->input->post("id") != 0) {
            $data['id'] =  $this->input->post("id");
        }

        $status = $this->Model_game->delete($data);
        echo json_encode($status);
    }

    public function lookUp($type)
    {
        $keyword    = array(
            'keyword'   => $this->input->post('term'),
            'table'     => "tbl_genre",
            'field'     => "genre",
        );

        $data['response'] = 'false';
        $query = $this->Model_game->find($keyword);
        if (!empty($query)) {
            $data['response'] = 'true';
            $data['message'] = array();
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id'    => $row['id'],
                    'value' => $row[$keyword['field']]//." - ".$row['spesifikasi'],
                );
            }
        }
        echo json_encode($data);
    }

}