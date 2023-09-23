<?php defined('BASE_PATH') OR die("Permision Denied");


function deleteFolder($folder_id){
    global $pdo;
    $sql = "DELETE FROM folders WHERE id=$folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function deleteTask($task_id){
    global $pdo;
    $sql = "DELETE FROM tasks WHERE id=$task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function addFolder($folder_name){
    global $pdo;
    $currentUserId = getCurrentUserId();
    $folderName = validate($_POST['folderName']);
    $sql = "INSERT INTO folders (user_id, name) VALUES (?,?);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$currentUserId, $folderName]);
    return $stmt->rowCount();
}

function addTask($taskTitle, $folderId){
    global $pdo;
    $currentUserId = getCurrentUserId();
    $taskTitle = validate($taskTitle);
    $sql = "INSERT INTO tasks (title, user_id, folder_id) VALUES (?,?,?);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$taskTitle,$currentUserId, $folderId]);
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
    global $pdo;
    $folder = $_GET['folder_id'] ?? null;
    $folderCondition = '';
    if(isset($folder) and is_numeric($folder)){
        $folderCondition = "and folder_id=$folder";
    }

    $currentUserId = getCurrentUserId();
    $sql = "SELECT * FROM tasks WHERE user_id=$currentUserId $folderCondition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}