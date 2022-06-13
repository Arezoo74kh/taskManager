<?php

include "bootstrap/init.php";

if(!isLogedIn()){
//redirect to auth form
header("Location: " . siteUrl('auth.php'));
}



if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])) {
    $deletedCount = deleteFolder($_GET['delete_folder']);
    // echo "$deletedCount folders succesfully deleted!";
}

if (isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])) {
    $deletedCount = deleteTask($_GET['delete_task']);
    // echo "$deletedCount folders succesfully deleted!";
}

#connect to db and get tasks

$folders = getFolders();

$tasks = getTasks();
// dd($tasks);
include "tpl/tpl-index.php";

?>