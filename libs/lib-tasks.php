<?php


function deleteFolder($folder_id){
    global $pdo;
    $sql = "DELETE FROM folders WHERE id=$folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function addFolders($folder_name){
    global $pdo;
    $currentUserId = getCurrentUserId();
    $folderName = validate($_POST['folderName']);
    $sql = "INSERT INTO folders (user_id, name) VALUES ('$currentUserId','$folderName');";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function getFolders(){
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "SELECT * FROM folders WHERE user_id=$currentUserId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

function getTasks(){

}