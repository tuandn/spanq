<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 22/06/2013
 * Time: 16:09
 * To change this template use File | Settings | File Templates.
 */

class Challenge_m extends MY_Model{

    protected $_table = 'challenges';
    public function __construct(){
        parent::__construct();
    }
    public function get_all(){
        return parent::get_all();
    }

    public function insert($data){
        return parent::insert($data, FALSE);
    }

    public function insert_c_s_temp($data){
        $this->_table = 'c_s_temp';
        return parent::insert($data, FALSE);
    }

    public function update_by($id, $data){
        return parent::update($id, $data ,FALSE);
    }

    public function get_by($id){
        return parent::get($id);
    }

    public function get_c_s_temp_by_challengeId($id){
        $this->_table = 'c_s_temp';
        parent::select("c_s_temp.ChallengeId, c_s_temp.StationId, stations.Name as StationName");
        parent::where("ChallengeId",$id);
        parent::join("stations","stations.Id = c_s_temp.StationId");
        return parent::get_all($id);
    }

    function count_all(){
        return parent::count_all();
    }

    public function list_challenge($per_page, $index){
        $page_start = ($index -1) * $per_page;
        parent::order_by("Id","desc");
        parent::limit($per_page, $page_start);
        return parent::get_all();
    }

    public function get_station_paging($per_page, $index){
        $this->_table="stations";
        $page_start = ($index -1) * $per_page;
        parent::order_by("Id","desc");
        parent::limit($per_page, $page_start);
        return parent::get_all();
    }

    public function get_challenge_cbo($id = 0){
        $query = $this->get_all();
        $str = "<select name=\"cbChallenge\" style=\"width: 300px;\">";
        foreach ($query as $rs) {
            $s = ($id != 0 && $id == $rs->Id) ? "selected" : "";
            $str .= '<option value="' . $rs->Id . '" ' . $s . '>' . $rs->Description . '</option>';
        }
        $str .= '</select>';
        return $str;
    }

    public function station_total_page($page_size){
        $total_page = 1;
        $this->_table="stations";
        $row = parent::count_all();
        if($row > $page_size){
            $total_page =  ceil($row/$page_size);
        }
        return $total_page;
    }

    public function addcstemp($data){
        $this->_table = 'c_s_temp';
        return $this->insert($data);
    }

    public function removecstemp($data){
        return $this->db->delete('c_s_temp', $data);
    }


    public function delete_by($data){
        return $this->db->delete($this->_table, $data);
    }
}