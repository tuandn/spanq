<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . "libraries/MX/Controller.php";

class MY_Controller extends MX_Controller
{
    /**
     * No longer used globally
     *
     * @deprecated remove in 2.2
     */
    protected $data;

    /**
     * The name of the module that this controller instance actually belongs to.
     *
     * @var string
     */
    public $module;

    /**
     * The name of the controller class for the current class instance.
     *
     * @var string
     */
    public $controller;

    /**
     * The name of the method for the current request.
     *
     * @var string
     */
    public $method;

    /**
     * Load and set data for some common used libraries.
     */
    public function __construct()
    {
        parent::__construct();

        // Add the site specific theme folder
        $this->template->add_theme_location(APPPATH . 'themes/');

        // Work out module, controller and method and make them accessable throught the CI instance
        ci()->module = $this->module = $this->router->fetch_module();
        ci()->controller = $this->controller = $this->router->fetch_class();
        ci()->method = $this->method = $this->router->fetch_method();

        if ($this->module) {
            Asset::add_path('module', APPPATH . 'modules/' . $this->module . '/');
        }

    }
}

/**
 * Returns the CodeIgniter object.
 *
 * Example: ci()->db->get('table');
 *
 * @return \CI_Controller
 */
function ci()
{
    return get_instance();
}
