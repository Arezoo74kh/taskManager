<?php defined('BASE_PATH') or die("Permision Denied!!!");
    function getCurrentUrl(){
        return 1;
    }

    function isAjaxRequest(){
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            return true;
        }
        return false;
    }
    function siteUrl($uri = ''){
       return BASE_URL . $uri;
    }

    function diePage($msg){
        echo "<div style='padding:30px;width:80%;margin:50px auto;background: #f9dede;border:1mpx solid #cca4a4;color:red;border-radius:5px'>$msg</div>";
        die();
    }

    function dd($var){
        echo "<pre style='color: #c46a10; position: relative; background: #ffff; z-index: 999; padding: 10px; margin: 10px; border-radius: 5px; border-left: 5px solid #c56705;'>";
        var_dump($var);
        echo "</pre>";
    }

