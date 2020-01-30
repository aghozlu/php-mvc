<?php
/**
 * Created by PhpStorm.
 * User: aghozlu-pc
 * Date: 1/4/2020
 * Time: 5:19 PM
 */

class Router
{
    private $url_controller = null;
    private $url_action = null;
    private $url_params = array();

    public function __construct()
    {
        $this->splitUrl();

        if (!$this->url_controller) {

            require 'app/controller/home.php';
            $page = new Home();
            $page->index();
        } elseif (file_exists('app/controller/' . $this->url_controller . '.php')) {
            require 'app/controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            if (method_exists($this->url_controller, $this->url_action)) {

                if (!empty($this->url_params)) {
                    call_user_func_array(array($this->url_controller,
                        $this->url_action), $this->url_params);
                } else {
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                if (strlen($this->url_action) == 0) {
                    $this->url_controller->index();
                } else {
                    $this->p404();
                }
            }
        } else {
            $this->p404();
        }
    }

    public function splitUrl()
    {

        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');

            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);
            $this->url_params = array_values($url);
        }
    }

    public function p404()
    {
        require 'app/controller/notfound.php';
        $p404 = new Notfound();
        $p404->index();
    }

}
