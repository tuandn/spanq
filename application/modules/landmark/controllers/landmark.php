<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/11/13
 * Time: 11:19 AM
 * To change this template use File | Settings | File Templates.
 */

class Landmark extends Admin_Controller
{

    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('landmark_m'));
        $this->load->model('area/area_m', 'area_m');
    }

    public function index()
    {
        redirect("landmark/view");
    }

    public function addlandmark()
    {
        $this->_data['listArea'] = $this->area_m->LoadOption(false);
        $this->template
            ->set_metadata('description', 'Landmark')
            ->set_metadata('keywords', 'Landmark')
            ->title('Landmark')
            ->build('addlandmark', $this->_data, FALSE);
    }

    public function view()
    {
        $this->_data['listLandmark'] = $this->landmark_m->get_all();

        $this->template
            ->set_metadata('description', 'Landmark')
            ->set_metadata('keywords', 'Landmark')
            ->title('Landmark')
            ->build('landmark', $this->_data, FALSE);
    }

    public function edit()
    {
        $id = $_REQUEST["Id"];
        $landmark = $this->landmark_m->get_by($id);
        $this->_data["landmark"] = $landmark;
        $this->_data['listArea'] = $this->area_m->LoadOption(false, $landmark->AreaId);
        $this->template
            ->set_metadata('description', 'Landmark')
            ->set_metadata('keywords', 'Landmark')
            ->title('Landmark')
            ->build('landmark/editlandmark', $this->_data, FALSE);
    }

    public function update()
    {
        $this->load->library('form_validation');
        $id = $this->input->post('txtId');
        $currentPage = $this->input->post('currentPage');
        $this->form_validation->set_rules('txtName', 'Name', 'required');
        $this->form_validation->set_rules('txtAddress', 'Address', 'required');
        $this->form_validation->set_rules('txtLat', 'Location lat', 'required');
        $this->form_validation->set_rules('txtLong', 'Location long', 'required');
        if ($this->form_validation->run() == FALSE) {
            redirect("landmark/edit?Id=" . $id . "&currentPage=" . $currentPage);
        } else {
            $data = array(
                'Name' => $this->input->post('txtName'),
                'Address' => $this->input->post('txtAddress'),
                'AreaId' => $this->input->post('cbArea'),
                'LocationLat' => $this->input->post('txtLat'),
                'LocationLong' => $this->input->post('txtLong'),
            );
            if (!$this->landmark_m->update_by($id, $data)) {
                echo 'false';
            } else {
                if ($currentPage == 1) {
                    redirect('landmark/view');
                } else {
                    redirect('landmark/view/' . $currentPage);
                }
            }

        }
    }

    public function insert()
    {
        $data = array(
            'Name' => $this->input->post('txtName'),
            'Address' => $this->input->post('txtAddress'),
            'AreaId' => $this->input->post('cbArea'),
            'LocationLat' => $this->input->post('txtLat'),
            'LocationLong' => $this->input->post('txtLong'),
        );
        if (!$this->landmark_m->insert($data)) {
            redirect('landmark/addlandmark');
        } else {
            redirect('landmark');
        }

    }

    public function delete_by()
    {
        $Id = $_POST['Id'];

        $data = array(
            "Id" => $Id
        );
        return $this->landmark_m->delete_by($data);
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