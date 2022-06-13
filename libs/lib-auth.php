<?php defined('BASE_PATH') or die("Permision Denied!!!");

    /*** Auth Functions ***/


    function isLogedIn(){
        return false;
    }
  
    function login($user,$password){
        return 1;
    }
    function register($userData){
        global $pdo;
        #validation of $userdata here(isValidEmail,isValidUserName,isValidPassword)
        $passHash = password_hash($userData['password'],PASSWORD_BCRYPT);

        $sql = "INSERT INTO `users` (name,email,password) VALUES (:name,:email,:pass);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name'=>$userData['name'],':email'=>$userData['email'],':pass'=>$passHash]);
       
        return $stmt->rowCount() ? true : false;
    }
