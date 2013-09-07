<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:51 PM
 * To change this template use File | Settings | File Templates.
 */

class Start_game_m extends MY_Model
{


    protected $_table = 'stations';

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

    public function list_station($per_page, $index)
    {
        $page_start = ($index - 1) * $per_page;
        parent::select("stations.Id, stations.Name,  areas.Name as AreaName");
        parent::join("areas", "areas.Id = stations.AreaId");
        parent::order_by("stations.Id", "desc");
        parent::limit($per_page, $page_start);
        return parent::get_all();
    }

    public function get_challenge_by_station($station_id)
    {
        $this->_table = 'c_s_temp';
        parent::select("c_s_temp.ChallengeId, challenges.Type,  challenges.Difficulty, challenges.Description");
        parent::join("challenges", "challenges.Id = c_s_temp.ChallengeId");
        parent::where("c_s_temp.StationId", $station_id);
        parent::where("challenges.Type", "Question");
        return parent::get_all();
    }

    public function get_game_hq($game_id)
    {
        $this->_table = 'game_hq';
        parent::where("game_id", $game_id);
        return parent::get_by();
    }

    public function insert_game_hq($data)
    {
        $this->_table = 'game_hq';
        return $this->insert($data);
    }

    public function delete_game_hq($data)
    {
        return $this->db->delete('game_hq', $data);
    }

    public function addcstemp($data)
    {
        $this->_table = 'c_s_temp';
        return $this->insert($data);
    }

    public function removecstemp($data)
    {
        //$this->_table = 'c_s_temp';
        //return parent::delete($data);
        return $this->db->delete('c_s_temp', $data);
    }

    public function delete_by($data)
    {
        return $this->db->delete($this->_table, $data);
    }

    //get game type
    public function get_game_type()
    {
        $this->_table = 'gametypes';
        return parent::get_all();
    }

    //get question difficult
    public function  get_areas()
    {
        $this->_table = "areas";
        return parent::get_all();
    }

    //get time limit
    public function get_time_limit()
    {
        $this->_table = "timelimit";
        return parent::get_all();
    }

    //insert game parameter
    public function m_insert_game_parameters($data)
    {
        $this->_table = 'gameparameters';
        return parent::insert($data);
    }

    //insert teams
    public function m_insert_teams($data, $access_code)
    {
        $check_exist = $this->m_check_exist_access_code($access_code);
        if ($check_exist) {
        } else {
            $this->_table = 'teams';
            return parent::insert($data);
        }


    }

    //check exist access code for teams
    public function m_check_exist_access_code($access_code)
    {
        $this->_table = 'teams';
        parent::where("AccessCode", $access_code);
        $exist = parent::get_all();
        if ($exist) {
            return true;
        } else {
            return false;
        }
    }

    //update list station game parameter
    public function update_by_game_parameters($id, $data)
    {
        $this->_table = 'gameparameters';
        return parent::update($id, $data, FALSE);
    }

    //get station by area id
    public function get_station_by_area_id($area_id, $no_of)
    {
        $this->_table = 'stations';
        parent::where("AreaId", $area_id);
        parent::limit($no_of, 0);
        return parent::get_all();
    }

    public function check_station_by_area_id($area_id)
    {
        $this->_table = 'stations';
        parent::where("AreaId", $area_id);
        return parent::get_all();
    }

    //get all station
    public function  get_all_station($area_id)
    {
        $this->_table = 'stations';
        parent::where('AreaId',$area_id);
        return parent::get_all();
    }

    //get game parameter by id
    public function get_game_parameter_by_id($id)
    {
        $this->_table = 'gameparameters';
        parent::where("Id", $id);
        return parent::get_by();
    }

    public function m_insert_g_s_temp_first($gameId, $stationId)
    {
        $this->_table = 'g_s_temp';
        parent::where("GameParameterId", $gameId);
        parent::where("StationId", $stationId);
        $result = parent::get_by();
        if (count($result) != 0) {
            return true;
        } else {
            $data = array(
                "GameParameterId" => $gameId,
                "StationId" => $stationId
            );
            return parent::insert($data);
        }

    }


    //insert date into game parameter station temp
    public function m_insert_g_s_temp($data)
    {
        $this->_table = 'g_s_temp';
        return parent::insert($data);

    }

    //update no of teams game parameters
    public function m_update_no_of_team_game($gameId, $NoOfTeam)
    {
        $this->_table = 'gameparameters';
        $this->db->where("Id", $gameId);
        $this->db->update($this->_table, array("NoOfTeam" => $NoOfTeam));
        return true;
    }

    //delete g_s_temp data
    public function  m_delete_g_s_temp($data)
    {
        return $this->db->delete('g_s_temp', $data);
    }

    //get data from table gs_temp
    public function m_get_g_s_temp($id)
    {
        $this->_table = 'g_s_temp';
        parent::select("g_s_temp.StationId, g_s_temp.StationId, stations.Name");
        parent::where("GameParameterId", $id);
        parent::join("stations", "stations.Id = g_s_temp.StationId");
        return parent::get_all();
    }

    //get station by id
    public function m_get_station_by_id($Id)
    {
        $this->_table = 'stations';
        parent::where("Id", $Id);
        return parent::get_by();
    }

    //get game type and game parameter
    public function m_get_game($Id)
    {
        $this->_table = 'gameparameters';
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

    //count station max
    public function get_count_g_s_temp($Id)
    {
        $this->_table = 'g_s_temp';
        parent::where("GameParameterId", $Id);
        return parent::get_all();
    }

    //check exist
    public function check_count_g_s_temp($game_id, $station_id)
    {
        $this->_table = 'g_s_temp';
        parent::where("GameParameterId", $game_id);
        parent::where("StationId", $station_id);
        return parent::get_all();
    }

    //get final standing of list team
    public function m_get_final_standing_team($Id)
    {
        $this->_table = 'gameparameters';
        parent::join("teams", "teams.GameParameterId = gameparameters.Id");
        parent::where("gameparameters.Id", $Id);
        parent::order_by("TotalPoint", "DESC");
        return parent::get_all();
    }

    //get all with game parameter id
    public function m_get_team_game_game_parameters_id($game_id)
    {
        $this->_table = 'teams';
        parent::order_by("Name", " ASC");
        parent::where("GameParameterId", $game_id);
        return parent::get_all();

    }

}