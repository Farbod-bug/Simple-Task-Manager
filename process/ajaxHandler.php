<?php
include_once "../bootstrap/init.php";

if(isAjaxRequest()){
    diePage("Invalid Request");
}

if(!isset($_POST['action']) || empty($_POST['action'])){
    diePage("Invalid Action");
}

switch($_POST['action']){
    case "addFolder":
        if(!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3){
            echo "The folder name must be longer than 3 characters";
            die();
        }

        addFolders($_POST['folderName']);
    break;

    default:
        diePage("Invalid Action");
}