<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 23/06/2013
 * Time: 16:22
 * To change this template use File | Settings | File Templates.
 */

class Setting_m extends MY_Model
{
    protected $_table = "challengesettings";

    public function __construct()
    {
        parent::__construct();
    }

    public function update_check_in_setting_by($id = 1, $data){
        $this->_table = "checkinsettings";
        return parent::update($id, $data ,FALSE);
    }

    public function update_who_am_i_setting_by($id = 1, $data){
        $this->_table = "whoami_setting";
        return parent::update($id, $data ,FALSE);
    }

    public function get_check_in_by($id = 1){
        $this->_table = "checkinsettings";
        return parent::get($id);
    }

    public function get_who_am_i($id = 1){
        $this->_table = "whoami_setting";
        return parent::get($id);
    }

    public function update_challenge_setting_by($id = 1, $data){
        return parent::update($id, $data ,FALSE);
    }

    public function get_challenge_by($id = 1){
         return parent::get($id);
    }

    public function count_all(){
        $this->_table = "murdermysterysettings";
        return parent::count_all();
    }

    public function list_murder(){
        $this->_table = "murdermysterysettings";
        parent::order_by("Id","desc");
        return parent::get_all();
    }

    public function insert_murder($data){
        $this->_table = "murdermysterysettings";
        return parent::insert($data);
    }

    public function update_murder($id, $data){
        $this->_table = "murdermysterysettings";
        return parent::update($id, $data);
    }

    public function get_murder_by($id){
        $this->_table = "murdermysterysettings";
        return parent::get($id);
    }

    public function delete_by($data){
        return $this->db->delete("murdermysterysettings", $data);
    }

}