<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/6/13
 * Time: 11:33 AM
 * To change this template use File | Settings | File Templates.
 */

class User extends Admin_Controller
{
    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('user_m'));
        $this->load->model('group/group_m', 'group_m');
    }

    public function index()
    {
        redirect("user/view");
    }

    public function adduser()
    {
        $this->_data['listGroup'] = $this->group_m->get_all();
        $this->_data['listRole'] = $this->user_m->get_role();
        $this->template
            ->set_metadata('description', 'Create User')
            ->set_metadata('keywords', 'Create User')
            ->title('Create User')
            ->build('user/adduser', $this->_data, FALSE);
    }

    public function view()
    {
        $this->_data['listUser'] = $this->user_m->get_all();

        $this->template
            ->set_metadata('description', 'Users & Groups')
            ->set_metadata('keywords', 'Users & Groups')
            ->title('Users & Groups')
            ->build('user', $this->_data, FALSE);
    }

    public function edit()
    {
        $id = $_REQUEST["Id"];
        $user = $this->user_m->get_by($id);
        $this->_data["user"] = $user;
        $this->_data['listGroup'] = $this->group_m->get_all();
        $this->_data['listRole'] = $this->user_m->get_role();
        $this->template
            ->set_metadata('description', 'User')
            ->set_metadata('keywords', 'User')
            ->title('User')
            ->build('user/edituser', $this->_data, FALSE);
    }

    public function change_pass()
    {
        $id = $_REQUEST["Id"];
        $user = $this->user_m->get_by($id);
        $this->_data["user"] = $user;
        $this->template
            ->set_metadata('description', 'User')
            ->set_metadata('keywords', 'User')
            ->title('User')
            ->build('user/change_pass', $this->_data, FALSE);
    }

    public function update_pass()
    {
        $id = $this->input->post('txtId');
        $password = md5($this->input->post('txtPassword'));

        $data = array(
            'Password' => $password
        );
        if (!$this->user_m->update_by($id, $data)) {
            redirect('user/view?Id=' . $id);
        } else {
            redirect('user/view');
        }
    }

    public function delete_by()
    {
        $Id = $_POST['Id'];

        $data = array(
            "Id" => $Id
        );
        return $this->user_m->delete_by($data);
    }

    public function insert()
    {
        //$this->load->library('encrypt');
        $password = md5($this->input->post('txtPassword'));

        $data = array(
            'Name' => $this->input->post('txtName'),
            'Email' => $this->input->post('txtEmail'),
            'Phone' => $this->input->post('txtPhone'),
            'RoleId' => $this->input->post('cbRole'),
            'GroupId' => $this->input->post('cbGroup'),
            'Password' => $password
        );
        if (!$this->user_m->insert($data)) {
            redirect('user/adduser');
        } else {
            redirect('user');
        }
    }

    public function update()
    {
        $id = $this->input->post('txtId');
        $data = array(
            'Name' => $this->input->post('txtName'),
            //'Email' => $this->input->post('txtEmail'),
            'Phone' => $this->input->post('txtPhone'),
            'RoleId' => $this->input->post('cbRole'),
            'GroupId' => $this->input->post('cbGroup'),
            //'Password' => $password
        );
        if (!$this->user_m->update_by($id, $data)) {
            redirect('user/view?Id=' . $id);
        } else {
            redirect('user/view');
        }

    }
}