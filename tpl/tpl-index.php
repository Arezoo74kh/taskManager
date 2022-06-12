<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?= SITE_TITLE ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">My Task manager</div>
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">Arezoo</span><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/73.jpg" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Folders</div>
        <ul class="folderList">
        <li class=" <?= isset($_GET['folder_id']) ? '' : 'active' ?>">
          <a href="<?=siteUrl()?>"> <i class="fa  <?= isset($_GET['folder_id']) ? 'fa-folder' : 'fa-folder-open' ?>"></i>All</a>
        </li>
        <?php foreach ($folders as $folder):?>
            <li class=" <?= ($_GET['folder_id'] == $folder->id) ? 'active' : ''?> "> 
             <a href="<?=siteUrl("?folder_id= $folder->id")?>"> <i class="fa <?= ($_GET['folder_id'] == $folder->id) ? 'fa-folder-open' : 'fa-folder'?>"></i><?= $folder->name ?> </a> 
             <a class="remove" href= "?delete_folder=<?= $folder->id ?>"><i class="fa fa-trash-alt" id="trashHover" onclick="return confirm('Are you sure to delete this item?\n<?= $folder->name ?>');"></i></a>
            </li>
          <?php endforeach;?>
        </ul>
      </div>
      <div>
          <input type="text" id="addFolderInput" placeholder="Add New Folder"/>
          <button id="addFolderBtn">+</button>
        </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title">
          <input type="text" id="addTaskInput" style="width:100%;margin-left:3%;line-height:30px;border-radius: 3px;" placeholder="Add New Task">
        </div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Tasks</div>
          <ul>
          <?php if(sizeof($tasks)):?>
          <?php foreach ($tasks as $task):?>
            <li class="<?= $task->is_done ? 'checked' : '' ; ?>">
            <i data-taskId = "<?= $task->id?>" class="isDone fa <?= $task->is_done ? 'fa-check-square' : 'fa-square' ; ?> "></i>
            <i class="fa <?= $task->is_done ? 'fas fa-smile-wink' : 'fa-clock' ; ?> "></i>
            <span><?=$task->title?></span>
              <div class="info">
                <span class="createdAt">Created At <?=$task->created_at?></span>
                <a class="remove" href= "?delete_task=<?= $task->id ?>"><i class="fa fa-trash-alt" id="trashHover" onclick="return confirm('Are you sure to delete this item?\n<?= $task->title ?>');"></i></a>
              </div>
            </li>
          <?php endforeach;?>
          <?php else: ?>
            <li>No Task Here...</li>
          <?php endif;?>
           
          </ul>
        </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="assets/js/script.js"></script>
  <script>
      $(document).ready(function(){

        $('.isDone').click(function(e){
            var tId = $(this).attr('data-taskId');
            $.ajax({
              url : "process/ajaxHandler.php",
              method : "post",
              data : {action: "doneSwitch",taskId: tId},
              success : function(response){
                  location.reload();
              }
            })
          });



          $('#addFolderBtn').click(function(e){
            var input = $('input#addFolderInput');
            $.ajax({
              url : "process/ajaxHandler.php",
              method : "post",
              data : {action: "addFolder",folderName: input.val()},
              success : function(response){
                // alert('Data from the server = ' + response);
                if(response == '1'){
                  $('<li> <a href="#"><i class="fa fa-folder"></i>'+input.val()+' </a> </li>').appendTo('ul.folderList');
                  // location.reload();
                }else{
                  alert(response);
                }
              }
            })
          });

          $('#addTaskInput').keydown(function (e) {
         if (e.keyCode == 13) {
         $.ajax({
              url : "process/ajaxHandler.php",
              method : "post",
              data : {action: "addTask",taskTitle:  $('#addTaskInput').val(),folderId:  <?= $_GET['folder_id'] ?? 0 ?>},
              success : function(response){
                // alert('Data from the server = ' + response);
                if(response == '1'){
                   location.reload();
                }else{
                  alert(response);
                }
              }
            })
    }
})
          $('#addTaskInput').focus()

      });

 

  </script>

</body>
</html>
