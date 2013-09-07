<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/14/13
 * Time: 7:06 PM
 * To change this template use File | Settings | File Templates.
 */

class AddArea extends Admin_Controller{
    private $_data = array();

    public function __construct(){
        parent::__construct();
        $this->load->model(array('area_m'));
    }

    public function index(){
        $this->_data['listArea'] = $this->area_m->LoadOption(true);
        $this->template
            ->set_metadata('description', 'New Area')
            ->set_metadata('keywords', 'New Area')
            ->title('New Area')
            ->build('addarea', $this->_data, FALSE);
    }
    public function insert(){
            $data = array(
                'Name' => $this->input->post('txtName'),
                'ParentId' => $this->input->post('cbArea')
            );
            if(!$this->area_m->insert($data)){
                echo 'false';
            }else {
                redirect('area');
            }
    }
}