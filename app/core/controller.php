<?php
/**
 * Created by PhpStorm.
 * User: aghozlu-pc
 * Date: 1/4/2020
 * Time: 5:32 PM
 */

class Controller
{

    public $db = null;

    public function __construct()
    {
        $this->database();
    }

    public function database()
    {
        try {

            $options = array(
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

           $this->db = new PDO(
                DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
                DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function model($model)
    {
        require_once "app/model/" . strtolower($model) . ".php";

        return new $model($this->db);
    }

    public function view($view, $data = [])
    {

        if (!file_exists(require_once "app/view/" . $view . ".php")) {
            require_once "app/view/" . $view . ".php";
        } else {
            echo "view $view No Exists.";
        }
    }

}
