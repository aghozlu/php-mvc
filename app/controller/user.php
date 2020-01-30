<?php
/**
 * Created by PhpStorm.
 * User: aghozlu-pc
 * Date: 1/7/2020
 * Time: 6:24 PM
 */

class User extends Controller
{

    public function index()
    {

        //echo date("Ymd").time();
        $this->view("user/index");
    }


    public function signin()
    {

        if (isset($_POST['email'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {

                $password = md5($_POST['password'] . PASSMD5);
                $model = $this->model("Userdb");
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

                    $modellogin = $model->signin($_POST['email'], $password, "Email");

                } else {
                    $modellogin = $model->signin($_POST['email'], $password, "Username");
                }

                if ($modellogin) {
                    echo ";sucsess";
                } else {
                    echo ";error";
                }
            }

        }else{
            echo "404";
        }


    }

    public function signup()
    {
        if (isset($_POST['email'])) {

            if (!empty($_POST['email']) && !empty($_POST['password'])) {

                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

                    $email = $_POST['email'];
                    $password = md5($_POST['password'] . PASSMD5);
                    $token = md5(date("Ymd") . time() . $email);
                    $model = $this->model("Userdb");
                    $modeluser = $model->checkemail($email);
                    if (!$modeluser) {
                        $model->singup($email, $password, $token);
                        echo "success fully";
                    } else {
                        echo "Email already registered";
                    }
                }else{
                    echo "email invalid ";
                }

            } else {
                echo "email and passwird is empty";

            }


        }
    }
}
