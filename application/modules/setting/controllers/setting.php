<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 23/06/2013
 * Time: 16:18
 * To change this template use File | Settings | File Templates.
 */

class Setting extends Admin_Controller
{
    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('setting_m');
    }

    public function index()
    {
        $this->checkin();
    }

    public function challenge()
    {
        $this->_data['challenge_d'] = $this->setting_m->get_challenge_by();
        $this->template
            ->set_metadata('description', 'Setting')
            ->set_metadata('keywords', 'Setting')
            ->title('Setting')
            ->build('setting/challenge', $this->_data, FALSE);
    }

    public function save_challenge()
    {
        $data = array(
            'E_BasePoint' => $this->input->post('txtEBasePoint'),
            'E_PenaltyPerFail' => $this->input->post('txtEpen'),
            'E_MaxNo' => $this->input->post('txtEMaxNo'),
            'D_BasePoint' => $this->input->post('txtDBasePoint'),
            'D_PenaltyPerFail' => $this->input->post('txtDpen'),
            'D_MaxNo' => $this->input->post('txtDMaxNo'),
        );
        if (!$this->setting_m->update_challenge_setting_by(1, $data)) {
            echo 'false';
        } else {
            redirect("setting/challenge");
        }

    }

    public function save_checkin()
    {
        $data = array(
            'NoInvalid' => $this->input->post('txtNoInvalid'),
            'PenaltyPerInvalid' => $this->input->post('txtPenInvalid'),
            'MaxNo' => $this->input->post('txtMaxNoPen'),
            'MaxPoint' => $this->input->post('txtMaxPoint')
        );
        if (!$this->setting_m->update_check_in_setting_by(1, $data)) {
            redirect("setting/checkin");
        } else {
            redirect("setting/checkin");
        }

        //}
    }

    public function save_who_am_i()
    {
        $data = array(
            'MaxPoint' => $this->input->post('txtMaxPointMini')
        );
        if (!$this->setting_m->update_who_am_i_setting_by(1, $data)) {
            redirect("setting/who_am_i");
        } else {
            redirect("setting/who_am_i");
        }
    }

    public function checkin()
    {
        $this->_data['checkin_d'] = $this->setting_m->get_check_in_by();
        $this->template
            ->set_metadata('description', 'Setting')
            ->set_metadata('keywords', 'Setting')
            ->title('Setting')
            ->build('setting/checkin', $this->_data, FALSE);
    }

    public function who_am_i()
    {
        $this->_data['who_am_i'] = $this->setting_m->get_who_am_i();
        $this->template
            ->set_metadata('description', 'Setting')
            ->set_metadata('keywords', 'Setting')
            ->title('Setting')
            ->build('setting/who_am_i', $this->_data, FALSE);
    }

    public function addmurder()
    {
        $this->template
            ->set_metadata('description', 'murder')
            ->set_metadata('keywords', 'murder')
            ->title('murder')
            ->build('setting/addmurder', $this->_data, FALSE);
    }

    public function edit_murder()
    {

        $id = $_REQUEST["Id"];
        $this->_data["murder"] = $this->setting_m->get_murder_by($id);
        $this->template
            ->set_metadata('description', 'murder')
            ->set_metadata('keywords', 'murder')
            ->title('murder')
            ->build('setting/editmurder', $this->_data, FALSE);
    }

    public function murder()
    {
        $this->_data['listMurder'] = $this->setting_m->list_murder();

        $this->template
            ->set_metadata('description', 'murder')
            ->set_metadata('keywords', 'murder')
            ->title('murder')
            ->build('setting/murder', $this->_data, FALSE);
    }

    public function insert_murder()
    {
        $data = array(
            'Type' => $this->input->post('txtType'),
            'Value' => $this->input->post('txtValue'),
        );
        if (!$this->setting_m->insert_murder($data)) {
            redirect('setting/addmurder');
        } else {
            redirect('setting/murder');
        }

    }

    public function update_murder()
    {
        $id = $this->input->post('txtId');
        $currentPage = $this->input->post('currentPage');
        $data = array(
            'Type' => $this->input->post('txtType'),
            'Value' => $this->input->post('txtValue'),
        );
        if (!$this->setting_m->update_murder($id, $data)) {
            redirect("setting/edit_murder?Id=" . $id . "&currentPage=" . $currentPage);
        } else {
            if ($currentPage == 1) {
                redirect('setting/murder');
            } else {
                redirect('setting/murder/' . $currentPage);
            }
        }
    }

    public function delete_by()
    {
        $Id = $_POST['Id'];

        $data = array(
            "Id" => $Id
        );
        return $this->setting_m->delete_by($data);
    }
}