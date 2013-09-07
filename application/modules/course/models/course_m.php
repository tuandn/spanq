<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:51 PM
 * To change this template use File | Settings | File Templates.
 */

class Course_m extends MY_Model
{


    protected $_table = 'gameparameters';

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

    public function get_list_course()
    {
        $this->_table = "gameparameters";
        parent::select("gameparameters.Id, gameparameters.StartTime, gametypes.Name as Type, areas.Name as AreaName, gameparameters.GameName, gameparameters.Completed");
        parent::join("gametypes", "gametypes.Id = gameparameters.GameTypeId");
        parent::join("areas", "areas.Id = gameparameters.AreaId");
        parent::where("gameparameters.UserId", $this->session->userdata("Id"));
        parent::where("gameparameters.IsCourse", "1");
        parent::order_by("gameparameters.Id", "desc");
        return parent::get_all();
    }

}