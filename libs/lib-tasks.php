<?php


function deleteFolder($folder_id){
    global $pdo;
    $sql = "DELETE FROM folders WHERE id=$folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function addFolders($data){
    global $pdo;
    $sql = "SELECT * FROM folders";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
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