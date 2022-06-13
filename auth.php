<?php

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
            massage("Registration is successfull! <br>
            <a href='$homeUrl'>Manage your tasks...</a>
            ");
        }
    }elseif($action == 'login'){
        $result = login($params['email'],$params['password']);
        massage('Error: email or password is invalid!');
    }
}

include "tpl/tpl-auth.php";

?>