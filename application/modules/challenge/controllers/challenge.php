<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/11/13
 * Time: 11:16 AM
 * To change this template use File | Settings | File Templates.
 */

date_default_timezone_set("UTC");

class Challenge extends Admin_Controller
{
    private $_data = array();
    private $_page_size = 4;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('challenge_m'));
        $this->load->model('station/station_m', 'station_m');
        $this->load->model('response/response_m', 'response_m');
    }

    public function index()
    {
        redirect("challenge/view");
    }

    public function add_response(){
        $challenge_id = $_POST["challenge_id"];
        $answer = $_POST["answer"];
        $status = $_POST["status"];

       $data = array(
        "Answer" => $answer,
        "Status" => $status,
        "ChallengeId" => $challenge_id,
        "CreatedDate" => date("Y-m-d H:i:s", time())
       );

        echo $this->response_m->insert($data);
    }

    public function addchallenge()
    {
        $this->template
            ->set_metadata('description', 'challenge')
            ->set_metadata('keywords', 'challenge')
            ->title('challenge')
            ->build('addchallenge', $this->_data, FALSE);
    }

    public function view()
    {
        $this->_data['listChallenge'] = $this->challenge_m->get_all();

        $this->template
            ->set_metadata('description', 'challenge')
            ->set_metadata('keywords', 'challenge')
            ->title('challenge')
            ->build('challenge', $this->_data, FALSE);
    }

    public function insert()
    {

        $data = array(
            'Description' => $this->input->post('txtDesc'),
            'pincode' => $this->input->post('txtPinCode'),
            'Notes' => $this->input->post('txtNote'),
            'Type' => $this->input->post('cboType'),
            'Difficulty' => $this->input->post('cboDiff'),
            'Hint1' => $this->input->post('txtHint1'),
            'Hint2' => $this->input->post('txtHint2')
        );
        if (!$this->challenge_m->insert($data)) {
            echo 'false';
        } else {
            redirect('challenge');
        }

    }

    public function get_station_paging()
    {
        $index = $_POST['index'];
        $data = $this->challenge_m->get_station_paging($this->_page_size, $index);
        $str = "";
        $str .= "<table cellspacing=\"0\" cellpadding=\"0\" class=\"sub\">";
        $str .= "<tr>";
        $str .= "    <th>Name</th>";
        $str .= "    <th>Add</th> ";
        $str .= "</tr>";
        foreach ($data as $item) {
            $str .= "<tr>";
            $str .= "    <td>" . $item->Name . "</td>";
            $str .= "    <td>";
            $str .= "        <input type=\"button\" value=\"add\" ";
            $str .= "               station_id=" . $item->Id;
            $str .= "               name=\"btnAdd\"  ";
            $str .= "               class=\"bt add_button\"/> ";
            $str .= "    </td>";
            $str .= "</tr>";
        }
        $str .= "</table>";
        echo $str;
    }

    public function edit()
    {
        $id = $_REQUEST["Id"];
        $challenge = $this->challenge_m->get_by($id);
        $this->_data["challenge"] = $challenge;
        $this->_data['listStation'] = $this->challenge_m->get_c_s_temp_by_challengeId($id);
        //$this->_data['allStation'] = $this->challenge_m->get_station_paging($this->_page_size, 1);
        $this->_data['allStation'] = $this->station_m->get_all();
        //$this->_data['total_page'] = $this->challenge_m->station_total_page($this->_page_size);
        $this->_data['listResponse'] = $this->response_m->get_by_challenge($challenge->Id);

        $this->template
            ->set_metadata('description', 'challenge')
            ->set_metadata('keywords', 'challenge')
            ->title('challenge')
            ->build('challenge/editchallenge', $this->_data, FALSE);
    }

    public function addcstemp()
    {
        $challengeId = $_POST['challengeId'];
        $stationId = $_POST['stationId'];

        $data = array(
            "ChallengeId" => $challengeId,
            "StationId" => $stationId,
        );

        return $this->challenge_m->addcstemp($data);
    }

    public function removecstemp()
    {
        $challengeId = $_POST['challengeId'];
        $stationId = $_POST['stationId'];

        $data = array(
            "ChallengeId" => $challengeId,
            "StationId" => $stationId,
        );

        return $this->challenge_m->removecstemp($data);
    }

    public function delete_response()
    {
        $id = $_POST['Id'];

        $data = array(
            "Id" => $id
        );

        echo $this->response_m->delete_by($data);
    }

    public function update()
    {

        $this->load->library('form_validation');
        $id = $this->input->post('txtId');
        $currentPage = $this->input->post('currentPage');
        $this->form_validation->set_rules('txtDesc', 'Description', 'required');
        $this->form_validation->set_rules('txtNote', 'Notes', 'required');
        $this->form_validation->set_rules('txtHint1', 'Hint 1', 'required');
        $this->form_validation->set_rules('txtHint2', 'Hint 2', 'required');
        if ($this->form_validation->run() == FALSE) {
            redirect("challenge/edit?Id=" . $id . "&currentPage=" . $currentPage);
        } else {

            $data = array(
                'Description' => $this->input->post('txtDesc'),
                'pincode' => rand(0000, 9999),
                'Notes' => $this->input->post('txtNote'),
                'Type' => $this->input->post('cboType'),
                'Difficulty' => $this->input->post('cboDiff'),
                'Hint1' => $this->input->post('txtHint1'),
                'Hint2' => $this->input->post('txtHint2')
            );
            if (!$this->challenge_m->update_by($id, $data)) {
                echo 'false';
            } else {
                if ($currentPage == 1) {
                    redirect('challenge/view');
                } else {
                    redirect('challenge/view/' . $currentPage);
                }
            }

        }
    }

    public function delete_by()
    {
        $Id = $_POST['Id'];

        $data = array(
            "Id" => $Id
        );
        return $this->challenge_m->delete_by($data);
    }
}