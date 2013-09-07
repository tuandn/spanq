<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:51 PM
 * To change this template use File | Settings | File Templates.
 */

class Station_m extends MY_Model{


    protected $_table = 'stations';
    public function __construct(){
        parent::__construct();
    }
    public function get_all(){
        parent::select("stations.Id, stations.Name,  areas.Name as AreaName");
        parent::join("areas", "areas.Id = stations.AreaId");
        parent::order_by("stations.Id","desc");
        return parent::get_all();
    }

    public function insert($data){
        return parent::insert($data, FALSE);
    }

    public function update_by($id, $data){
        return parent::update($id, $data ,FALSE);
    }

    public function get_by($id){
        return parent::get($id);
    }

    function count_all(){
        return parent::count_all();
    }

    public function list_station($per_page, $index){
        $page_start = ($index -1) * $per_page;
        parent::select("stations.Id, stations.Name,  areas.Name as AreaName");
        parent::join("areas", "areas.Id = stations.AreaId");
        parent::order_by("stations.Id","desc");
        parent::limit($per_page, $page_start);
        return parent::get_all();
    }

    public function get_challenge_by_station($station_id)
    {
        $this->_table = 'c_s_temp';
        parent::select("c_s_temp.ChallengeId, challenges.Type,  challenges.Difficulty, challenges.Description");
        parent::join("challenges", "challenges.Id = c_s_temp.ChallengeId");
        parent::where("c_s_temp.StationId", $station_id);
        return parent::get_all();
    }

    public function addcstemp($data){
        $this->_table = 'c_s_temp';
        return $this->insert($data);
    }

    public function removecstemp($data){
        //$this->_table = 'c_s_temp';
        //return parent::delete($data);
        return $this->db->delete('c_s_temp', $data);
    }
    public function delete_by($data){
        return $this->db->delete($this->_table, $data);
    }
}