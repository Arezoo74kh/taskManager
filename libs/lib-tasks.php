<?php defined('BASE_PATH') or die("Permision Denied!!!");

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

    function addFolder($folderName){
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
        $sql = "select * from folders where user_id = $currentUserId";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $records;
    }

/*** Tasks Function ***/

    function deleteTask($task_id){
        global $pdo;
        $sql = "delete from tasks where id = $task_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function addTask($taskTitle,$folderId){
        global $pdo;
        $currentUserId = getCurrentUserId();
        $sql = "INSERT INTO `tasks` (title,user_id,folder_id) VALUES (:taskTitle,:userId,:folderId);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':taskTitle'=>$taskTitle,':userId'=>$currentUserId, ':folderId'=>$folderId]);
        return $stmt->rowCount();
    }

    function getTasks(){
        global $pdo;
        $folder = $_GET['folder_id'] ?? null;
        $folderCondition = '';
        if(isset($folder) and is_numeric($folder)){
            $folderCondition = "and folder_id=$folder";
        }
        $currentUserId = getCurrentUserId();
        $sql = "select * from tasks where user_id = $currentUserId $folderCondition  ORDER BY tasks.created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $records;
    }
?>