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
        
        echo addFolder($_POST['folderName']);
    break;

    case "addTask":
        $taskTitle = $_POST['taskTitle'];
        $folderId = $_POST['folderId'] ;
        if(($folderId) == 0){
            echo "First, select a folder";
            die();
        }
        if(!isset($taskTitle) || strlen($taskTitle) < 3){
            echo "The Task Title must be longer than 3 characters";
            die();
        }
        echo addTask($taskTitle, $folderId);

    break;

    default:
        diePage("Invalid Action");
}