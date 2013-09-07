<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/11/13
 * Time: 10:31 PM
 * To change this template use File | Settings | File Templates.
 */

class Group extends Admin_Controller
{
    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('group_m'));
        $this->load->model('area/area_m', 'area_m');
        $this->load->model('user/user_m', 'user_m');
    }

    public function index()
    {
        redirect("group/view");
    }

    public function addgroup()
    {
        $this->_data['listArea'] = $this->area_m->LoadOption();
        $this->template
            ->set_metadata('description', 'Create Groups')
            ->set_metadata('keywords', 'Create Groups')
            ->title('Create Groups')
            ->build('group/addgroup', $this->_data, FALSE);
    }

    public function insert()
    {
        $data = array(
            'Name' => $this->input->post('txtName'),
            'Contact' => $this->input->post('txtContact'),
            'AreaId' => $this->input->post('cbArea')
        );
        if (!$this->group_m->insert($data)) {
            redirect('group/addgroup');
        } else {
            redirect('group');
        }

    }

    public function view()
    {
        $this->_data['listGroup'] = $this->group_m->get_all();

        $this->template->set_metadata('description', 'Groups')
            ->set_metadata('keywords', 'Groups')
            ->title('Groups')
            ->build('group/group_v', $this->_data, FALSE);


    }

    public function delete_by()
    {
        $Id = $_POST['Id'];

        $data = array(
            "Id" => $Id
        );
        return $this->group_m->delete_by($data);
    }

    public function edit()
    {
        $id = $_REQUEST["Id"];
        $group = $this->group_m->get_by($id);
        $this->_data["group"] = $group;
        $this->_data['listArea'] = $this->area_m->LoadOption(false, $group->AreaId);
        $this->_data['listUser'] = $this->group_m->get_group_user($group->Id);
        $this->_data['allUser'] = $this->user_m->get_all();
        $this->template
            ->set_metadata('description', 'Groups')
            ->set_metadata('keywords', 'Groups')
            ->title('Groups')
            ->build('group/editgroup', $this->_data, FALSE);
    }

    public function update()
    {
        $id = $this->input->post('txtId');
        $currentPage = $this->input->post('currentPage');
        $data = array(
            'Name' => $this->input->post('txtName'),
            'Contact' => $this->input->post('txtContact'),
            'AreaId' => $this->input->post('cbArea')
        );
        if (!$this->group_m->update_by($id, $data)) {
            echo 'false';
        } else {
            if ($currentPage == 1) {
                redirect('group/view');
            } else {
                redirect('group/view/' . $currentPage);
            }
        }

    }

    public function add_group_user()
    {
        $groupId = $_POST['groupId'];
        $userId = $_POST['userId'];

        $data = array(
            "GroupId" => $groupId,
            "UserId" => $userId,
        );
        echo $this->group_m->add_group_user($data);
    }

    public function delete_group_user()
    {
        $groupId = $_POST['groupId'];
        $userId = $_POST['userId'];

        $data = array(
            "GroupId" => $groupId,
            "UserId" => $userId,
        );

        echo $this->group_m->delete_group_user($data);
    }
}