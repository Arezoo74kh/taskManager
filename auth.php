<?php

// use Symfony\Component\Mime\Message;

include "bootstrap/init.php";

$homeUrl = siteUrl();
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $action = $_GET['action'];
    // dd($action);
    $params = $_POST;
    if($action == 'register' ){
        $result = register($params);
        if(!$result){
            massage('Error: an error in registration!');
        }else{
            // massage("Registration is successfull! .<br>
            // <a href='{$homeUrl}auth.php'>Please Longin...</a>
            // ",'success');
            redirect('auth.php');
        }
    }else if($action == 'login'){
        $result = login($params['email'],$params['password']);
       if(!$result){
        massage("Error: email or password is invalid!");
       }else{
        // massage("you are now Logged In! .<br>
        // <a href='$homeUrl'>Manage your tasks...</a>
        // ",'success');
         redirect(siteUrl());
       }
    }
}

include "tpl/tpl-auth.php";
?>