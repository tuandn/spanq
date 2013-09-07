<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 01/07/2013
 * Time: 23:47
 * To change this template use File | Settings | File Templates.
 */

class Activity_m extends MY_Model{

    private $_data = array();

    protected $_table = "join_game";

    public function __construct(){
        parent::__construct();
    }

    public function get_latest_challenge(){
        parent::select("join_game.createdate, stations.Name as station_name, teams.Name as team_name, join_game.status");
        parent::join("stations","stations.Id = join_game.stationId");
        parent::join("teams","teams.AccessCode = join_game.access_code");
        parent::order_by("createdate","desc");
        parent::limit(5,0);
        return parent::get_all();
    }

    public function get_latest_games(){
        $this->_table = "gameparameters";
        parent::select("gameparameters.StartTime, gametypes.Name as Type, areas.Name as AreaName, gameparameters.Completed");
        parent::join("gametypes","gametypes.Id = gameparameters.GameTypeId");
        parent::join("areas","areas.Id = gameparameters.AreaId");
        parent::where("gameparameters.UserId",$this->session->userdata("Id"));
        parent::order_by("StartTime","desc");
        parent::limit(5,0);
        return parent::get_all();
    }
}