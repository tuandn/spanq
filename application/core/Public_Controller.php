<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Public_Controller extends MY_Controller
{
    /**
     * Loads the gazillion of stuff, in Flash Gordon speed.
     * @todo Document properly please.
     */
    protected $theme = 'bootstrap';

    public function __construct()
    {
        parent::__construct();

        // Set the theme as a path for Asset library
        Asset::add_path('theme', APPPATH . 'themes/' . $this->theme . '/');
        Asset::set_path('theme');

        // Set the theme views folder
        $this->template
            ->set_theme($this->theme)
            ->append_metadata('
				<script type="text/javascript">
					var BASE_URL = "' . BASE_URL . '";
					var APPPATH_URI = "' . APPPATH_URI . '";
					var BASE_URI = "' . BASE_URI . '";
				</script>');
    }

    protected function layout_login()
    {
        // Is there a layout file for this module?
        if ($this->template->layout_exists($this->module . '.html')) {
            $this->template->set_layout($this->module . '.html');
        } // Nope, just use the default layout
        elseif ($this->template->layout_exists('login.html')) {
            $this->template->set_layout('login.html');
        }

        // Make sure whatever page the user loads it by, its telling search robots the correct formatted URL
        $this->template->set_metadata('spanq', site_url($this->uri->uri_string()), 'link');
        Asset::css('login.css');
    }


    protected function layout_user()
    {
        // Is there a layout file for this module?
        if ($this->template->layout_exists($this->module . '.html')) {
            $this->template->set_layout($this->module . '.html');
        } // Nope, just use the default layout
        elseif ($this->template->layout_exists('home.html')) {
            $this->template->set_layout('home.html');
        }

        $this->template
            ->set_partial('metadata', 'partials/metadata.html')
            ->set_partial('banner', 'partials/banner.html')
            ->set_partial('menu', 'partials/menu.html')
            //->set_partial('top_friend', 'partials/top_friend.html')
            ->set_partial('main_right', 'partials/main_right.html')
            //->set_partial('main_right_bottom', 'partials/main_right_bottom.html')
            ->set_partial('footer', 'partials/footer.html');
        // Make sure whatever page the user loads it by, its telling search robots the correct formatted URL
        $this->template->set_metadata('canonical', site_url($this->uri->uri_string()), 'link');
        Asset::css('homeStyle.css');
    }
}
