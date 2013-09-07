<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/8/13
 * Time: 2:10 PM
 * To change this template use File | Settings | File Templates.
 */

date_default_timezone_set("UTC");


class Api extends Public_Controller
{
    private $_data = array();

    public function __construct()
    {
        $this->load->model(array('api_m'));
        $this->load->library('encrypt');
    }

    public function Index()
    {
        $this->template
            ->set_metadata('description', 'spanq')
            ->set_metadata('keywords', 'spanq')
            ->title('spanq')
            ->build('api', $this->_data, FALSE);
    }

    //join the game
    public function jointhegame()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        if (isset($_REQUEST['regId'])) {
            $regId = $_REQUEST['regId'];
            $this->api_m->register_id_team($access_code, $regId);
        } else {
            $error = array(
                "error_id" => "5",
                "error_message" => "Register Id invalid, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        $count = $this->api_m->get_count_history($access_code);

        if ($count == 0) {
            $this->first_station($access_code);
        } else {
            $this->after_station($access_code);
        }

    }

    //function get first station
    function first_station($access_code)
    {
        //get data from database with access_code
        $join_game = $this->api_m->m_joingame($access_code);

        $game_id = isset($join_game->GameParameterId) ? $join_game->GameParameterId : 0;
        //valid data exist
        if (count($join_game) != 0) {
            //response to client
            $team_info = array(
                "id" => $join_game->Id,
                "name" => $join_game->Name,
                "access_code" => $join_game->AccessCode,
                "totalpoint" => $join_game->TotalPoint,
                "gameparameterid" => $join_game->GameParameterId,
                "status_text" => $join_game->StatusText
            );

            $game_types_id = $join_game->GameTypeId;

            //get game type from game type id
            $game_types = $this->api_m->m_game_types($game_types_id);

            $game_info = array(
                "id" => $join_game->GameParameterId,
                "name" => $game_types->Name,
                "Enabled20Quetion" => $join_game->Enabled20Quetion,
                "area_id" => $join_game->AreaId,
                "NoOfStations" => $join_game->NoOfStations,
                "QuestionDifficulty" => $join_game->QuestionDifficulty,
                "NoOfTeam" => $join_game->NoOfTeam,
                "AllowPossible" => $join_game->AllowPossible,
                "ListTeamId" => $join_game->ListTeamId,
                "TimeLimit" => $join_game->TimeLimit,
                "StartTime" => $join_game->StartTime,
                "TimeRemail" => $join_game->TimeRemain,
                "phone_number_hint" => $join_game->phonehint
            );

            $station_id = $this->api_m->get_station_hq($game_id);

            //get station info from station id
            $station = $this->api_m->m_stations(trim($station_id));

            if (count($station) != 0) {

                $station_info = array(
                    "id" => $station->Id,
                    "name" => $station->Name,
                    "clue" => $station->Clue,
                    "difficulty" => $station->Difficulty,
                    "address" => $station->Address,
                    "locationLat" => $station->LocationLat,
                    "locationLong" => $station->LocationLong,
                    "contact_person" => $station->ContactPerson,
                    "contact_email" => $station->ContactEmail,
                    "contact_phone" => $station->ContactPhone,
                    "listchallengeid" => $station->listchallengeId,
                    "areaId" => $station->AreaId,
                    "clue_easy" => $station->clue_easy,
                    "clue_difficult" => $station->clue_difficult
                );

            } else {
                $error = array(
                    "error_id" => "4",
                    "error_message" => "Station complete!",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
            //get challenge_settings from database
            $challenge_sett = $this->api_m->m_challenge_settings();

            if (count($challenge_sett) != 0) {
                $challenge_settings = array(
                    "id" => $challenge_sett->Id,
                    "e_basepoint" => $challenge_sett->E_BasePoint,
                    "e_pernaltyperfail" => $challenge_sett->E_PenaltyPerFail,
                    "e_maxno" => $challenge_sett->E_MaxNo,
                    "d_basepoint" => $challenge_sett->D_BasePoint,
                    "d_pennaltyperfail" => $challenge_sett->D_PenaltyPerFail,
                    "d_maxno" => $challenge_sett->D_MaxNo
                );
            }

            //get check in settings from database
            $check_in_set = $this->api_m->m_checkin_settings();

            if (count($check_in_set) != 0) {
                $check_in_setting = array(
                    "id" => $check_in_set->Id,
                    "noinvalid" => $check_in_set->NoInvalid,
                    "penalty_perinvalid" => $check_in_set->PenaltyPerInvalid,
                    "maxno" => $check_in_set->MaxNo,
                    "maxpoint" => $check_in_set->MaxPoint,
                    "max_point_hq" => $check_in_set->Maxpoint_HQ
                );
            }

            $checkIn = $this->api_m->get_max_point_checkIn();

            $max_point = isset($checkIn->MaxPoint) ? $checkIn->MaxPoint : 0;

            $this->api_m->m_update_temp_point_teams($access_code, $max_point);

            $join_game = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array(
                    "team_info" => $team_info,
                    "game_info" => $game_info,
                    "station_info" => $station_info,
                    "challenge_settings" => $challenge_settings,
                    "checkin_settings" => $check_in_setting
                ));
            $this->api_m->insert_first_station($access_code);
            echo json_encode($join_game);

        } else {
            $error = array(
                "error_id" => "3",
                "error_message" => "Can't get data with access code!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
        }
    }


    //function get after station
    function after_station($access_code)
    {
        //get data from database with access_code
        $join_game = $this->api_m->m_joingame($access_code);

        //valid data exist
        if (count($join_game) != 0) {
            //response to client
            $team_info = array(
                "id" => $join_game->Id,
                "name" => $join_game->Name,
                "access_code" => $join_game->AccessCode,
                "totalpoint" => $join_game->TotalPoint,
                "gameparameterid" => $join_game->GameParameterId,
                "status_text" => $join_game->StatusText
            );

            $game_types_id = $join_game->GameTypeId;

            //get game type from game type id
            $game_types = $this->api_m->m_game_types($game_types_id);

            $game_info = array(
                "id" => $join_game->GameParameterId,
                "name" => $game_types->Name,
                "Enabled20Quetion" => $join_game->Enabled20Quetion,
                "area_id" => $join_game->AreaId,
                "NoOfStations" => $join_game->NoOfStations,
                "QuestionDifficulty" => $join_game->QuestionDifficulty,
                "NoOfTeam" => $join_game->NoOfTeam,
                "AllowPossible" => $join_game->AllowPossible,
                "ListTeamId" => $join_game->ListTeamId,
                "TimeLimit" => $join_game->TimeLimit,
                "StartTime" => $join_game->StartTime,
                "TimeRemail" => $join_game->TimeRemain,
                "phone_number_hint" => $join_game->phonehint
            );

            $station_id = '';

            $list_station = $this->api_m->get_data_continue_game($access_code);
            foreach ($list_station as $item) {
                $station_id = $item->stationId;
            }

            //get station info from station id
            $station = $this->api_m->m_stations(trim($station_id));

            if (count($station) != 0) {

                $station_info = array(
                    "id" => $station->Id,
                    "name" => $station->Name,
                    "clue" => $station->Clue,
                    "difficulty" => $station->Difficulty,
                    "address" => $station->Address,
                    "locationLat" => $station->LocationLat,
                    "locationLong" => $station->LocationLong,
                    "contact_person" => $station->ContactPerson,
                    "contact_email" => $station->ContactEmail,
                    "contact_phone" => $station->ContactPhone,
                    "listchallengeid" => $station->listchallengeId,
                    "areaId" => $station->AreaId,
                    "clue_easy" => $station->clue_easy,
                    "clue_difficult" => $station->clue_difficult
                );

            } else {
                $error = array(
                    "error_id" => "4",
                    "error_message" => "Station complete!",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
            //get challenge_settings from database
            $challenge_sett = $this->api_m->m_challenge_settings();

            if (count($challenge_sett) != 0) {
                $challenge_settings = array(
                    "id" => $challenge_sett->Id,
                    "e_basepoint" => $challenge_sett->E_BasePoint,
                    "e_pernaltyperfail" => $challenge_sett->E_PenaltyPerFail,
                    "e_maxno" => $challenge_sett->E_MaxNo,
                    "d_basepoint" => $challenge_sett->D_BasePoint,
                    "d_pennaltyperfail" => $challenge_sett->D_PenaltyPerFail,
                    "d_maxno" => $challenge_sett->D_MaxNo
                );
            }

            //get check in settings from database
            $check_in_set = $this->api_m->m_checkin_settings();

            if (count($check_in_set) != 0) {
                $check_in_setting = array(
                    "id" => $check_in_set->Id,
                    "noinvalid" => $check_in_set->NoInvalid,
                    "penalty_perinvalid" => $check_in_set->PenaltyPerInvalid,
                    "maxno" => $check_in_set->MaxNo,
                    "maxpoint" => $check_in_set->MaxPoint,
                    "max_point_hq" => $check_in_set->Maxpoint_HQ
                );
            }

            $checkIn = $this->api_m->get_max_point_checkIn();

            $max_point = isset($checkIn->MaxPoint) ? $checkIn->MaxPoint : 0;

            $this->api_m->m_update_temp_point_teams($access_code, $max_point);

            $join_game = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array(
                    "team_info" => $team_info,
                    "game_info" => $game_info,
                    "station_info" => $station_info,
                    "challenge_settings" => $challenge_settings,
                    "checkin_settings" => $check_in_setting
                ));
            $this->api_m->insert_first_station($access_code);
            echo json_encode($join_game);

        } else {
            $error = array(
                "error_id" => "3",
                "error_message" => "Can't get data with access code!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
        }
    }

    //Get Station Detail by ID
    public function getstationbyid()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }
        //get station id from client
        if (isset($_REQUEST["station_id"])) {
            $station_id = $_REQUEST["station_id"];
        } else {
            $station_id = "";
        }


        //get station info from station id
        $station = $this->api_m->m_stations(trim($station_id));

        if (count($station) != 0) {
            //push station details in array
            $station_info = array(
                "id" => $station->Id,
                "name" => $station->Name,
                "clue" => $station->Clue,
                "difficulty" => $station->Difficulty,
                "address" => $station->Address,
                "locationLat" => $station->LocationLat,
                "locationLong" => $station->LocationLong,
                "contact_person" => $station->ContactPerson,
                "contact_email" => $station->ContactEmail,
                "contact_phone" => $station->ContactPhone,
                "listchallengeid" => $station->listchallengeId,
                "areaId" => $station->AreaId,
                "clue_easy" => $station->clue_easy,
                "clue_difficult" => $station->clue_difficult
            );

            $get_station_by_id = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array(
                    "station_info" => $station_info
                ));
            echo json_encode($get_station_by_id);
        } else {
            $error = array(
                "error_id" => "4",
                "error_message" => "Complete Station",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
        }

    }

    //Get Station Detail By Level Difficulty
    public function get_station_detail_by_level_difficulty()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again! .",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        if (isset($_REQUEST['station_id'])) {
            $station_id = $_REQUEST['station_id'];
        } else {
            $station_id = "";
        }

        //get game id from client
        if (isset($_REQUEST['game_id'])) {
            $game_id = $_REQUEST['game_id'];
        } else {
            $game_id = "";
        }
        //get difficult  from client
        if (isset($_REQUEST["difficult"])) {
            $diff = $_REQUEST["difficult"];
        } else {
            $diff = CHALLENGE_EASY;
        }

        $station = $this->api_m->m_station_detail_by_level_difficulty($diff, $station_id);

        if (count($station) != 0) {
            $station_info = array(
                "id" => $station->Id,
                "name" => $station->Name,
                "clue" => $station->Clue,
                "difficulty" => $station->Difficulty,
                "address" => $station->Address,
                "locationLat" => $station->LocationLat,
                "locationLong" => $station->LocationLong,
                "contact_person" => $station->ContactPerson,
                "contact_email" => $station->ContactEmail,
                "contact_phone" => $station->ContactPhone,
                "listchallengeid" => $station->listchallengeId,
                "areaId" => $station->AreaId,
                "clue_easy" => $station->clue_easy,
                "clue_difficult" => $station->clue_difficult
            );

            $get_station_by_difficulty = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array(
                    "station_info" => $station_info
                ));
            echo json_encode($get_station_by_difficulty);
        } else {
            $error = array(
                "error_id" => "6",
                "error_message" => "Empty data of station id " . $station_id . " and question " . $diff,
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
        }

    }

    //Get Question by level difficulty of Station
    public function get_question()
    {
        //get station id from client
        if (isset($_REQUEST["station_id"])) {
            $station_id = $_REQUEST["station_id"];
        } else {
            $station_id = "";
        }
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again! . ",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }
        //get difficult  from client
        if (isset($_REQUEST["difficult"])) {
            $diff = $_REQUEST["difficult"];
        } else {
            $diff = CHALLENGE_EASY;
        }

        //get station info from station id
        $station = $this->api_m->m_stations(trim($station_id));
        if (count($station) != 0) {
            $listchallengeId = explode(",", $station->listchallengeId);
            $arr_list_challege = array();
            //get all challenges info
            foreach ($listchallengeId as $challengeId) {
                $arr_challenge = $this->api_m->m_challenges_hint($challengeId);
                $arr_list_challege[] = array(
                    "id" => $arr_challenge->Id,
                    "description" => $arr_challenge->Description,
                    "pincode" => $arr_challenge->pincode,
                    "notes" => $arr_challenge->Notes,
                    "type" => $arr_challenge->Type,
                    "difficulty" => $arr_challenge->Difficulty
                );
            }

            //get challenges info with difficulty
            $challenge_info_diff = $this->api_m->m_challenges_info($diff);
            $ressponse = array();
            foreach ($challenge_info_diff as $str_challenge) {
                $ressponse[] = array(
                    "response" => array(
                        "id" => $str_challenge->Id,
                        "answer" => $str_challenge->Answer,
                        "status" => $str_challenge->Status,
                        "create_date" => $str_challenge->CreatedDate
                    )
                );
            }

            $challenge = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array(
                    "challenge" => $arr_list_challege,
                    "array_response" => $ressponse
                ));

            echo json_encode($challenge);
        } else {
            $error = array("error_id" => "3");
            echo json_encode($error);
        }

    }

    //Get Challenge of Station
    public function get_challenge_station()
    {
        //get station id from client
        if (isset($_REQUEST["station_id"])) {
            $station_id = $_REQUEST["station_id"];
        } else {
            $station_id = "";
        }

        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        //get game id from client
        if (isset($_REQUEST['game_id'])) {
            $game_id = $_REQUEST['game_id'];
        } else {
            $game_id = "";
        }

        //get station info from station id
        //This method is called to get challenge  in station
        $station = $this->api_m->m_stations(trim($station_id));

        if (count($station) != 0) {

            $list_challenge_Id = $this->api_m->m_c_station_temp($station_id);



            $arr_list_challenge = array();
            $difficulty = $this->api_m->get_game_difficulty($game_id);
            $type_challenge = "";


            //get all challenges info
            foreach ($list_challenge_Id as $challenge) {
                $challengeId = $challenge->ChallengeId;
                $count = $this->api_m->get_count_history($access_code);

                if ($count == 0) {
                    $challengeId = $this->api_m->get_challenge_hq($game_id);
                }

                $arr_challenge = $this->api_m->m_challenges_hint($challengeId , $difficulty);

                if (count($arr_challenge) == 0) {
                    if($difficulty == CHALLENGE_EASY){
                        $arr_challenge = $this->api_m->m_challenges_hint($challengeId , CHALLENGE_DIFF);
                    }else{
                        $arr_challenge = $this->api_m->m_challenges_hint($challengeId , CHALLENGE_EASY);
                    }
                }

                $result = $this->api_m->m_insert_tempchallenge_station($access_code, $challengeId, $station_id);

                $type_challenge = $arr_challenge->Type;

                if ($result) {
                    $arr_list_challenge[] = array(
                        "id" => $arr_challenge->Id,
                        "description" => $arr_challenge->Description,
                        "pincode" => $arr_challenge->pincode,
                        "notes" => $arr_challenge->Notes,
                        "hint1" => $arr_challenge->Hint1,
                        "hint2" => $arr_challenge->Hint2,
                        "type" => $arr_challenge->Type,
                        "difficulty" => $arr_challenge->Difficulty
                    );
                    //start save data 2013/08/11
                    $this->save_data($station_id, $access_code, $game_id, $arr_challenge->Id, 0);
                    //end save data 2013/08/11
                    $this->api_m->m_update_status_join_game_challenge_status($access_code, $station_id, $challengeId, 2);
                    break;
                }

            }


            $arr_list_response = array();

            if ($type_challenge == CHALLENGE_TYPE) {

                $response = $this->api_m->m_list_response($challengeId);
                foreach ($response as $res) {
                    $arr_list_response[] = array(
                        "id" => $res->Id,
                        "answer" => $res->Answer,
                        "status" => $res->Status,
                        "challengeid" => $res->ChallengeId,
                        "createdate" => $res->CreatedDate,
                    );
                }

            } else {
                $arr_list_response[] = array();
            }


            $challenge_station = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array(
                    "challenge" => $arr_list_challenge,
                    "list_response" => $arr_list_response
                ));

            echo json_encode($challenge_station);

        } else {
            $error = array(
                "error_id" => "6",
                "error_message" => "Empty data of station id " . $station_id,
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
        }
    }

    //This method is called to get challenge  by difficulty in station
    public function get_challenge_station_by_level_difficulty()
    {
        //get station id from client
        if (isset($_REQUEST["station_id"])) {
            $station_id = $_REQUEST["station_id"];
        } else {
            $station_id = "";
        }
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        //get difficult  from client
        if (isset($_REQUEST["difficult"])) {
            $diff = $_REQUEST["difficult"];
        } else {
            $diff = CHALLENGE_EASY;
        }
        //get game id from client
        if (isset($_REQUEST['game_id'])) {
            $game_id = $_REQUEST['game_id'];
        } else {
            $game_id = "";
        }


        //get station info from station id
        $station = $this->api_m->m_stations(trim($station_id));
        if (count($station) != 0) {
            $list_challenge = $this->api_m->m_challenges_info($diff);

            $arr_list_challenge = array();
            $challengeId = "";
            $type_challenge = "";

            if(count($list_challenge) == 0){
                if($diff == CHALLENGE_EASY){
                    $list_challenge = $this->api_m->m_challenges_info(CHALLENGE_DIFF);
                }else{
                    $list_challenge = $this->api_m->m_challenges_info(CHALLENGE_EASY);
                }
            }
            //get all challenges info
            foreach ($list_challenge as $arr_challenge) {
//              $result = $this->api_m->m_insert_tempchallenge_diff($access_code, $arr_challenge->Difficulty, $station_id);
//              if ($result) {
                $arr_list_challenge[] = array(
                    "id" => $arr_challenge->Id,
                    "description" => $arr_challenge->Description,
                    "pincode" => $arr_challenge->pincode,
                    "notes" => $arr_challenge->Notes,
                    "hint1" => $arr_challenge->Hint1,
                    "hint2" => $arr_challenge->Hint2,
                    "type" => $arr_challenge->Type,
                    "difficulty" => $arr_challenge->Difficulty
                );
                $challengeId = $arr_challenge->Id;
                $type_challenge = $arr_challenge->Type;
                //start save data 2013/08/11
                $this->save_data($station_id, $access_code, $game_id, $arr_challenge->Id, 0);
                //end save data 2013/08/11
                $this->api_m->m_update_status_join_game_challenge_status($access_code, $station_id, $arr_challenge->Id, 2);
                break;
//             }
            }


            $arr_list_response = array();

            if ($type_challenge == CHALLENGE_TYPE) {
                $response = $this->api_m->m_list_response($challengeId);
                foreach ($response as $res) {
                    $arr_list_response[] = array(
                        "id" => $res->Id,
                        "answer" => $res->Answer,
                        "status" => $res->Status,
                        "challengeid" => $res->ChallengeId,
                        "createdate" => $res->CreatedDate,
                    );
                }

            } else {
                $arr_list_response[] = array();
            }

            $challenge_station = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array(
                    "challenge" => $arr_list_challenge,
                    "list_response" => $arr_list_response
                ));

            echo json_encode($challenge_station);

        } else {
            $error = array(
                "error_id" => "6",
                "error_message" => "Empty data of station id " . $station_id,
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
        }
    }

    //Enter pin to confirm challenge complete
    public function complete_challenge_station()
    {
        //get access_code from client
        if (isset($_REQUEST['access_code'])) {
            $access_code = $_REQUEST['access_code'];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        //get station id from client
        if (isset($_REQUEST["station_id"])) {
            $station_history = $_REQUEST["station_id"];
        } else {
            $station_history = "";
        }

        //get station name
        if (isset($_REQUEST['station_name'])) {
            $station_name = $_REQUEST['station_name'];
        } else {
            $station_name = "";
        }
        //get challenge id from client
        if (isset($_REQUEST['challenge_id'])) {
            $challenge_id = $_REQUEST['challenge_id'];
        }

        //get mark from client
        if (isset($_REQUEST['mark'])) {
            $mark = $_REQUEST['mark'];
            $this->api_m->m_update_total_point_teams($access_code, $mark);
        }

        //get difficult  from client
        if (isset($_REQUEST["difficult"])) {
            $diff = $_REQUEST["difficult"];
        } else {
            $diff = CHALLENGE_EASY;
        }

        $res_status = $this->api_m->m_challenges($challenge_id);

        $game_param = $this->api_m->m_joingame($access_code);

        $game_id = isset($game_param->GameParameterId) ? $game_param->GameParameterId : 0;

        $list_station_id = $this->api_m->get_list_station_id_g_s_temp($game_id);

        $this->api_m->insert_game_history($access_code, $mark, $station_name, $station_history);
//        $flag = false;
        $station_id = "";
        if (count($list_station_id) != 0) {

            foreach ($list_station_id as $station) {
                $result = $this->api_m->get_temp_station_join_game($access_code, $station->StationId, $game_id);
                if ($result) {
                    $station_id = $station->StationId;
                    break;
//                    $station = $this->api_m->m_stations($station_id);
//                    $difficulty = $station->Difficulty;
//                    if ($difficulty == $diff) {
//                        $flag = true;
//                        break;
//                    }
                }
//                else {
//                    continue;
//                }
            }

            //get station info from station id
//            if (!$flag) {
              $station = $this->api_m->m_stations(trim($station_id));
//            }
            if ($station_id != null or $station_id != '') {
                $this->api_m->m_insert_temp_station_join_game($access_code, $station_id, $game_id);
                //start save data 2013/08/11
                $this->save_data($station_id, $access_code, $game_id, 0, 0);
                //end save data 2013/08/11
            }

            if (count($station) != 0) {

                $station_info = array(
                    "id" => $station->Id,
                    "name" => $station->Name,
                    "clue" => $station->Clue,
                    "difficulty" => $station->Difficulty,
                    "address" => $station->Address,
                    "locationLat" => $station->LocationLat,
                    "locationLong" => $station->LocationLong,
                    "contact_person" => $station->ContactPerson,
                    "contact_email" => $station->ContactEmail,
                    "contact_phone" => $station->ContactPhone,
                    "areaId" => $station->AreaId,
                    "clue_easy" => $station->clue_easy,
                    "clue_difficult" => $station->clue_difficult
                );

            } else {
                $error = array(
                    "error_id" => "4",
                    "error_message" => "Station complete",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }

            $response = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array(
                    "status" => isset($res_status->Status) ? $res_status->Status : "0",
                    "stations" => $station_info
                )
            );

            $this->api_m->m_update_status_join_game_by_challengeId($access_code, $challenge_id, 0);

            $this->api_m->m_update_challenge_complete($access_code, $challenge_id, 1);

            echo json_encode($response);

        } else {
            $error = array(
                "error_id" => "6",
                "error_message" => "Empty data station of game id " . $game_id,
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);

        }


    }

    //This method is called to quit challenge activity at station
    public function quit_challenge()
    {
        //get access_code from client
        if (isset($_REQUEST['access_code'])) {
            $access_code = $_REQUEST['access_code'];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }
        //get challenge id from client
        if (isset($_REQUEST['challenge_id'])) {
            $challenge_id = $_REQUEST['challenge_id'];
        }
        if (isset($_REQUEST['game_id'])) {
            $game_id = $_REQUEST['game_id'];
        } else {
            $game_id = 0;
        }

        //get difficult  from client
        if (isset($_REQUEST["difficult"])) {
            $diff = $_REQUEST["difficult"];
        } else {
            $diff = CHALLENGE_EASY;
        }

        $status_game = $this->api_m->m_challenges_status($challenge_id);

        $list_station_id = $this->api_m->get_list_station_id_g_s_temp($game_id);
        $flag = false;
        $station_id = "";

        if (count($list_station_id) != 0) {

            foreach ($list_station_id as $station) {
                $result = $this->api_m->get_temp_station_join_game($access_code, $station->StationId, $game_id);
                if ($result) {
                    $station_id = $station->StationId;
                    break;
//                    $station = $this->api_m->m_stations($station_id);
//                    $difficulty = $station->Difficulty;
//                    if ($difficulty == $diff) {
//                        $flag = true;
//                        break;
//                    }
                }
            }

            //get station info from station id
//            if (!$flag) {
              $station = $this->api_m->m_stations(trim($station_id));
//            }

            if ($station_id != null or $station_id != '') {
                $this->api_m->m_insert_temp_station_join_game($access_code, $station_id, $game_id);
                //start save data 2013/08/11
                $this->save_data($station_id, $access_code, $game_id, 0, 0);
                //end save data 2013/08/11
            }

            if (count($station) != 0) {
                $station_info = array(
                    "id" => $station->Id,
                    "name" => $station->Name,
                    "clue" => $station->Clue,
                    "difficulty" => $station->Difficulty,
                    "address" => $station->Address,
                    "locationLat" => $station->LocationLat,
                    "locationLong" => $station->LocationLong,
                    "contact_person" => $station->ContactPerson,
                    "contact_email" => $station->ContactEmail,
                    "contact_phone" => $station->ContactPhone,
                    "listchallengeid" => $station->listchallengeId,
                    "areaId" => $station->AreaId,
                    "clue_easy" => $station->clue_easy,
                    "clue_difficult" => $station->clue_difficult
                );
            } else {
                $error = array(
                    "error_id" => "4",
                    "error_message" => "Station complete",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }

            $this->api_m->m_update_status_join_game_by_challengeId($access_code, $challenge_id, 0);

            $this->api_m->m_update_challenge_complete($access_code, $challenge_id, 1);

            $response = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array(
                    "status" => isset($status_game->Status) ? $status_game->Status : 0,
                    "stations" => $station_info
                )
            );

            echo json_encode($response);

        } else {
            $error = array(
                "error_id" => "6",
                "error_message" => "Empty data station of game id " . $game_id,
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }
    }

    //get landmarks
    public function getlandmarks()
    {
        if (isset($_REQUEST['access_code'])) {
            $access_code = $_REQUEST['access_code'];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        if (isset($_REQUEST['game_id'])) {
            $game_id = $_REQUEST['game_id'];
        } else {
            $game_id = "";
        }

        $landmarks_list = $this->api_m->m_landmarks($game_id);

        if (count($landmarks_list) != 0) {
            $arr_landmark = array();
            foreach ($landmarks_list as $landmarks) {
                $arr_landmark[] = array(
                    "id" => $landmarks->Id,
                    "name" => $landmarks->Name,
                    "areaId" => $landmarks->AreaId,
                    "address" => $landmarks->Address,
                    "locationLat" => $landmarks->LocationLat,
                    "locationLong" => $landmarks->LocationLong
                );
            }

            $res_landmarks = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array(
                    "landmarks" => $arr_landmark
                ));
            echo json_encode($res_landmarks);


        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
        }
    }

    //function using google cloud message with send message to device
    public function send_notify_message()
    {
        if (isset($_REQUEST['register_id'])) {
            $reg_id = $_REQUEST['register_id'];
        } else {
            $reg_id = "";
        }

        if (isset($_REQUEST['message'])) {
            $message = $_REQUEST['message'];
        } else {
            $message = "";
        }

        $registatoin_ids = array($reg_id);

        $message = array("message" => $message);

        $result = $this->send_notification($registatoin_ids, $message);

        echo $result;
    }

    public function register()
    {
        /**
         * Registering a user device
         * Store reg id in users table
         */
        if (isset($_REQUEST['access_code'])) {
            $access_code = $_REQUEST['access_code'];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }


        $gcm_regid = $_POST["regId"]; // GCM Registration ID


        $this->api_m->register_id_team($access_code, $gcm_regid);

        $register = array(
            "error_id" => "0",
            "error_message" => "",
            "timestamp" => date("Y-m-d H:i:s", time()),
            "response" => array(
                "status" => 1
            ));
        echo json_encode($register);
    }

    public function unregister_device()
    {
        /**
         * Registering a user device
         * Store reg id in users table
         */
        if (isset($_REQUEST['access_code'])) {
            $access_code = $_REQUEST['access_code'];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }


        $gcm_regid = $_POST["regId"]; // GCM Registration ID


        $this->api_m->un_register_id_team($access_code, $gcm_regid);

        $un_register = array(
            "error_id" => "0",
            "error_message" => "",
            "timestamp" => date("Y-m-d H:i:s", time()),
            "response" => array(
                "status" => 0
            ));
        echo json_encode($un_register);
    }

    /**
     * Sending Push Notification
     */
    public function send_notification($registatoin_ids, $message)
    {

        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );

        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        echo $result;
    }

    public function getthelatestclude()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $access_code = "";
        }
        //check access_code valid
        if ($access_code != null and $access_code != "") {
            //get data from database with acess_code
            $latestclude = $this->_data['latestclude'] = $this->api_m->m_latestclude($access_code);
            //valid data exist
            if (count($latestclude) != 0) {
                $clue = array(
                    "error_id" => "0",
                    "error_message" => "",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => array(
                        "clue" => $latestclude->Clue
                    ));

                echo json_encode($clue);
            } else {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
            }

        } else {
            $error = array("error_id" => "3");
            echo json_encode($error);
        }
    }

    public function check_in_location()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        //get latitute from client
        if (isset($_REQUEST["latitude"])) {
            $latitude = ($_REQUEST["latitude"]);
        } else {
            $latitude = "";
        }

        //get longitude from client
        if (isset($_REQUEST["longitude"])) {
            $longitude = ($_REQUEST["longitude"]);
        } else {
            $longitude = "";
        }

        //get station id from client
        if (isset($_REQUEST["station_id"])) {
            $station_id = $_REQUEST["station_id"];
        } else {
            $station_id = "";
        }

        //get station id from client
        if (isset($_REQUEST["game_id"])) {
            $game_id = $_REQUEST["game_id"];
        } else {
            $game_id = 0;
        }

        if ($access_code != null or $access_code != "") {

            //get data from database with acess_code
            $check_in_location = $this->api_m->m_stations($station_id);

            if (count($check_in_location) != 0) {

                $db_lat = trim($check_in_location->LocationLat);

                $db_long = trim($check_in_location->LocationLong);

                $distance = round($this->distance($latitude, $longitude, $db_lat, $db_long, "m"));

                if ($distance == 0 or $distance <= 30) {

                    $data = array(
                        "stationId" => $station_id,
                        "access_code" => $access_code,
                        "status" => 1,
                        "challengeId" => 0
                    );

                    $this->api_m->m_insert_join_game($data);
                    //get max no
                    $MaxNo = $this->api_m->m_get_number_check_in_location();

                    $max_no = isset($MaxNo->MaxNo) ? $MaxNo->MaxNo : 0;

                    //get number check in false
                    $num = $this->api_m->count_check_in($access_code, $station_id);
                    //check in great max no
                    if ($num >= $max_no) {
                        $success = array(
                            "error_id" => "0",
                            "error_message" => "",
                            "timestamp" => date("Y-m-d H:i:s", time()),
                            "response" => array(
                                "status" => "3"
                            ));

                    } else {
                        $success = array(
                            "error_id" => "0",
                            "error_message" => "",
                            "timestamp" => date("Y-m-d H:i:s", time()),
                            "response" => array(
                                "status" => "1"
                            ));
//
//                        $check_right = $this->api_m->check_in_right($access_code, $station_id);
//
//                        if (!$check_right) {

                            $mark_of_team = $this->api_m->m_get_mark_of_team($access_code);

                            $temp_point = $this->api_m->m_get_temp_point_of_team($access_code);

                            $mark = $mark_of_team + $temp_point;

                            $this->api_m->update_total_point_check_in($access_code, $mark);

                            //reset max point
                            $checkIn = $this->api_m->get_max_point_checkIn();

                            $max_point = isset($checkIn->MaxPoint) ? $checkIn->MaxPoint : 0;

                            $this->api_m->m_update_temp_point_teams($access_code, $max_point);
//                        }
                    }

                    echo json_encode($success);

                } else {

                    //insert data
                    $this->api_m->m_insert_count_check_in($access_code, $station_id);
                    //get max no
                    $MaxNo = $this->api_m->m_get_number_check_in_location();

                    $max_no = isset($MaxNo->MaxNo) ? $MaxNo->MaxNo : 0;

                    //get number check in false
                    $num = $this->api_m->count_check_in($access_code, $station_id);
                    //check in great max no
                    if ($num >= $max_no) {
                        //start save data 2013/08/11
                        $this->save_data($station_id, $access_code, $game_id, 0, 0);
                        //end save data 2013/08/11
                        $this->api_m->m_update_temp_point_teams($access_code, 0);

                        $success = array(
                            "error_id" => "0",
                            "error_message" => "",
                            "timestamp" => date("Y-m-d H:i:s", time()),
                            "response" => array(
                                "status" => "2"
                            ));
                        echo json_encode($success);

                    } else {

                        //2013/07/25 start add
                        $temp_point = $this->api_m->m_get_temp_point_of_team($access_code);

                        $Invalid = $this->api_m->m_get_number_check_in_location();

                        $PenaltyPerInvalid = isset($Invalid->PenaltyPerInvalid) ? $Invalid->PenaltyPerInvalid : 0;

                        $mark = $temp_point - ($temp_point * $PenaltyPerInvalid / 100);

                        $this->api_m->m_update_temp_point_teams($access_code, $mark);
                        //2013/07/25 end add

                        $fail = array(
                            "error_id" => "0",
                            "error_message" => "Wrong check in location, try again!",
                            "timestamp" => date("Y-m-d H:i:s", time()),
                            "response" => array(
                                "status" => "0"
                            ));

                        echo json_encode($fail);
                    }
                }
            } else {
                $error = array(
                    "error_id" => "6",
                    "error_message" => "Can't get station: " . $station_id,
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
            }

        } else {
            $error = array("error_id" => "3");
            echo json_encode($error);
        }
    }

    function getLatLong($address)
    {

        $address = str_replace(' ', '+', $address);
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&sensor=false';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $geoloc = curl_exec($ch);

        $json = json_decode($geoloc);
        return array(
            "lat" => $json->results[0]->geometry->location->lat,
            "lng" => $json->results[0]->geometry->location->lng
        );

    }

    public function get_location()
    {
        $address = $_REQUEST['address'];

        $location = $this->getLatLong($address);

        echo json_encode($location);
    }

    function distance($lat1, $lon1, $lat2, $lon2, $abc)
    {

        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;

        $r = 6372.797; // mean radius of Earth in km
        $dlat = ($lat2 - $lat1);
        $dlon = ($lon2 - $lon1);
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return $km * 1000;

    }

    public function check_in()
    {
//        $latitute = 21.0318529;
//        $longitude = 105.8261645;
//        $db_lat = 21.0318529;
//        $db_long = 105.8261645;
//        $distance = round($this->distance($latitute, $longitude, $db_lat, $db_long, "m"));
//
//        echo ($distance);

//        $access_code = "123456789";
//
//        $status = $this->api_m->m_get_join_game_by_access_code($access_code);
//
//        if (count($status) != 0) {
//            if ($status->status == "" or $status->status == "") {
//                echo "khong co data";
//            }
//        }

        /*$str1 = "qwerty";
        $str2 = "qwerty";
        $dis = strlen($str1);
        $result = $this->fuzzy_match($str1, $str2, $dis);
        if ($result['match'] == 1 and $result['distance'] == 0) {
            echo "match ";
        } else {
            echo "not match";
        }*/
        /*$count = $this->api_m->first_station(948534998);
        $mark = 110;
        if ($count >= 1) {

            $temp_point = $this->api_m->m_get_temp_point_of_team(948534998);

            $mark = $mark + $temp_point;
        }

        echo $mark;*/

        // echo $this->api_m->get_count_history('273685955');
        //echo $this->api_m->get_station_hq(107);

    }

    function fuzzy_match($query, $target, $distance)
    {
        ##  set max substitution steps if set to 0
        if ($distance == 0) {
            $length = strlen($query);
            if ($length > 10) {
                $distance = 4;
            } elseif ($length > 6) {
                $distance = 3;
            } else {
                $distance = 2;
            }
        }
        $lev = levenshtein(strtolower($query), strtolower($target));
        if ($lev <= $distance) {
            return array('match' => 1, 'distance' => $lev, 'max_distance' => $distance);
        } else {
            return array('match' => 0, 'distance' => $lev, 'max_distance' => $distance);
        }
    }

    public function requestcurrentchallenge()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!.",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        //get challenge id from client
        if (isset($challenge_id)) {
            $challenge_id = $_REQUEST["challenge_id"];
        } else {
            $challenge_id = "";
        }

        //check access_code valid
        if ($access_code != null and $access_code != "") {
            //get data from database with acess_code
            $requestcurrentchallenge = $this->_data['challenge'] = $this->api_m->m_latestclude($access_code);

            //get all id challenge in table station
            $listchallengeId = $requestcurrentchallenge->listchallengeId;
            $listId = explode(",", $listchallengeId);

            foreach ($listId as $str) {
                if ($str == $challenge_id) {
                    $challenge_hint = $this->_data["challenge_hint"] = $this->api_m->m_challenges_hint($challenge_id);
                    $hint_info = array(
                        "error_id" => "0",
                        "error_message" => "",
                        "timestamp" => date("Y-m-d H:i:s", time()),
                        "response" => array("hint_info" => $challenge_hint->Notes)
                    );
                    echo json_encode($hint_info);
                    break;
                }
            }

        } else {
            $error = array("error_id" => "3");
            echo json_encode($error);
        }
    }

    public function get_position_team()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again! . ",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        if (isset($_REQUEST['game_id'])) {
            $game_id = $_REQUEST['game_id'];
        } else {
            $game_id = "";
        }

        //check access_code valid
        if ($access_code != null and $access_code != "") {

            $num_standing_team = 0;

            //request teams list
            $request_teamstanding = $this->api_m->m_listteam_standing($game_id);
            //response list team for client
            $i = 0;

            foreach ($request_teamstanding as $team) {
                $i = $i + 1;
                if ($team->AccessCode == $access_code) {
                    $num_standing_team = $i;
                    break;
                }
            }
            $arr_list_team = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array("position" => $num_standing_team)
            );
            echo json_encode($arr_list_team);
        } else {
            $error = array("error_id" => "3");
            echo json_encode($error);
        }
    }

    //This method is called to current position of team in game
    public function get_game_standing()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again! . ",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }
        //get game id from client
        if (isset($_REQUEST['game_id'])) {
            $game_id = $_REQUEST['game_id'];
        } else {
            $game_id = "";
        }

        //check access_code valid
        if ($access_code != null and $access_code != "") {

            //request teams list
            $request_teamstanding = $this->api_m->m_listteam_standing($game_id);
            //response list team for client

            $i = 0;
            $arr_list_team = array();
            foreach ($request_teamstanding as $team) {
                $i = $i + 1;
                $arr_list_team[] = array(
                    'team_standing' => $i,
                    'team_id' => $team->AccessCode,
                    'team_name' => $team->Name,
                    'totalpoint' => $team->TotalPoint,
                    'status_text' => $team->StatusText
                );
            }
            $response = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => $arr_list_team
            );
            echo json_encode($response);
        } else {
            $error = array("error_id" => "3");
            echo json_encode($error);
        }
    }

    //This method is called to post status of team in game
    public function post_status()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again! . ",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        if (isset($_REQUEST['status_message'])) {
            $status_message = $_REQUEST['status_message'];
        } else {
            $status_message = "";
        }

        $result = $this->api_m->m_update_status_text_teams($access_code, $status_message);
        if ($result) {
            $response = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array("status" => 1)
            );
            echo json_encode($response);
        } else {
            $response = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => array("status" => 0)
            );
            echo json_encode($response);
        }
    }

    //This method is called to get history playing game of team at each station
    public function game_history()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again! . ",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        //check access_code valid
        if ($access_code != null and $access_code != "") {

            //response list game history for client
            $arr_list_history = array();
            $game_history = $this->api_m->get_game_history($access_code);

            $query = $game_history->result();
            if (count($query) != 0) {
                foreach ($query as $item) {
                    $arr_list_history[] = array(
                        "id" => $item->Id,
                        "access_code" => $item->AccessCode,
                        "mark" => $item->Mark,
                        "station_name" => $item->StationName
                    );
                }
            }
            $response = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => $arr_list_history
            );

            echo json_encode($response);
        } else {
            $response = array(
                "error_id" => "2",
                "error_message" => "AccessCode invalid!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($response);
        }
    }

    //This method is called to get all clue of mini game who am i
    public function get_clue_whoami()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again! . ",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        //get game id from client
        if (isset($_REQUEST['game_id'])) {
            $game_id = $_REQUEST['game_id'];
        } else {
            $game_id = 0;
        }

        $answer_id = $this->api_m->get_answer_id_from_game($game_id);

        $list_clue = $this->api_m->get_clue_who_am_i($answer_id);

        if (count($list_clue) != 0) {

            //response list game clue for client
            $arr_list_clue = array();

            foreach ($list_clue as $item) {
                $arr_list_clue[] = array(
                    "" => $item->Clue
                );

            }

            $response = array(
                "error_id" => "0",
                "error_message" => "",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => $arr_list_clue
            );
            echo json_encode($response);

        } else {
            $response = array(
                "error_id" => "5",
                "error_message" => "Clue for game is empty!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($response);
        }

    }

    //This method is called to answer game who am i
    public function answer_whoami()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again! . ",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        //get game id from client
        if (isset($_REQUEST['game_id'])) {
            $game_id = $_REQUEST['game_id'];
        } else {
            $game_id = 0;
        }

        //get game id from client
        if (isset($_REQUEST['answer'])) {
            $req_answer = $_REQUEST['answer'];
        } else {
            $req_answer = "";
        }

        $answer_id = $this->api_m->get_answer_id_from_game($game_id);

        $answer = $this->api_m->get_answer_who_am_i($answer_id);

        $res_answer = isset($answer->Answer) ? $answer->Answer : "";

        $distance = strlen($req_answer);

        $result = $this->fuzzy_match($req_answer, $res_answer, $distance);

        $mark_mini_game = $this->api_m->get_max_point_checkIn()->Maxpoint_GameMini;
        $mark = 0;
        if ($result['match'] == 1 and $result['distance'] == 0) {
            $exist = $this->api_m->insert_game_mini($access_code, $game_id);
            if (!$exist) {
                $response = array(
                    "error_id" => "7",
                    "error_message" => "Access code ready to play game mini",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => '[]'
                );
                echo json_encode($response);
                exit();
            }
            $count = $this->api_m->count_game_mini($game_id);
            if ($count == 1) {
                $mark = $mark_mini_game;
            }
            if ($count == 2) {
                $mark = ($mark_mini_game * 50) / 100;
            }
            if ($count == 3) {
                $mark = ($mark_mini_game * 30) / 100;
            }
            if ($count == 4) {
                $mark = ($mark_mini_game * 20) / 100;
            }
            if ($count >= 5) {
                $mark = ($mark_mini_game * 10) / 100;
            }
            $this->api_m->m_update_total_point_teams($access_code, $mark);
            $this->api_m->insert_game_history($access_code, $mark,
                "Who am i", 0);
            $status = 1;
        } else {
            $status = 0;
        }

        $response = array(
            "error_id" => "0",
            "error_message" => "",
            "timestamp" => date("Y-m-d H:i:s", time()),
            "response" => array("status" => $status)
        );
        echo json_encode($response);
    }

    //add point check in right for history
    public function update_point_check_in_location()
    {
        //get access code from client
        if (isset($_REQUEST['access_code'])) {
            $access_code = $_REQUEST['access_code'];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        //get mark from client
        if (isset($_REQUEST['mark'])) {
            $mark = $_REQUEST['mark'];
        } else {
            $mark = 0;
        }

        //get station id from client
        if (isset($_REQUEST["station_id"])) {
            $station_id = $_REQUEST["station_id"];
        } else {
            $station_id = "";
        }
        //get station name
        if (isset($_REQUEST['station_name'])) {
            $station_name = $_REQUEST['station_name'];
        } else {
            $station_name = "";
        }

        $this->api_m->insert_game_history($access_code, $mark,
            $station_name, $station_id);

        $success = array(
            "error_id" => "0",
            "error_message" => "",
            "timestamp" => date("Y-m-d H:i:s", time()),
            "response" => array(
                "status" => "1"
            ));

        echo json_encode($success);
    }

    //save data for continue game
    public function save_data($stationId, $access_code, $gameId, $challengeId, $status)
    {
        $data = array(
            "stationId" => $stationId,
            "access_code" => $access_code,
            "gameId" => $gameId,
            "challengeId" => $challengeId,
            "status" => $status,
            "createdate" => date("Y-m-d H:i:s", time())
        );
        $this->api_m->m_insert_join_game($data);
    }

    //check hq
    public function check_in_location_hq()
    {
        //get access_code from client
        if (isset($_REQUEST["access_code"])) {
            $access_code = $_REQUEST["access_code"];
            if (!is_numeric($access_code)) {
                $error = array(
                    "error_id" => "2",
                    "error_message" => "Access code contains only digits ",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => "[]"
                );
                echo json_encode($error);
                exit();
            }
        } else {
            $error = array(
                "error_id" => "2",
                "error_message" => "Wrong access code, try again!",
                "timestamp" => date("Y-m-d H:i:s", time()),
                "response" => "[]"
            );
            echo json_encode($error);
            exit();
        }

        //get latitute from client
        if (isset($_REQUEST["latitude"])) {
            $latitude = ($_REQUEST["latitude"]);
        } else {
            $latitude = 0;
        }

        //get longitude from client
        if (isset($_REQUEST["longitude"])) {
            $longitude = ($_REQUEST["longitude"]);
        } else {
            $longitude = 0;
        }

        //get station id from client
        if (isset($_REQUEST["game_id"])) {
            $game_id = $_REQUEST["game_id"];
        } else {
            $game_id = 0;
        }

        $station_id = $this->api_m->get_station_hq($game_id);
        //get data from database with acess_code
        $check_in_location = $this->api_m->m_stations($station_id);

        if (count($check_in_location) != 0) {

            $db_lat = trim($check_in_location->LocationLat);

            $db_long = trim($check_in_location->LocationLong);

            $distance = round($this->distance($latitude, $longitude, $db_lat, $db_long, "m"));

            if ($distance == 0 or $distance <= 30) {

                $response = array(
                    "error_id" => "0",
                    "error_message" => "",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => array("status" => 1)
                );
                echo json_encode($response);
            } else {
                $response = array(
                    "error_id" => "0",
                    "error_message" => "",
                    "timestamp" => date("Y-m-d H:i:s", time()),
                    "response" => array("status" => 0)
                );
                echo json_encode($response);
            }
        }
    }
}