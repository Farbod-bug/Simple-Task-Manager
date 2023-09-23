<?php defined('BASE_PATH') OR die("Permision Denied");

function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUEST_WITH']) && strtolower($_SERVER['HTTP_X_REQUEST_WITH']) == 'xmlhttprequest'){
        return true;
    }
}   return false;

function diePage($msg){
    echo "<div style='padding: 30px; width: 80%; margin: 50px auto; background-color: #f9dede; border: 1px solid #cca4a4; color: #521717; border-radius: 5px; font-family: sans-serif;'>$msg</div>";
    die();
}

function site_url($uri = ''){
    return BASE_URL . $uri;
}

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function dd($var){
    echo "<pre style='color: #a06b00; background: #eee; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border-left: 3px solid #d79209; }'>";
    var_dump($var);
    echo "</pre>";
}