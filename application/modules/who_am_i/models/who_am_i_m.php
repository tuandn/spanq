<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 26/07/2013
 * Time: 23:40
 * To change this template use File | Settings | File Templates.
 */

class Who_am_i_m extends MY_Model
{
    protected $_table = "who_am_i_answer";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return parent::get_all();
    }

    public function insert($data)
    {
        return parent::insert($data, FALSE);
    }

    public function insert_clue($data)
    {
        $this->_table = "who_am_i_clue";
        return parent::insert($data, FALSE);
    }

    public function update_by($id, $data)
    {
        return parent::update($id, $data, FALSE);
    }

    public function get_by($id)
    {
        return parent::get($id);
    }

    function count_all()
    {
        return parent::count_all();
    }

    public function delete_by($data)
    {
        $this->_table = "who_am_i_answer";
        return $this->db->delete($this->_table, $data);
    }

    public function get_clue_by_answer_id($answer_id)
    {
        $this->_table = "who_am_i_clue";
        parent::where("AnswerId", $answer_id);
        parent::order_by("Position","asc");
        return parent::get_all();
    }

    public function delete_clue_by($data)
    {
        $this->_table = "who_am_i_clue";
        return $this->db->delete($this->_table, $data);
    }
}