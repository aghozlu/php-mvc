<?php
/**
 * Created by PhpStorm.
 * User: aghozlu-pc
 * Date: 1/4/2020
 * Time: 5:33 PM
 */

class Home extends Controller
{
    private function viewmodel($model, $params)
    {
        $mod = $this->model($model);
        $m = $mod->$params();
        return $m;
    }

    public function index()
    {
		$json = $this->viewmodel('userdb','selectall');
		
		$data = [
			"json" => $json
		];
		
        $this->view("_temp/header");
        $this->view("home/index", $data);
        $this->view("_temp/footer");
    }
}
