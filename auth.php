<?php
include "bootstrap/init.php";


$home_url = site_url();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $action = $_GET['action'];
    $params = $_POST;
    if($action == 'register'){
        $result = register($params);
        if($result){
            dd("Registration is Successfull <br> Welcome to <b>Silent Todo</b> <br>
            <a href='{$home_url}auth.php'>Please Login");
        }

    }
    elseif($action == 'login'){
        $result = login($params['email'], $params['password']);
        if(!$result){
            dd("Email or Password is Incorrect");
        }
        else{
            redirect(site_url());
        }
    }
}




include "tpl/tpl-auth.php";