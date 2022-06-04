<?php

/*** Folder Function ***/

function getCurrentUserId(){
    //get login user id;
    return 1;
}

    function deleteFolder($folder_id){
        global $pdo;
        $sql = "delete from folders where id = $folder_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function addFolders($folderName){
        global $pdo;
        $currentUserId = getCurrentUserId();
        $sql = "INSERT INTO `folders` (name,user_id) VALUES (:folderName,:userId);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':folderName'=>$folderName,':userId'=>$currentUserId]);
        return $stmt->rowCount();
    }

    function getFolders(){
        global $pdo;
        $currentUserId = getCurrentUserId();
        $sql = "select *from folders where user_id = $currentUserId";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $records;
    }

/*** Tasks Function ***/

    function removeTasks(){
        return 1;
    }

    function addTasks(){
        return 1;
    }

    function getTasks(){
        return 1;
    }
?>