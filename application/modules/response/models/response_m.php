<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 26/06/2013
 * Time: 23:19
 * To change this template use File | Settings | File Templates.
 */

class Response_m extends MY_Model
{
    protected $_table = 'responses';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        parent::select("responses.Id, responses.Answer,  challenges.Description");
        parent::join("challenges", "challenges.Id = responses.ChallengeId");
        parent::order_by("responses.Id", "desc");
        return parent::get_all();
    }

    public function insert($data)
    {
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

    public function delete_by($data){
        return $this->db->delete($this->_table, $data);
    }

    function count_all()
    {
        return parent::count_all();
    }

    public function get_by_challenge($challengeId){
        parent::where("ChallengeId",$challengeId);
        return parent::get_all();
    }

    public function list_response($per_page, $index)
    {
        $page_start = ($index - 1) * $per_page;
        parent::select("responses.Id, responses.Answer,  challenges.Description");
        parent::join("challenges", "challenges.Id = responses.ChallengeId");
        parent::order_by("responses.Id", "desc");
        parent::limit($per_page, $page_start);
        return parent::get_all();
    }

    public function get_status_option($value = "")
    {
        $this->_table = "status";
        $query = parent::get_all();
        $cboStatus = "<select name=\"cboStatus\" style=\"width: 150px;\">";
        foreach ($query as $item) {
            $s = ($value != "" && $value == $item->Value) ? "selected" : "";
            $cboStatus .= '<option value="' . $item->Value . '" ' . $s . '>' . $item->Text . '</option>';
        }
        $cboStatus .= "</select>";
        return $cboStatus;
    }
}