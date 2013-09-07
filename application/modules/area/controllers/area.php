<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/14/13
 * Time: 7:06 PM
 * To change this template use File | Settings | File Templates.
 */

class Area extends Admin_Controller
{
    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('area_m'));
        $this->load->model('station/station_m', 'station_m');
    }

    public function index()
    {

        $this->_data['strArea'] = $this->area_m->LoadTree();
        //$this->_data['strArea'] = $this->area_m->get_table();
        $this->template
            ->set_metadata('description', 'Area')
            ->set_metadata('keywords', 'Area')
            ->title('Area')
            ->build('area', $this->_data, FALSE);
    }

    public function edit()
    {
        $id = $_REQUEST["Id"];
        $area = $this->area_m->get_by($id);
        $this->_data["area"] = $area;
        $this->_data['listArea'] = $this->area_m->LoadOption(true, $area->ParentId);
        $this->_data['listStation'] = $this->area_m->get_a_s_temp_by_area_id($area->Id);
        $this->_data['allStation'] = $this->station_m->get_all();
        $this->template
            ->set_metadata('description', 'Area')
            ->set_metadata('keywords', 'Area')
            ->title('Area')
            ->build('area/editarea', $this->_data, FALSE);
    }

    public function update()
    {
        $id = $this->input->post('txtId');
        $data = array(
            'Name' => $this->input->post('txtName'),
            'ParentId' => $this->input->post('cbArea')
        );
        if (!$this->area_m->update_by($id, $data)) {
            echo 'false';
        } else {
            redirect('area');
        }

    }

    public function addastemp()
    {
        $areaId = $_POST['areaId'];
        $stationId = $_POST['stationId'];

        $data = array(
            "AreaId" => $areaId,
            "StationId" => $stationId,
        );

        echo $this->area_m->addastemp($data);
    }

    public function removeastemp()
    {
        $areaId = $_POST['areaId'];
        $stationId = $_POST['stationId'];

        $data = array(
            "AreaId" => $areaId,
            "StationId" => $stationId,
        );

        echo $this->area_m->removeastemp($data);

    }

    public function delete_by()
    {
        $Id = $_POST['Id'];

        $data = array(
            "Id" => $Id
        );
        return $this->area_m->delete_by($data);
    }
}