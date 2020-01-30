<?php
/**
 * Created by PhpStorm.
 * User: aghozlu-pc
 * Date: 1/4/2020
 * Time: 5:15 PM
 */

require_once "config.php";

spl_autoload_register(function ($class_name) {
    require_once "core/" . $class_name . '.php';
});

new Router();
