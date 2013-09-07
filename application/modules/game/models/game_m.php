<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 24/07/2013
 * Time: 23:13
 * To change this template use File | Settings | File Templates.
 */

class Game_m extends MY_Model
{

    protected $_table = "gameparameters";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_games()
    {
        $this->_table = "gameparameters";
        parent::select("gameparameters.Id, gameparameters.StartTime, gametypes.Name as Type, areas.Name as AreaName, gameparameters.GameName, gameparameters.Completed");
        parent::join("gametypes", "gametypes.Id = gameparameters.GameTypeId");
        parent::join("areas", "areas.Id = gameparameters.AreaId");
        parent::where("gameparameters.UserId", $this->session->userdata("Id"));
        parent::order_by("gameparameters.Id", "desc");
        return parent::get_all();
    }

    //get game type and game parameter
    public function m_get_game($Id)
    {
        parent::join("gametypes", "gameparameters.GameTypeId = gametypes.Id");
        parent::where("gameparameters.Id", $Id);
        return parent::get_by();
    }

    //get area by id
    public function m_get_area_id($areaId)
    {
        $this->_table = "areas";
        parent::where("Id", $areaId);
        return parent::get_by();
    }

    public function get_team_by_game_id($game_id)
    {
        $this->_table = "teams";
        parent::where("teams.GameParameterId", $game_id);
        return parent::get_all();
    }

    public function  count_station_comp_by_access_code($access_code)
    {
        $this->_table = "tempstation";
        parent::where("Access_Code", $access_code);
        return count(parent::get_all());
    }

    public function get_no_of_station_by_access_code($access_code)
    {
        $game_id = $this->get_game_id_by_access_code($access_code);
        $this->_table = "gameparameters";
        parent::where("Id", $game_id);
        $game = parent::get_by();
        return $game->NoOfStations;
    }

    public function  get_game_id_by_access_code($access_code)
    {
        $this->_table = "teams";
        parent::where("AccessCode", $access_code);
        $team = parent::get_by();
        return $team->GameParameterId;
    }


}