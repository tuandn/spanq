<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/14/13
 * Time: 9:24 PM
 * To change this template use File | Settings | File Templates.
 */

class api_m extends MY_Model
{
    var $_table = 'teams';

    public function __contruct()
    {
        parent::__construct();
    }

    public function m_joingame($access_code)
    {
        $this->_table = 'teams';
        parent::select("gameparameters.Id,teams.Name,teams.AccessCode,
        teams.TotalPoint,teams.GameParameterId,teams.StatusText,gameparameters.Enabled20Quetion,
        gameparameters.QuestionDifficulty,gameparameters.AreaId,gameparameters.NoOfStations,gameparameters.NoOfTeam,
        gameparameters.AllowPossible,gameparameters.ListTeamId,gameparameters.TimeLimit,gameparameters.StartTime,
        gameparameters.TimeRemain,gameparameters.phonehint,gameparameters.GameTypeId");
        parent::join("gameparameters", "gameparameters.Id = teams.GameParameterId");
        parent::join("gametypes", "gameparameters.GameTypeId = gametypes.Id");
        parent::where("teams.AccessCode", $access_code);
        return parent::get_by();

    }

    public function m_latestclude($access_code)
    {
        parent::join("gameparameters", "gameparameters.Id = teams.GameParameterId");
        parent::join("areas", "areas.Id = gameparameters.AreaId");
        parent::join("stations", "stations.AreaId = areas.Id");
        parent::where("teams.AccessCode", $access_code);
        return parent::get_by();

    }

    public function m_checkincurrentlocation($access_code, $station_id)
    {
        parent::join("gameparameters", "gameparameters.Id = teams.GameParameterId");
        parent::join("areas", "areas.Id = gameparameters.AreaId");
        parent::join("stations", "stations.AreaId = areas.Id");
        parent::where("teams.AccessCode", $access_code);
        parent::where("stations.Id", $station_id);
        return parent::get_by();

    }

    public function m_challenges_hint($challenge_id, $difficulty = "")
    {
        $this->_table = "challenges";
        parent::where("challenges.Id", $challenge_id);
        if($difficulty != "")
            parent::where("challenges.Difficulty", $difficulty);
        return parent::get_by();
    }

    public function m_challenges_info($difficulty)
    {
        $this->_table = "challenges";
        parent::join("responses", "responses.ChallengeId = challenges.Id");
        parent::where("challenges.Difficulty", $difficulty);
        return parent::get_all();
    }

    public function m_challenges_status($Id)
    {
        $this->_table = "challenges";
        parent::join("responses", "responses.ChallengeId = challenges.Id");
        parent::where("challenges.Id", $Id);
        return parent::get_by();
    }

    //get status is challengeId and difficulty
    public function m_challenges($Id, $difficulty = "")
    {
        $this->_table = "challenges";
        parent::join("responses", "responses.ChallengeId = challenges.Id");
        parent::where("challenges.Id", $Id);
//      parent::where("challenges.Difficulty", $difficulty);
        return parent::get_by();
    }

    public function m_getgamestanding($access_code)
    {
        parent::join("finalstandings", "finalstandings.TeamId = Teams.Id");
        parent::where("teams.AccessCode", $access_code);
        return parent::get_by();

    }

    public function m_listteam_standing($GameParameterId)
    {
        parent::where("teams.GameParameterId", $GameParameterId);
        parent::order_by("teams.totalpoint", "DESC");
        parent::order_by("time_temp", "ASC");
        return parent::get_all();

    }

    public function m_game_types($game_types_id)
    {
        $this->_table = "gametypes";
        parent::where("gametypes.Id", $game_types_id);
        return parent::get_by();

    }

    public function m_stations($stations_id)
    {
        $this->_table = "stations";
        parent::where("stations.Id", $stations_id);
        return parent::get_by();

    }

    public function m_stations_difficulty($stations_id, $diff)
    {
        $this->_table = "stations";
        parent::where("stations.Id", $stations_id);
        parent::where("stations.Difficulty", $diff);
        return parent::get_by();

    }

    public function m_station_detail_by_level_difficulty($difficulty, $stationId)
    {
        $this->_table = "stations";
        parent::where("stations.Difficulty", $difficulty);
        parent::where("stations.Id", $stationId);
        return parent::get_by();

    }

    public function m_insert_temp_station($access_code, $stations_id)
    {
        $this->_table = "tempstation";
        parent::where("StationId", $stations_id);
        parent::where("Access_Code", $access_code);
        $result = parent::get_by();

        if (count($result) == 0) {
            $data = array(
                "Access_Code" => $access_code,
                "StationId" => $stations_id
            );
            parent::insert($data);
            return true;
        } else {
            return false;
        }

    }

    public function m_insert_temp_station_join_game($access_code, $stationId, $GameId)
    {
        $this->_table = "tempstation";
        parent::where("StationId", $stationId);
        parent::where("GameId", $GameId);
        parent::where("Access_Code", $access_code);
        $result = parent::get_by();

        if (count($result) == 0) {
            $data = array(
                "Access_Code" => $access_code,
                "StationId" => $stationId,
                "GameId" => $GameId
            );
            parent::insert($data);

            return true;
        } else {
            return false;
        }

    }

    public function get_temp_station_join_game($access_code, $stationId, $GameId)
    {
        $this->_table = "tempstation";
        parent::where("StationId", $stationId);
        parent::where("GameId", $GameId);
        parent::where("Access_Code", $access_code);
        $result = parent::get_by();

        if (count($result) == 0) {
            return true;
        } else {
            return false;
        }

    }

    public function first_station($access_code)
    {
        $this->_table = "first_station";
        parent::where("AccessCode", $access_code);
        return count(parent::get_all());
    }

    public function insert_first_station($access_code)
    {
        $this->_table = "first_station";
        $data = array("AccessCode" => $access_code);
        return parent::insert($data);
    }

    public function m_challenge_settings()
    {
        $this->_table = "challengesettings";
        return parent::get_by();
    }

    public function m_checkin_settings()
    {
        $this->_table = "checkinsettings";
        return parent::get_by();
    }

    public function m_landmarks($game_id)
    {
        $this->_table = "gameparameters";
        parent::join("areas", "areas.Id = gameparameters.AreaId");
        parent::join("landmarks", "landmarks.AreaId = areas.Id");
        parent::where("gameparameters.Id", $game_id);
        return parent::get_all();
    }

    public function m_insert_tempchallenge_station($access_code, $challengesId, $stationId)
    {
        $this->_table = "tempchallenge_station";
        parent::where("ChallengesId", $challengesId);
        parent::where("AccessCode", $access_code);
        $result = parent::get_by();

        if (count($result) == 0) {
            $data = array(
                "AccessCode" => $access_code,
                "StationId" => $stationId,
                "ChallengesId" => $challengesId,
                "Status" => 0
            );
            parent::insert($data);
            return true;
        } else {
            return false;
        }

    }

    //update status complete challenge
    public function m_update_challenge_complete($access_code, $challenge_id, $status)
    {
        $this->_table = "tempchallenge_station";
        $this->db->where("AccessCode", $access_code);
        $this->db->where("ChallengesId", $challenge_id);
        $this->db->update($this->_table, array("Status" => $status));
        return true;
    }

    //get status of challenge
    public function m_get_status_challenge($access_code, $challenge_id)
    {
        $this->_table = "tempchallenge_station";
        parent::where("AccessCode", $access_code);
        parent::where("ChallengesId", $challenge_id);
        return parent::get_by();
    }

    public function m_insert_tempchallenge_diff($access_code, $difficulty, $stationId)
    {
        $this->_table = "tempchallenge_diff";
        parent::where("Difficulty", $difficulty);
        parent::where("AccessCode", $access_code);
        $result = parent::get_by();

        if (count($result) == 0) {
            $data = array(
                "AccessCode" => $access_code,
                "StationId" => $stationId,
                "Difficulty" => $difficulty
            );
            parent::insert($data);
            return true;
        } else {
            return false;
        }

    }

    public function m_list_response($challengesId)
    {
        $this->_table = "responses";
        parent::where("ChallengeId", $challengesId);
        parent::order_by("Rand()");
        return parent::get_all();
    }

    public function m_challenge_s_temp($challengeId)
    {
        $this->_table = "c_s_temp";
        parent::where("ChallengeId", $challengeId);
        parent::order_by("Rand()");
        return parent::get_all();
    }

    public function m_c_station_temp($stationId)
    {
        $this->_table = "c_s_temp";
        parent::where("StationId", $stationId);
        parent::order_by("Rand()");
        return parent::get_all();
    }

    public function m_check_station($stations_id, $access_code)
    {
        $this->_table = "tempstation";
        parent::where("StationId", $stations_id);
        parent::where("Access_Code", $access_code);
        $result = parent::get_by();

        if (count($result) == 0) {
            return true;
        } else {
            return false;
        }
    }

    //update total_point for team
    public function m_update_total_point_teams($access_code, $total_point)
    {
        $mark_team = intval($this->m_get_mark_of_team($access_code));

        if ($mark_team == 0) {
            $this->db->where("AccessCode", $access_code);
            $this->db->update($this->_table, array("TotalPoint" => $total_point));
        } else {
            $total = $mark_team + $total_point;
            $this->db->where("AccessCode", $access_code);
            $this->db->update($this->_table, array("TotalPoint" => $total));
        }

        return true;
    }

    //update total_point for team
    public function m_update_temp_point_teams($access_code, $temp_point)
    {
        $this->_table = 'teams';
        $this->db->where("AccessCode", $access_code);
        $this->db->update($this->_table, array("TempPoint" => $temp_point));
        return true;
    }

    //get Total Point of team
    public function m_get_mark_of_team($access_code)
    {
        $this->_table = 'teams';
        parent::where("AccessCode", $access_code);
        $mark_of_team = parent::get_by();
        return isset($mark_of_team->TotalPoint) ? $mark_of_team->TotalPoint : 0;
    }

    //get temp point of team
    public function m_get_temp_point_of_team($access_code)
    {
        $this->_table = 'teams';
        parent::where("AccessCode", $access_code);
        $mark_of_team = parent::get_by();
        return isset($mark_of_team->TempPoint) ? $mark_of_team->TempPoint : 0;
    }

    //update status text of team
    public function m_update_status_text_teams($access_code, $status_text)
    {
        $this->db->where("AccessCode", $access_code);
        $this->db->update($this->_table, array("StatusText" => $status_text));
        return true;
    }

    //register device gmc
    public function storeUser($name, $email, $gcm_reg_id)
    {
        $data = array(
            'gcm_regid' => $gcm_reg_id,
            'name' => $name,
            'email' => $email
        );
        $this->db->insert('gcm_users', $data);
        return true;
    }

    //get list station id
    public function get_list_station_id_g_s_temp($Id)
    {
        $this->_table = 'g_s_temp';
        parent::where("GameParameterId", $Id);
        parent::order_by("Rand()");
        return parent::get_all();
    }

    //2013/07/06 insert table join game
    public function m_insert_join_game($data)
    {
        $this->_table = 'join_game';
        return parent::insert($data);
    }

    //check exist station id in table join game
    public function m_check_exist_access_code_join_game($access_code)
    {
        $this->_table = 'join_game';
        parent::where("access_code", $access_code);
        $result = parent::get_by();
        if (count($result) != 0) {
            return true;
        } else {
            return false;
        }
    }

    //check exist station id in table join game
    public function m_check_exist_stationId_join_game($station_id)
    {
        $this->_table = 'join_game';
        parent::where("stationId", $station_id);
        $result = parent::get_by();
        if (count($result) != 0) {
            return true;
        } else {
            return false;
        }
    }

    //check exist station id in table join game
    public function m_check_exist_challengeId_join_game($challengeId)
    {
        $this->_table = 'join_game';
        parent::where("challengeId", $challengeId);
        $result = parent::get_by();
        if (count($result) != 0) {
            return true;
        } else {
            return false;
        }
    }

    //m_get_join_game_by_access_code
    public function m_get_join_game_by_access_code($access_code)
    {
        $this->_table = 'join_game';
        parent::where("access_code", $access_code);
        parent::order_by("Rand()");
        return parent::get_all();
    }

    //m_get_join_game_by_station_id
    public function m_get_join_game_by_station_id($stationId)
    {
        $this->_table = 'join_game';
        parent::where("stationId", $stationId);
        return parent::get_by();
    }


    //m_get_join_game_by_challenge_Id
    public function m_get_join_game_by_challenge_Id($challengeId)
    {
        $this->_table = 'join_game';
        parent::where("challengeId", $challengeId);
        return parent::get_by();
    }

    //update status  of join game by station id and access code
    public function m_update_status_join_game_by_stationId($access_code, $station_id, $status)
    {
        $this->_table = 'join_game';
        $this->db->where("access_code", $access_code);
        $this->db->where("stationId", $station_id);
        $this->db->update($this->_table, array("status" => $status));
        return true;
    }

    //update status  of join game by station id and access code
    public function m_update_status_join_game_challenge_status($access_code, $station_id, $challengeId, $status)
    {
        $this->_table = 'join_game';
        $this->db->where("access_code", $access_code);
        $this->db->where("stationId", $station_id);
        $this->db->update($this->_table, array("status" => $status, "challengeId" => $challengeId));
        return true;
    }

    //update status  of join game by challenge id and access code
    public function m_update_status_join_game_by_challengeId($access_code, $challenge_id, $status)
    {
        $this->_table = 'join_game';
        $this->db->where("access_code", $access_code);
        $this->db->where("challengeId", $challenge_id);
        $this->db->update($this->_table, array("status" => $status));
        return true;
    }

    //get number check in
    public function m_get_number_check_in_location()
    {
        $this->_table = "checkinsettings";
        return parent::get_by();
    }

    //insert count_check_in
    public function m_insert_count_check_in($access_code, $stationId)
    {
        $this->_table = "count_check_in";
        return parent::insert(array("access_code" => $access_code, "stationId" => $stationId));
    }

    public function count_check_in($access_code, $stationId)
    {
        $this->_table = "count_check_in";
        parent::where("access_code", $access_code);
        parent::where("stationId", $stationId);
        return count(parent::get_all());
    }

    //========2013/07/08 start update================//
    public function m_get_station_id()
    {
        $this->_table = "stations";
        parent::select("Id");
        parent::order_by("Rand()");
        return parent::get_all();
    }

    //========2013/07/08 end update==================//
    public function register_id_team($access_code, $regId)
    {
        $this->_table = 'teams';
        $this->db->where("AccessCode", $access_code);
        $this->db->update($this->_table, array("regId" => $regId));
        return true;
    }

    public function un_register_id_team($access_code)
    {
        $this->_table = 'teams';
        $this->db->where("AccessCode", $access_code);
        $this->db->update($this->_table, array("regId" => ""));
        return true;
    }

    //2013/07/24
    public function get_game_history($access_code)
    {
        //$this->_table = 'game_history';
        $this->db->select("Id ,AccessCode, SUM(Mark) as Mark, StationName, StationId");
        $this->db->where('AccessCode', $access_code);
        $this->db->group_by('StationId');
        return $this->db->get('game_history');
    }

    public function insert_game_history($access_code, $mark, $StationName, $StationId)
    {
        $this->_table = 'game_history';
        $data = array(
            "AccessCode" => $access_code,
            "Mark" => $mark,
            "StationName" => $StationName,
            "StationId" => $StationId
        );
        parent::insert($data);
        return true;
    }

    public function update_total_point_check_in($access_code, $mark)
    {
        $this->_table = 'teams';
        $this->db->where("AccessCode", $access_code);
        $this->db->update($this->_table, array("TotalPoint" => $mark));
        return true;

    }

    public function get_clue_who_am_i($answer_id)
    {
        $this->_table = 'who_am_i_clue';
        parent::where("AnswerId", $answer_id);
        parent::order_by("Position");
        return parent::get_all();
    }

    public function get_answer_who_am_i($answer_id)
    {
        $this->_table = 'who_am_i_answer';
        parent::where("Id", $answer_id);
        return parent::get_by();
    }

    public function get_answer_id_from_game($gameId)
    {
        $this->_table = 'gameparameters';
        parent::where("Id", $gameId);
        $game = parent::get_by();
        return isset($game->AnswerId) ? $game->AnswerId : 0;

    }

    public function get_max_point_checkIn()
    {
        $this->_table = 'checkinsettings';
        return parent::get_by();

    }

    public function get_game_id_team($access_code)
    {
        $this->_table = 'teams';
        parent::where("AccessCode", $access_code);
        return parent::get_by();
    }

    //check in right
    public function check_in_right($access_code, $StationId)
    {
        $this->_table = 'check_in_right';
        parent::where('AccessCode', $access_code);
        parent::where('StationId', $StationId);
        $count = count(parent::get_by());
        if ($count != 0) {
            return true;
        } else {
            $data = array("AccessCode" => $access_code, "StationId" => $StationId);
            parent::insert($data);
            return false;
        }

    }

    //count num of station
    public function get_count_history($access_code)
    {
        $this->_table = 'game_history';
        parent::where('AccessCode', $access_code);
        $count = count(parent::get_all());
        return $count;

    }

    //get num of station of game
    public function get_no_of_station($gameId)
    {
        $this->_table = 'gameparameters';
        parent::where('Id', $gameId);
        $game = parent::get_by();
        return isset($game->NoOfStations) ? $game->NoOfStations : 0;
    }

    //get station game HQ
    public function get_station_hq($gameId)
    {
        $this->_table = 'game_hq';
        parent::where('game_id', $gameId);
        $game = parent::get_by();
        return isset($game->station_id) ? $game->station_id : 0;
    }

    //get challenge to HQ
    public function get_challenge_hq($gameId)
    {
        $this->_table = 'game_hq';
        parent::where('game_id', $gameId);
        $game = parent::get_by();
        return isset($game->challenge_id) ? $game->challenge_id : 0;
    }


    //get save data for continue game
    public function get_data_continue_game($access_code)
    {
        $this->_table = 'join_game';
        parent::where('access_code', $access_code);
        return parent::get_all();

    }


    //insert  for game mini
    public function insert_game_mini($access_code, $game_id)
    {
        $this->_table = 'GameMini';
        parent::where('AccessCode', $access_code);
        $result = count(parent::get_by());
        if ($result == 0) {
            $data = array(
                "AccessCode" => $access_code,
                "GameId" => $game_id
            );
            parent::insert($data);
            return true;
        } else {
            return false;
        }

    }

    //check access code for game mini
    public function check_mini_game($access_code)
    {
        $this->_table = 'GameMini';

    }

    //count game mini
    public function count_game_mini($game_id)
    {

        parent::where('GameId', $game_id);
        $count = parent::get_all();
        return count($count);
    }

    //get Game Difficulty
    public function get_game_difficulty($gameId)
    {
        $this->_table = 'gameparameters';
        parent::where("Id", $gameId);
        $game = parent::get_by();
        return isset($game->QuestionDifficulty) ? $game->QuestionDifficulty : "";
    }

}