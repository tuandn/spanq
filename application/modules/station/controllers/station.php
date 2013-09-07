<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:51 PM
 * To change this template use File | Settings | File Templates.
 */

class Station extends Admin_Controller
{

    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('station_m'));
        $this->load->model('area/area_m', 'area_m');
        $this->load->model('challenge/challenge_m', 'challenge_m');
        $this->load->model('api/api_m', 'api_m');
    }

    public function index()
    {
        redirect("station/view");
    }

    public function view()
    {
        $this->_data['listStation'] = $this->station_m->get_all();
        $this->template
            ->set_metadata('description', 'station')
            ->set_metadata('keywords', 'station')
            ->title('station')
            ->build('station', $this->_data, FALSE);
    }

    public function addstation()
    {
        $this->_data['listArea'] = $this->area_m->LoadOption(false);
        $this->template
            ->set_metadata('description', 'station')
            ->set_metadata('keywords', 'station')
            ->title('station')
            ->build('station/addstation', $this->_data, FALSE);
    }

    public function insert()
    {
        $data = array(
            'Name' => $this->input->post('txtName'),
            'Address' => $this->input->post('txtAddress'),
            'AreaId' => $this->input->post('cbArea'),
            'LocationLat' => $this->input->post('txtLat'),
            'LocationLong' => $this->input->post('txtLong'),
            'Clue' => $this->input->post('txtClue'),
            'Difficulty' => $this->input->post('cboDiff'),
            'ContactPerson' => $this->input->post('txtPerson'),
            'ContactEmail' => $this->input->post('txtEmail'),
            'ContactPhone' => $this->input->post('txtPhone'),
        );
        if (!$this->station_m->insert($data)) {
            redirect('station/addstation');
        } else {
            redirect('station');
        }

    }

    public function edit()
    {
        $id = $_REQUEST["Id"];
        $station = $this->station_m->get_by($id);
        $this->_data["station"] = $station;
        $this->_data['listArea'] = $this->area_m->LoadOption(false, $station->AreaId);
        $this->_data['listChallenge'] = $this->station_m->get_challenge_by_station($id);
        $this->_data['allChallenge'] = $this->challenge_m->get_all();

        $this->template
            ->set_metadata('description', 'station')
            ->set_metadata('keywords', 'station')
            ->title('station')
            ->build('station/editstation', $this->_data, FALSE);
    }

    public function addcstemp()
    {
        $challengeId = $_POST['challengeId'];
        $stationId = $_POST['stationId'];

        $data = array(
            "ChallengeId" => $challengeId,
            "StationId" => $stationId,
        );

        return $this->station_m->addcstemp($data);
    }

    public function removecstemp()
    {
        $challengeId = $_POST['challengeId'];
        $stationId = $_POST['stationId'];

        $data = array(
            "ChallengeId" => $challengeId,
            "StationId" => $stationId,
        );

        return $this->station_m->removecstemp($data);
    }

    public function update()
    {
        $id = $this->input->post('txtId');
        $currentPage = $this->input->post('currentPage');
        $data = array(
            'Name' => $this->input->post('txtName'),
            'Address' => $this->input->post('txtAddress'),
            'AreaId' => $this->input->post('cbArea'),
            'LocationLat' => $this->input->post('txtLat'),
            'LocationLong' => $this->input->post('txtLong'),
            'Clue' => $this->input->post('txtClue'),
            'Difficulty' => $this->input->post('cboDiff'),
            'ContactPerson' => $this->input->post('txtPerson'),
            'ContactEmail' => $this->input->post('txtEmail'),
            'ContactPhone' => $this->input->post('txtPhone'),
        );
        if (!$this->station_m->update_by($id, $data)) {
            redirect("station/edit?Id=" . $id . "&currentPage=" . $currentPage);
        } else {
            if ($currentPage == 1) {
                redirect('station/view');
            } else {
                redirect('station/view/' . $currentPage);
            }
        }
    }

    public function delete_by()
    {
        $Id = $_POST['Id'];

        $data = array(
            "Id" => $Id
        );
        return $this->station_m->delete_by($data);
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


}