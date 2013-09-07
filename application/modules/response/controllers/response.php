<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 26/06/2013
 * Time: 23:18
 * To change this template use File | Settings | File Templates.
 */
date_default_timezone_set("UTC");
class Response extends Admin_Controller
{

    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('response_m'));
        $this->load->model('challenge/challenge_m', 'challenge_m');
    }

    public function index()
    {
        redirect("response/view");
    }

    public function view()
    {
        $this->_data['listResponse'] = $this->response_m->get_all();

        $this->template
            ->set_metadata('description', 'response')
            ->set_metadata('keywords', 'response')
            ->title('response')
            ->build('response', $this->_data, FALSE);
    }

    public function insert()
    {
        $data = array(
            'Answer' => $this->input->post('txtAnswer'),
            'Status' => $this->input->post('cboStatus'),
            'ChallengeId' => $this->input->post('cbChallenge'),
            'CreatedDate' => date("Y-m-d H:i:s", time()),
        );
        if (!$this->response_m->insert($data)) {
            redirect('response/addresponse');
        } else {
            redirect('response');
        }
    }

    public function addresponse()
    {
        $this->_data['cboChallenge'] = $this->challenge_m->get_challenge_cbo();
        $this->_data['cboStatus'] = $this->response_m->get_status_option();

        $this->template
            ->set_metadata('description', 'response')
            ->set_metadata('keywords', 'response')
            ->title('response')
            ->build('addresponse', $this->_data, FALSE);
    }

    public function edit()
    {

        $id = $_REQUEST["Id"];
        $response = $this->response_m->get_by($id);
        $this->_data["response"] = $response;
        $this->_data['cboChallenge'] = $this->challenge_m->get_challenge_cbo($response->ChallengeId);
        $this->_data['cboStatus'] = $this->response_m->get_status_option($response->Status);
        $this->template
            ->set_metadata('description', 'response')
            ->set_metadata('keywords', 'response')
            ->title('response')
            ->build('response/editresponse', $this->_data, FALSE);

    }

    public function update()
    {
        $id = $this->input->post('txtId');
        $currentPage = $this->input->post('currentPage');
        $data = array(
            'Answer' => $this->input->post('txtAnswer'),
            'Status' => $this->input->post('cboStatus'),
            'ChallengeId' => $this->input->post('cbChallenge'),
            'CreatedDate' => date("Y-m-d H:i:s", time()),

        );
        if (!$this->response_m->update_by($id, $data)) {
            echo 'false';
        } else {
            if ($currentPage == 1) {
                redirect('response/view');
            } else {
                redirect('response/view/' . $currentPage);
            }
        }
    }

    public function delete_by()
    {
        $Id = $_POST['Id'];

        $data = array(
            "Id" => $Id
        );
        return $this->response_m->delete_by($data);
    }

}