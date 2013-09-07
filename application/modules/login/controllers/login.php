<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/6/13
 * Time: 4:42 PM
 * To change this template use File | Settings | File Templates.
 */

class Login extends Public_Controller
{
    private $_data = array();

    public function __construct()
    {
        // Load the model
        $this->load->model('login_m');
    }

    public function index($msg = NULL)
    {
        $this->_data['msg'] = $msg;
        $this->template
            ->set_metadata('description', 'Login')
            ->set_metadata('keywords', 'Login')
            ->title('Login')
            ->build('login', $this->_data, FALSE);
    }

    public function process(){

        $this->load->library('form_validation');
        $this->load->library('encrypt');

        $this->form_validation->set_rules('txtEmail', 'Email', 'required');
        $this->form_validation->set_rules('txtPassword', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $msg = 'Required enter email and password.';
            $this->index($msg);
        }else{
            $email = $this->input->post('txtEmail');
            $password = md5($this->input->post('txtPassword'));
            // Validate the user can login
            $result = $this->login_m->validate(trim($email), trim($password));
            // Now we verify the result
            if(! $result){
                // If user did not validate, then show them login page again
                $msg = 'Invalid email and/or password.';
                $this->index($msg);
            }else{
                // If user did validate,
                // Send them to members area
                $role = $this->session->userdata("RoleId");
                switch($role){
                    case "1":
                        redirect('activity');
                        break;
                    case "2":
                        redirect('user');
                        break;
                    case "3":
                        redirect('area');
                        break;
                    case "5":
                        redirect('startgame');
                        break;
                    case "6":
                        redirect('setting/murder');
                        break;
                }
            }
        }
    }

    public function logout(){
        $data = array(
            'Id' => "",
            'Name' => "",
            'Email' => "",
            'Phone' => "",
            'RoleId' => "",
            'GroupId' => "",
            'Password' => "",
        );
        $this->session->set_userdata($data);
        $this->index();
    }
}