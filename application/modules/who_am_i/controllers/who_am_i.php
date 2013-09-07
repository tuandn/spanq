<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 26/07/2013
 * Time: 23:38
 * To change this template use File | Settings | File Templates.
 */

class Who_am_i extends Admin_Controller
{
    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('who_am_i_m'));
    }

    public function index()
    {
        $this->_data['list_who_am_i_m'] = $this->who_am_i_m->get_all();

        $this->template
            ->set_metadata('description', 'who am i')
            ->set_metadata('keywords', 'who am i')
            ->title('who am i')
            ->build('who_am_i', $this->_data, FALSE);
    }


    public function insert_clue()
    {
        $position = $_POST["position"];
        $answer_id = $_POST["answer_id"];
        $clue = $_POST["clue"];

        $data = array(
            "Clue" => $clue,
            "Position" => $position,
            "AnswerId" => $answer_id
        );

        echo $this->who_am_i_m->insert_clue($data);
    }

    public function delete_clue()
    {
        $Id = $_POST['Id'];

        $data = array(
            "Id" => $Id
        );
        return $this->who_am_i_m->delete_clue_by($data);
    }

    public function add()
    {

        $this->template
            ->set_metadata('description', 'who am i')
            ->set_metadata('keywords', 'who am i')
            ->title('who am i')
            ->build('who_am_i_add', $this->_data, FALSE);
    }

    public function insert()
    {

        $data = array(
            'Answer' => $this->input->post('txtAnswer')
        );
        if (!$this->who_am_i_m->insert($data)) {
            redirect("who_am_i/add");
        } else {
            redirect("who_am_i");
        }

    }

    public function edit()
    {
        $id = $_REQUEST["Id"];
        $who_am_i = $this->who_am_i_m->get_by($id);
        $this->_data["who_am_i"] = $who_am_i;
        $this->_data["list_clue"] = $this->who_am_i_m->get_clue_by_answer_id($who_am_i->Id);


        $this->template
            ->set_metadata('description', 'who am i')
            ->set_metadata('keywords', 'who am i')
            ->title('who am i')
            ->build('who_am_i_edit', $this->_data, FALSE);
    }

    public function update()
    {
        $id = $this->input->post('txtId');
        $data = array(
            'Answer' => $this->input->post('txtAnswer')
        );
        if (!$this->who_am_i_m->update_by($id, $data)) {
            redirect("who_am_i/edit?Id=" . $id);
        } else {
            redirect("who_am_i");
        }

    }

    public function delete_by()
    {
        $Id = $_POST['Id'];

        $data = array(
            "Id" => $Id
        );
        return $this->who_am_i_m->delete_by($data);
    }

}