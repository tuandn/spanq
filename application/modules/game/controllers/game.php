<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 24/07/2013
 * Time: 23:11
 * To change this template use File | Settings | File Templates.
 */

class Game extends Admin_Controller
{
    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('game_m'));
        $this->load->model('api/api_m', "api_m");
        $this->load->model('setting/setting_m', "setting_m");
    }

    public function index()
    {
        $this->_data['all_game'] = $this->game_m->get_games();
        $this->template
            ->set_metadata('description', 'All Games')
            ->set_metadata('keywords', 'All Games')
            ->title('All Games')
            ->build('game', $this->_data, FALSE);
    }

    public function get_team_by_percent_comp($game_id)
    {
        $result = array();
        $list_team = $this->game_m->get_team_by_game_id($game_id);
        $i = 0;
        foreach ($list_team as $item) {
            $i++;
            $access_code = $item->AccessCode;
            $total_station = $this->game_m->get_no_of_station_by_access_code($access_code);
            $station_comp = $this->game_m->count_station_comp_by_access_code($access_code);

            $comp = $station_comp / $total_station * 100;

            $result[] = array(
                "Pos" => $i,
                "Team" => $item->Name,
                "Comp" => $comp
            );
        }
        return $result;
    }

    public function view()
    {
        $this->_data['challenge_d'] = $this->setting_m->get_challenge_by();
        $this->_data['checkin_d'] = $this->setting_m->get_check_in_by();

        $game_id = $_REQUEST['Id'];

        $game_summary = $this->game_m->m_get_game($game_id);

        $this->_data['list_team_comp'] = $this->get_team_by_percent_comp($game_id);

        $this->_data['game_summary'] = $game_summary;
        $list_team = $this->game_m->get_team_by_game_id($game_id);
        $this->_data['list_team'] = $list_team;

        // list reg_id
        $list_reg_id = "";
        foreach ($list_team as $item) {
            $spit = $list_reg_id == "" ? "" : "|";
            $list_reg_id .= $spit . $item->regId;
        }

        $this->_data['list_reg_id'] = $list_reg_id;

        $area = $this->game_m->m_get_area_id($game_summary->AreaId);

        $this->_data['area'] = $area;
        $this->template
            ->set_metadata('description', 'All Games')
            ->set_metadata('keywords', 'All Games')
            ->title('All Games')
            ->build('view', $this->_data, FALSE);
    }


    //function using google cloud message with send message to device
    public function send_notify_message()
    {
        $list_reg_id = $_REQUEST['list_reg_id'];
        $message = $_REQUEST['message'];
        $type = $_REQUEST['type'];
        $arr_reg_id = explode("|", $list_reg_id);

        foreach ($arr_reg_id as $item) {

            $mes = array("message" => $message, "type" => $type);
            $reg_id = array($item);

            echo $result = $this->send_notification($reg_id, $mes);
        }
    }

    /**
     * Sending Push Notification
     */
    public function send_notification($reg_id, $message)
    {
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $reg_id,
            'data' => $message
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


}