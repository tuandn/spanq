<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:00 PM
 * To change this template use File | Settings | File Templates.
 */

class Landmark_m extends MY_Model{

    protected $_table = 'landmarks';
    public function __construct(){
        parent::__construct();
    }
    public function get_all(){
        parent::select("landmarks.Id, landmarks.Name,  areas.Name as AreaName");
        parent::join("areas", "areas.Id = landmarks.AreaId");
        parent::order_by("landmarks.Id","desc");
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

    public function list_landmark($per_page, $index){
        $page_start = ($index -1) * $per_page;
        parent::select("landmarks.Id, landmarks.Name,  areas.Name as AreaName");
        parent::join("areas", "areas.Id = landmarks.AreaId");
        parent::order_by("landmarks.Id","desc");
        parent::limit($per_page, $page_start);
        return parent::get_all();
    }
    public function delete_by($data){
        return $this->db->delete($this->_table, $data);
    }
}