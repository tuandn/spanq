<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata("Email") == '') {
            redirect("login");
        }

        $theme = 'bootstrap';
        Asset::add_path('theme', APPPATH . 'themes/' . $theme . '/');
        Asset::set_path('theme');

        // Set the theme views folder
        $this->template
            ->set_theme($theme)
            ->append_metadata('
				<script type="text/javascript">
					var BASE_URL = "' . BASE_URL . '";
					var APPPATH_URI = "' . APPPATH_URI . '";
					var BASE_URI = "' . BASE_URI . '";
				</script>');

        // Is there a layout file for this module?
        if ($this->template->layout_exists($this->module . '.html')) {
            $this->template->set_layout($this->module . '.html');
        } // Nope, just use the default layout
        elseif ($this->template->layout_exists('default.html')) {
            $this->template->set_layout('default.html');
        }

        $this->template
            ->set_partial('metadata', 'partials/metadata.html');
        /*->set_partial('left', 'partials/left_user.html')
         ->set_partial('header', 'partials/header.html');*/
        // Make sure whatever page the user loads it by, its telling search robots the correct formatted URL
        $this->template->set_metadata('spanq', site_url($this->uri->uri_string()), 'link');
    }

    public function load_default(){
        // Is there a layout file for this module?
        if ($this->template->layout_exists($this->module . '.html')) {
            $this->template->set_layout($this->module . '.html');
        } // Nope, just use the default layout
        elseif ($this->template->layout_exists('default.html')) {
            $this->template->set_layout('default.html');
        }

        $this->template
            ->set_partial('metadata', 'partials/metadata.html')
            ->set_partial('left', 'partials/left_user.html')
            ->set_partial('header', 'partials/header.html');
        // Make sure whatever page the user loads it by, its telling search robots the correct formatted URL
        $this->template->set_metadata('spanq', site_url($this->uri->uri_string()), 'link');
        Asset::css('style.css');
    }

    public function load_test(){
        $theme = 'bootstrap';
        Asset::add_path('theme', APPPATH . 'themes/' . $theme . '/');
        Asset::set_path('theme');

        // Set the theme views folder
        $this->template
            ->set_theme($theme)
            ->append_metadata('
				<script type="text/javascript">
					var BASE_URL = "' . BASE_URL . '";
					var APPPATH_URI = "' . APPPATH_URI . '";
					var BASE_URI = "' . BASE_URI . '";
				</script>');

        // Is there a layout file for this module?
        if ($this->template->layout_exists($this->module . '.html')) {
            $this->template->set_layout($this->module . '.html');
        } // Nope, just use the default layout
        elseif ($this->template->layout_exists('default.html')) {
            $this->template->set_layout('default.html');
        }

        $this->template
            ->set_partial('metadata', 'partials/metadata.html');
           /*->set_partial('left', 'partials/left_user.html')
            ->set_partial('header', 'partials/header.html');*/
        // Make sure whatever page the user loads it by, its telling search robots the correct formatted URL
        $this->template->set_metadata('spanq', site_url($this->uri->uri_string()), 'link');

    }

    public function load_activity(){
        // Is there a layout file for this module?
        if ($this->template->layout_exists($this->module . '.html')) {
            $this->template->set_layout($this->module . '.html');
        } // Nope, just use the default layout
        elseif ($this->template->layout_exists('activity.html')) {
            $this->template->set_layout('activity.html');
        }

        $this->template
            ->set_partial('metadata', 'partials/metadata.html')
            ->set_partial('header', 'partials/header.html');
        // Make sure whatever page the user loads it by, its telling search robots the correct formatted URL
        $this->template->set_metadata('spanq', site_url($this->uri->uri_string()), 'link');
        Asset::css('style.css');
    }

}