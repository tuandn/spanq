<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 01/07/2013
 * Time: 23:46
 * To change this template use File | Settings | File Templates.
 */

class Activity extends Admin_Controller{

    private $_data = array();
    public function __construct(){
        parent::__construct();
        $this->load->model(array('activity_m'));
    }

    public function index()
    {
        $this->_data['latest_challenge'] = $this->activity_m->get_latest_challenge();
        $this->_data['latest_game'] = $this->activity_m->get_latest_games();
        $this->template
            ->set_metadata('description', 'Activity')
            ->set_metadata('keywords', 'Activity')
            ->title('Activity')
            ->build('activity', $this->_data, FALSE);
    }

}