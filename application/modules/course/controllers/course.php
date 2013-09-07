<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:51 PM
 * To change this template use File | Settings | File Templates.
 */
date_default_timezone_set("UTC");
class Course extends Admin_Controller
{

    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('course_m'));
        $this->load->model('area/area_m', 'area_m');
        $this->load->model('who_am_i/who_am_i_m', 'who_am_i_m');
        $this->load->model('startgame/start_game_m', 'start_game_m');
    }

    public function view_course()
    {
        $this->_data['all_game'] = $this->course_m->get_list_course();
        $this->template
            ->set_metadata('description', 'SPANQ -  Courses')
            ->set_metadata('keywords', 'SPANQ -  Courses')
            ->title('SPANQ -  Courses')
            ->build('course/view_course', $this->_data, FALSE);
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
                ->set_metadata('description', 'Create course')
                ->set_metadata('keywords', 'Create course')
                ->title('Create course')
                ->build('course', $this->_data, FALSE);

        } else {
            $this->template
                ->set_metadata('description', 'Create course')
                ->set_metadata('keywords', 'Create course')
                ->title('Create course')
                ->build('course', $this->_data, FALSE);
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
        $is_publish = trim($_REQUEST['cbPublish']);
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
                "GameName" => $game_name,
                "IsCourse" => 1,
                "IsPublished" => $is_publish

            );

            $this->start_game_m->update_by_game_parameters($game_id, $data);
            redirect("course/station?game_id=" . $game_id);
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
                "GameName" => $game_name,
                "IsCourse" => 1,
                "IsPublished" => $is_publish
            );

            $game_parameter_id = $this->start_game_m->m_insert_game_parameters($data);

            redirect("course/station?game_id=" . $game_parameter_id);
        }
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
            ->set_metadata('description', 'Create course > Station')
            ->set_metadata('keywords', 'Create course > Station')
            ->title('Create course')
            ->build('course/stations', $this->_data, FALSE);
    }


}