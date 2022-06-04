<?php
    function getCurrentUrl(){
        return 1;
    }

    function isAjaxRequest(){
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            return true;
        }
        return false;
    }


    function diePage($msg){
        echo "<div style='padding:30px;width:80%;margin:50px auto;background: #f9dede;border:1mpx solid #cca4a4;color:red;border-radius:5px'>$msg</div>";
        die();
    }

