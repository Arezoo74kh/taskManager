<?php

include_once "../bootstrap/init.php";

if(!isAjaxRequest()){
    diePage("Invalid Request!");
}

if(!isset($_POST['action']) || empty($_POST['action'])){
    diePage("Invalid action!");
}

switch($_POST['action']){
    case "addFolder":
        if(!isset($_POST['folderName']) || strlen($_POST['folderName'])<3){
            echo "Please enter more than 2 characters...";
            die();
        }
        echo addFolder($_POST['folderName']);
    break;
    case "addTask":

        // $folderId = $_POST['folderId'];
        // $taskTitle = $_POST['taskTitle'];
        if(!isset($_POST['folderId']) || empty($_POST['folderId'])){
            echo "Please choose 1 folder...";
            die();
        }
        if(!isset($_POST['taskTitle']) || strlen($_POST['taskTitle'])<3){
            echo "Please enter more than 2 characters...";
            die();
        }
        echo addTask($taskTitle,$folderId); 
    break;
    
    default:
       diePage("Invalid Action!");
}

