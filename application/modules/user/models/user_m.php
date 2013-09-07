<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/16/13
 * Time: 10:27 AM
 * To change this template use File | Settings | File Templates.
 */

class User_m extends MY_Model{
    protected $_table = 'users';

    public function __construct(){
    parent::__construct();
    }


    public function get_all(){
        parent::select("users.Id, users.Name, users.Email, groups.Name as GroupName, roles.role_name");
        parent::join("groups", "groups.Id = users.GroupId");
        parent::join("roles", "roles.Id = users.RoleId");
        parent::order_by("users.Id","desc");
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

    public function get_role(){

        $query = $this->db->get('roles');
        return $query->result();
    }

    public function get_by_group($group_id){
        parent::where("groupId",$group_id);
        return parent::get_all();
    }

    function count_all(){
        return parent::count_all();
    }

    public function list_user($per_page, $index){
        $page_start = ($index -1) * $per_page;
        parent::select("users.Id, users.Name, users.Email, groups.Name as GroupName, roles.role_name");
        parent::join("groups", "groups.Id = users.GroupId");
        parent::join("roles", "roles.Id = users.RoleId");
        parent::order_by("users.Id","desc");
        parent::limit($per_page, $page_start);
        return parent::get_all();
    }
    public function delete_by($data)
    {
        return $this->db->delete($this->_table, $data);
    }
}