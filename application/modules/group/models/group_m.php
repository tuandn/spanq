<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/15/13
 * Time: 7:34 PM
 * To change this template use File | Settings | File Templates.
 */

class Group_m extends MY_Model
{
    protected $_table = 'groups';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        parent::select("groups.Id, groups.Name, areas.Name as AreaName");
        parent::join("areas", "areas.Id = groups.AreaId");
        parent::order_by("groups.Id", "desc");
        return parent::get_all();
    }

    public function insert($data)
    {
        return parent::insert($data, FALSE);
    }

    function update_by($id, $data)
    {
        return parent::update($id, $data, FALSE);
    }

    function get_by($id)
    {
        return parent::get($id);
    }

    function count_all()
    {
        return parent::count_all();
    }

    public function list_group($per_page, $index)
    {
        $page_start = ($index - 1) * $per_page;
        parent::select("groups.Id, groups.Name, areas.Name as AreaName");
        parent::join("areas", "areas.Id = groups.AreaId");
        parent::order_by("groups.Id", "desc");
        parent::limit($per_page, $page_start);
        return parent::get_all();
    }

    public function get_total_page($per_page)
    {
        $c = $this->count_all();
        $total = 1;
        if ($c % $per_page == 0) {
            $total = $c / $per_page;
        } else {
            $total = round($c / $per_page) + 1;
        }
        return $total;
    }

    public function delete_by($data)
    {
        return $this->db->delete($this->_table, $data);
    }

    public function get_group_user($group_id)
    {
        $this->_table = "groupusers";
        parent::select("groupusers.GroupId, groupusers.UserId, users.Name");
        parent::join("users", "users.Id = groupusers.UserId");
        parent::where("groupusers.GroupId", $group_id);
        return parent::get_all();
    }

    public function add_group_user($data){
        $this->_table = "groupusers";
        return parent::insert($data);
    }

    public function delete_group_user($data)
    {
        $this->_table = "groupusers";
        return $this->db->delete($this->_table, $data);
    }
}