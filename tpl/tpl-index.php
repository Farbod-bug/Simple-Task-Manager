<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?= SITE_TITLE ?></title>
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel">
      <a style="color: black;" href="<?= site_url("?logout=1") ?>"><i class="fa-solid fa-right-from-bracket"></i></a>
    <span class="username"><?= getLoggedInUser()->name ?? 'User' ?></span><img src="https://cdn.discordapp.com/attachments/788676053261746186/1155239442873860137/images.jpg" width="40" height="40"/></div>
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
        <ul class="folder_list">
        <li class="<?= isset($_GET['folder_id']) ? '' : 'active' ?>"> <a href="<?= site_url() ?>"><i class="fa fa-folder"></i>All</li></a>
          <?php foreach($folders as $folder):?>
            <li class="<?= isset($_GET['folder_id']) && $_GET['folder_id'] == $folder->id ? 'active' : '' ?>">
              <a href="?folder_id=<?= $folder->id ?>"><i class="fa fa-folder"></i><?= $folder->name ?></a>
              <a href="?delete_folder=<?= $folder->id ?>" onclick="return confirm('Are You Sure to delete this folder?')"><i id="trash" class="fa fa-trash-can"></i></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div>
          <input type="text" id="addFolderInput" style='width: 65%; margin-left: 3%' placeholder="Add New Folder"/>
          <button id="addFolderBtn" class="btn">+</button>
        </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title">
          <input type="text" id="taskNameInput" style="width: 100%;margin-left: 3%;line-height: 30px;" placeholder="Add New Task">
        </div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
          <?php if(sizeof($tasks)):?>
          <?php foreach($tasks as $task):?>
            <li class="<?= $task->is_done ? 'checked' : '' ; ?>">
            <i data-taskId="<?= $task->id?>" class="isDone clickable <?= $task->is_done ? 'fa-regular fa-square-check' : 'fa-regular fa-square' ; ?>"></i>
            <span><?= $task->title ?></span>
              <div class="info">
                <span class="created-at">Created At: <?= $task->created_at ?></span>
                <a href="?delete_task=<?= $task->id ?> " onclick="return confirm('Are You Sure to delete this task?')" ><i id="trash" class="fa fa-trash-can" ></i></a>
              </div>
            </li>
            <?php endforeach; ?>
            <?php else: ?>
              <li>No Taks here ...</li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>
  <script src="assets/js/script.js"></script>

  <script>
    $(document).ready(function(){
      $('#addFolderBtn').click(function(e){
        var folderInput = $('input#addFolderInput');
        $.ajax({
          url : "process/ajaxHandler.php",
          method : "post",
          data : {action: "addFolder", folderName: folderInput.val()},
          success : function(response){
            if(response == "1"){
              $('<li> <a href="?folder_id=#"><i class="fa fa-folder"></i>'+folderInput.val()+'</a> <a href="#"><i id="trash" class="fa fa-trash-can"></i></a> </li>').appendTo('ul.folder_list');
            }
            else{
              alert(response);
            }
          }
        });
      });
    });
      $('#taskNameInput').focus();
  </script>
  <script>
    $('#taskNameInput').on('keypress',function(e) {
        if(e.which == 13) {
          $.ajax({
            url : "process/ajaxHandler.php",
            method : "post",
            data : {action: "addTask",folderId: <?= $_GET['folder_id'] ?? '0' ?> ,taskTitle: $('input#taskNameInput').val()},
            success : function(response){
                if(response == '1'){
                  location.reload();
                }
                else{
                  alert(response);
                }
            }
          });
        }
      });
  </script>
  <script>
    $('.isDone').click(function(e){
      var tid = $(this).attr('data-taskId');
          $.ajax({
            url : "process/ajaxHandler.php",
            method : "post",
            data : {action: "doneSwitch",taskId: tid},
            success : function(response){
                location.reload();
            }
          })
    });
  </script>

</body>
</html>
