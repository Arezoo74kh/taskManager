<?php defined('BASE_PATH') or die("Permision Denied!!!");

    /*** Auth Functions ***/


    function isLogedIn(){
        return isset($_SESSION['login']) ? true : false;
    }
    function getLoggedInUser(){
        return $_SESSION['login'] ?? null;
    }   

    function getUserByEmail($email){
        global $pdo;
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email'=>$email]);
        $record = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $record[0] ?? null;
    }

    function logout(){
        unset($_SESSION['login']);
    }

    function login($email,$password){
        $user = getUserByEmail($email);
        if(is_null($user)){
            return false;
        }

        #check the password
        if(password_verify($password,$user->password)){
            #login is successfull!
            $user->image = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->$email ) ) );
            $_SESSION['login'] = $user;

            return true;
        }
        return false;
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
