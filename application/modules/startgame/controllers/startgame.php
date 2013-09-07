<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:51 PM
 * To change this template use File | Settings | File Templates.
 */
date_default_timezone_set("UTC");
class startgame extends Admin_Controller
{

    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('start_game_m'));
        $this->load->model('area/area_m', 'area_m');
        $this->load->model('who_am_i/who_am_i_m', 'who_am_i_m');
    }

    public function index()
    {
        $this->view();
    }

    public function view()
    {

        $this->_data['listArea'] = $this->area_m->LoadOptionChoose(true);
        $game_type = $this->start_game_m->get_game_type();
        //$area = $this->start_game_m->get_areas();
        $time_limit = $this->start_game_m->get_time_limit();
        $list_answer = $this->who_am_i_m->get_all();


        $this->_data['game_type'] = $game_type;
        $this->_data['list_answer'] = $list_answer;
        //$this->_data['area'] = $area;
        $this->_data['time_limit'] = $time_limit;
        $this->_data['list_game'] = "";

        if (isset($_REQUEST["type"])) {
            $gameId = $_REQUEST["gameId"];
            $list_game = $this->start_game_m->get_game_parameter_by_id($gameId);

            $this->_data['list_game'] = $list_game;
            $this->_data['listArea'] = $this->area_m->LoadOptionChoose(true, $list_game->AreaId);

            $this->template
                ->set_metadata('description', 'Start a game > Game Parameters')
                ->set_metadata('keywords', 'Start a game > Game Parameters')
                ->title('Start A Game')
                ->build('startgame', $this->_data, FALSE);

        } else {
            $this->template
                ->set_metadata('description', 'Start a game > Game Parameters')
                ->set_metadata('keywords', 'Start a game > Game Parameters')
                ->title('Start A Game')
                ->build('startgame', $this->_data, FALSE);
        }

    }

    public function generate_random_station()
    {
        $game_type_id = trim($_REQUEST['cboGameType']);
        $rob = isset($_REQUEST['chkRob']);
        if ($rob) {
            $rob_enable = 1;
        } else {
            $rob_enable = 0;
        }
        $question_diff = trim($_REQUEST['cboDiff']);
        $area_id = trim($_REQUEST['cbArea']);
        $answer_id = trim($_REQUEST['cbAnswer']);
        $time_limit = trim($_REQUEST['cboTimeLimit']);
        $no_of_station = trim($_REQUEST['txtStations']);
        $no_of_team = trim($_REQUEST['txtTeams']);
        $game_name = trim($_REQUEST['txtGameName']);
        $phone_hint = trim($_REQUEST['txtPhoneHint']);
        //Allow Possible Return to Race HQ
        $race_hq = isset($_REQUEST['chkRace']);
        if ($race_hq) {
            $allow_possible = 1;
        } else {
            $allow_possible = 0;
        }


        $game_id = $_REQUEST['txt_game_id'];


        if ($game_id != null or $game_id != "") {

            $data = array(
                "GameTypeId" => $game_type_id,
                "Enabled20Quetion" => $rob_enable,
                "QuestionDifficulty" => $question_diff,
                "AreaId" => $area_id,
                "NoOfStations" => $no_of_station,
                "NoOfTeam" => $no_of_team,
                "AllowPossible" => $allow_possible,
                "ListTeamId" => "",
                "TimeLimit" => $time_limit,
                "StartTime" => date("Y-m-d H:i:s", time()),
                "TimeRemain" => $time_limit,
                "phonehint" => $phone_hint,
                "AnswerId" => $answer_id,
                "GameName" => $game_name
            );
            /*$random_station = $this->start_game_m->get_station_by_area_id($area_id, $no_of_station);

            foreach ($random_station as $item) {
                $this->start_game_m->m_insert_g_s_temp_first($game_id, $item->Id);
            }*/
            $this->start_game_m->update_by_game_parameters($game_id, $data);
            redirect("startgame/station?game_id=" . $game_id);
        } else {

            $data = array(
                "GameTypeId" => $game_type_id,
                "Enabled20Quetion" => $rob_enable,
                "QuestionDifficulty" => $question_diff,
                "AreaId" => $area_id,
                "NoOfStations" => $no_of_station,
                "NoOfTeam" => $no_of_team,
                "AllowPossible" => $allow_possible,
                "ListTeamId" => "",
                "TimeLimit" => $time_limit,
                "StartTime" => date("Y-m-d H:i:s", time()),
                "TimeRemain" => $time_limit,
                "phonehint" => $phone_hint,
                "UserId" => $this->session->userdata("Id"),
                "AnswerId" => $answer_id,
                "GameName" => $game_name
            );

            $game_parameter_id = $this->start_game_m->m_insert_game_parameters($data);

            /*$random_station = $this->start_game_m->get_station_by_area_id($area_id, $no_of_station);

            foreach ($random_station as $item) {
                $this->start_game_m->m_insert_g_s_temp_first($game_parameter_id, $item->Id);
            }*/

            redirect("startgame/station?game_id=" . $game_parameter_id);
        }
    }

    public function check_station_by_area_id()
    {
        $area_id = $_POST["area_id"];
        $data = $this->start_game_m->check_station_by_area_id($area_id);
        echo count($data);

    }

    public function check_exist_game_hq()
    {
        $game_id = $_POST["game_id"];
        $kt = $this->start_game_m->get_game_hq($game_id);
        if (count($kt) > 0) {
            echo true;
        } else
            echo false;
    }

    public function insert_game_hq()
    {
        $game_id = $_POST["game_id"];
        $station_id = $_POST["station_id"];
        $challenge_id = $_POST["challenge_id"];
        $data = array(
            "game_id" => $game_id,
            "station_id" => $station_id,
            "challenge_id" => $challenge_id
        );

        $kt = $this->start_game_m->get_game_hq($game_id);
        if (count($kt) > 0) {
            $d = array(
                "game_id" => $game_id
            );
            $this->start_game_m->delete_game_hq($d);
        }
        echo $this->start_game_m->insert_game_hq($data);
    }

    public function get_challenge_by_station()
    {
        $game_id = $_POST["game_id"];
        $station_id = $_POST["station_id"];
        $data = $this->start_game_m->get_challenge_by_station($station_id);
        $kt = $this->start_game_m->get_game_hq($game_id);

        $str = "";
        foreach ($data as $item) {
            $selected = count($kt) > 0 && $kt->challenge_id == $item->ChallengeId ? "selected" : "";
            $str .= "<option value=" . $item->ChallengeId . " " . $selected . ">.$item->Description.</option>";
        }
        echo $str;
    }

    public function station()
    {

        $game_parameter_id = $_REQUEST['game_id'];

        $kt = $this->start_game_m->get_game_hq($game_parameter_id);
        if (count($kt) > 0) {
            $this->_data['game_hq'] = $kt;
        } else {
            $this->_data['game_hq'] = null;
        }
        $game = $this->start_game_m->get_game_parameter_by_id($game_parameter_id);

        $no_of_team = $game->NoOfTeam;

        $g_s_temp = $this->start_game_m->m_get_g_s_temp($game_parameter_id);

        $allStation = $this->start_game_m->get_all_station($game->AreaId);

        $no_of_station = $game->NoOfStations;

        $this->_data['game_id'] = $game_parameter_id;
        $this->_data['random_station'] = $g_s_temp;
        $this->_data['max_station'] = $no_of_station;
        $this->_data['no_of_team'] = $no_of_team;
        $this->_data['allStation'] = $allStation;

        $this->template
            ->set_metadata('description', 'Start a game > Station')
            ->set_metadata('keywords', 'Start a game > Station')
            ->title('Start A Game')
            ->build('startgame/stations', $this->_data, FALSE);
    }

    public function add_gs_temp()
    {
        $stationId = $_REQUEST['stationId'];

        $gameId = $_REQUEST['game_id'];

        $max_station = intval($_REQUEST['max_station']);

        $numStation = count($this->start_game_m->get_count_g_s_temp($gameId));

        if ($numStation < $max_station) {
            $data = array(
                "GameParameterId" => $gameId,
                "StationId" => $stationId
            );

            $check_count = $this->start_game_m->check_count_g_s_temp($gameId, $stationId);

            if (count($check_count) > 0) {
                echo "Station is exist.";
            } else {
                $this->start_game_m->m_insert_g_s_temp($data);
                echo "Add station successfully.";
            }

        } else {
            echo("Station max " . $numStation);
        }

    }


    public function remove_gs_temp()
    {

        $stationId = $_REQUEST['stationId'];
        $gameId = $_REQUEST['game_id'];

        $data = array(
            "GameParameterId" => $gameId,
            "StationId" => $stationId
        );
        $this->start_game_m->m_delete_g_s_temp($data);

    }

    public function define_team()
    {
        //$this->load->library('form_validation');
        $no_of_teams = $_REQUEST['no_of_team'];
        $game_id = $_REQUEST['game_id'];
        //for ($i = 1; $i < $no_of_teams; $i++) {
        //    $this->form_validation->set_rules('txtTeams' . $i, 'Teams Name', 'required');
        //}
        $this->_data['no_of_teams'] = $no_of_teams;
        $this->_data['game_id'] = $game_id;

        $this->template
            ->set_metadata('description', 'Start a game > Teams')
            ->set_metadata('keywords', 'Start a game > Teams')
            ->title('Start A Game')
            ->build('startgame/teams', $this->_data, FALSE);
    }

    public function game_summary()
    {
        $this->load->library('form_validation');
        $game_id = $_REQUEST['txt_game_id'];
        $no_of_teams = $_REQUEST['txt_no_of_team'];

        for ($i = 1; $i <= $no_of_teams; $i++) {

            $team_name = $_REQUEST['txtTeamName' . $i];
            $access_code = $_REQUEST['access_code' . $i];

            $arr_team = array(
                "Name" => $team_name,
                "AccessCode" => $access_code,
                "GameParameterId" => $game_id,
                "StatusText" => "",
                "TotalPoint" => 0
            );
            $this->start_game_m->m_insert_teams($arr_team, $access_code);
        }

        $list_team = $this->start_game_m->m_get_team_game_game_parameters_id($game_id);

        $this->_data['arr_team'] = $list_team;

        $game_summary = $this->start_game_m->m_get_game($game_id);

        $this->_data['game_summary'] = $game_summary;

        $this->_data['no_of_team'] = $game_summary->NoOfTeam;

        $this->_data['no_of_station'] = $game_summary->NoOfStations;

        $area = $this->start_game_m->m_get_area_id($game_summary->AreaId);

        $this->_data['area'] = $area;

        $this->template
            ->set_metadata('description', 'Start a game > Teams')
            ->set_metadata('keywords', 'Start a game > Teams')
            ->title('Start A Game')
            ->build('startgame/gamesumary', $this->_data, FALSE);
    }

    public function final_standing()
    {
        $game_id = $_REQUEST['txt_game_id'];

        $final_standing = $this->start_game_m->m_get_final_standing_team($game_id);

        $this->_data['final_standing'] = $final_standing;

        $this->template
            ->set_metadata('description', 'Bob\'s Bachelor Party SPANQ Summary')
            ->set_metadata('keywords', 'Bob\'s Bachelor Party SPANQ Summary')
            ->title('Bob\'s Bachelor Party SPANQ Summary')
            ->build('startgame/finalstanding', $this->_data, FALSE);
    }

}