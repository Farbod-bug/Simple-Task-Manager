<?php defined('BASE_PATH') OR die("Permision Denied");

function isLoggedIn(){
    return isset($_SESSION['login']) ? true : false;
}

function getLoggedInUser(){
    return $_SESSION['login'] ?? null;
}

function getCurrentUserId(){
    return getLoggedInUser()->id ?? 0;
}

function logout(){
    unset($_SESSION['login']);
}

function login($email, $password){
    $user = getUserByEmail(validate($email));
    if(is_null($user)){
        return false;
    }
    if(password_verify($password, $user->password)){
        $_SESSION['login'] = $user;
        return true;
    }
    return false;
    
}

function register($userData){
    global $pdo;
    $email = validate($userData['email']);
    $password = $userData['password'];
    $name = $userData['name'];

    if(passwordValidate($password) && emailValidate($email) && nameValidate($name)){
        $passHash = password_hash($password,PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name'=>$name, ':email'=>$email, 'pass'=>$passHash]);
        return $stmt->rowCount() ? true : false ;
    }
}

function getUserByEmail($email){
    global $pdo;
    $sql = "SELECT * FROM users WHERE email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email'=>$email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? null;
}

function emailValidate($email){
    if(!empty($email)){
        global $pdo;
        $email = validate($email);
        $sql = "SELECT * FROM users WHERE email=:email ;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email'=>$email]);
        $result = $stmt->rowCount();
        if(!$result){
            return true;
        }
        else{
            dd("This email has already been used");
            return false;
        }
        }
    else{
        dd("Please set the Email");
        return false;
    }   
}

function passwordValidate($password){
    if(!empty($password)){
        if(strlen($password) <= 8){
            dd("Your Password Must Contain At Least 8 Characters!");
        }
        elseif(!preg_match("#[0-9]+#",$password)){
            dd("Your Password Must Contain At Least 1 Number!");
        }
        elseif(!preg_match("#[A-Z]+#",$password)){
            dd("Your Password Must Contain At Least 1 Capital Letter!");
        }
        elseif(!preg_match("#[a-z]+#",$password)){
            dd("Your Password Must Contain At Least 1 Lowercase Letter!");
        }
        else{
            return true;
        }
    }
    else{
        dd("Please set the Password");
    }
}

function nameValidate($name){
    if(!preg_match("/^[a-zA-Z'-]+$/", $name)){
        dd("Name is not valid<br>It must not contain numbers or special characters");
        return false;
    }
    else{
        return true;
    }
}