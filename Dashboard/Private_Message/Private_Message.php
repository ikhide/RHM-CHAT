<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>RHM-CHAT</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/privMessage.css" rel="stylesheet">
 
</head>

<body>
  <div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <br>
      <div id="top-navigation-username">
        <span id="my_profile_picture"></span>
        <!-- Working with the dp -->
        <div id="dp_form_holder">
          <form method="post" action="" enctype="multipart/form-data">
            <input type="file" name="file" id="file"/>
            <input type="submit" name="submit_file" id="submit_file"/>
          </form>
        </div>
        <span style="color:white;margin-top:3px"><strong><?php echo ($_COOKIE["user_first_name"]); ?></strong></span>
      </div>
      <br>
      <ul class="sidebar-nav">
        <li><a style="border-left:4px solid rgba(69, 162, 255, 0.93); border-radius:10px" href="Private_Message.php"><img src="../img/send-file.png" class="navimg img-responsive" /><span class="nav-writting">Private Chat</span></a></li>
        <li><a href="../General_Message/General_Message.php"><img src="../img/chat-1.png" class="navimg img-responsive" /><span class="nav-writting">Public Chat</span></a></li>
        <li><a href="../General_Share/General_Share.php"><img src="../img/businessman.png" class="navimg img-responsive" /><span class="nav-writting">Public Share</span></a></li>
        <li><a href="../General_announcement/general_announcement.php"><img src="../img/log-file-format-1.png" class="navimg img-responsive" /><span class="nav-writting">General Announcements</span></a></li>
        <li onclick="Logout()"><a href="../../index.php"><img src="../img/logout.png" class="navimg img-responsive" /><span class="nav-writting">Logout</span></a></li>
      </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <a href="#menu-toggle" class="btn btn-secondary btn-sm" id="menu-toggle"><i class="fas fa-bars"></i></a>
    
      <div class="container" >
        <div class="row">
          <!-- part one of row -->
          <div id="Get_Online_Users" class="col-md-2"></div>
          <!-- part two -->
          <div id="Main_Chat_Box" class="col-md-6">
            <br>
            <div id="get_chatting_user_name"></div>
            <div id="get_name" style="font-weight:bold;font-size:1.5em;float:left;color:rgba(69, 162, 255, 0.93)"></div>
            <div style="float:right"><img src="../img/upload.png" id="btn_upload" style="cursor:hand;margin-right:15px; margin-top:-8px" height=35px width=35px title="Click here to upload file"></div>
            <br>
            <hr>
            <div id="get_chat_logs">
            </div>

            <div id="form_send_message" style="width:100%;background-color:white;height:40px;margin-top:10px;">
              <textarea name="txtmessage" id="text_area" placeholder="Type Something Here" style='width:90%; height:100%;'></textarea>
              <img src="../img/send.png" class='img-responsive' alt="Send Image" id="send_button" style='height:90%;margin-top:-30px;background-color:white;' />
              <input type="submit" name="send_message" value="" id="btn_Send"/>
            </div>

            <!-- upload -->
            <div style="margin-right:100px;" class="form-group" style="display:none;">
              <form method="post" action="" enctype="multipart/form-data" class="form">
                <input style="display:none;" placeholder="Add file" type="file" name="file" id="my_upload_file"/>
                <input style="display:none;" type="submit" name="upload_file" id="upload_file" class="btn btn-success btn-sm" hidden/>
              </form>
            </div>

          </div>

          <!-- part three -->
          <div id="Right_side_bar" class="col-md-4">
            <br>
            <div class="sent">
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "solid";

    $connection_String = mysqli_connect($host,$user,$pass,$database);

    // save profile pic
    if(isset($_POST["submit_file"])){
      $selected_username = $_COOKIE["user_first_name"];
      $users_last_name = $_COOKIE["users_last_name"];
      move_uploaded_file($_FILES["file"]["tmp_name"],"../Profile_Pictures/".$_FILES["file"]["name"]);
      $connection_String = mysqli_connect($host,$user,$pass,$database);
      $myfiles = $_FILES["file"]["name"];
      $update_profile_query = "UPDATE users_table SET Profile_Picture = '$myfiles' WHERE user_fname ='$selected_username' AND user_lname ='$users_last_name'";
      $execute_update_profile_query = mysqli_query($connection_String,$update_profile_query);
    };

    // upload files
    if(isset($_POST['upload_file'])){
      $selected_username = $_COOKIE["user_first_name"];

      $file = $_FILES['file']['name'];
      $file_loc = $_FILES['file']['tmp_name'];
      $file_size = $_FILES['file']['size'];
      $file_type = $_FILES['file']['type'];
      $folder="uploads/";

      // new file size in KB
      $new_size = $file_size/1024;
      $mb_size = $new_size/1024;

      if($mb_size > 3){
        echo "<script type='text/javascript'>alert('uploads should not exceed 3MB');</script>";
      } else {

      // make file name in lower case
      $final_file = preg_replace("#[^a-z0-9.]#i","",$file);
      $date = Date("Ymd_His");
      $final_file = $date."_".$_COOKIE["user_first_name"]."_".$final_file;
    
      $sender = $_COOKIE["user_first_name"];
      $receiver = $_COOKIE["default_clicked_on_username"];
      if(move_uploaded_file($file_loc,$folder.$final_file)){
        $insert_query = "INSERT INTO private_uploads (`ID`, `File`, `Type`, `Size`,`sender`,`receiver`) VALUES (NULL, '$final_file', '$file_type', '$new_size','$sender','$receiver')";
        $execute_insert_query = mysqli_query($connection_String,$insert_query);
      }
    }
  }
?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery.yacal.min.js"></script>
 <!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").mouseover(function(e) {
    e.preventDefault();
    
    $("#wrapper").toggleClass("toggled");
  });
</script>

<script>

  // onload functions
  $(document).ready(function(){
    loadChat();
    countChat();
    dropScroll();
    uploadHistory();

    $.ajax({
      cache:true,
      success:function(status){
        setInterval(function(){
          $("#Get_Online_Users").load("Online_Users.php"); // Add s to the #Get_Online_User to start ajax requests
        },3000);
      }
    });
  

  $("#send_button").hover(function() {
    $(this).attr("src","../img/send2.png");
  },function(){
      $(this).attr("src","../img/send.png");
    });

  $("#send_button").click(function(){
    $("#btn_Send").trigger("click");
  });

  $("#btn_Send").click(function(){
    sendMessage();
  });

  $("#my_profile_picture").load("Get_Profile_Picture.php");

  $(" #my_profile_picture").click(function(){
    $('#file').trigger("click");
  });

  $("#file").change(function(){
    $("#submit_file").trigger("click");
  });

  $("#submit_file").click(function(){
    $(this).submit();
  });

  $("#submit_file").submit(function(){
    $("#my_profile_picture").load("Get_Profile_Picture.php");
  });

  // SEND FILES
    $(" #btn_upload").click(function(){
      $('#my_upload_file').trigger("click");
    });

    $("#my_upload_file").change(function(){
      $("#upload_file").trigger("click");
    });

    $("#upload_file").click(function(){
      $(this).submit();
    });

    $("#upload_file").submit(function(){
      $("#get_uploads").load("uploaded.php");
    });
    

  // TIMERS

  // upload history

  setInterval(function(){
    uploadHistory();
  },3000);

  // load receiver username
  setInterval(function(){
    $("#get_name").load("user_clicked_on.php");
  },1000);

});

  function dropScroll(){
    $('#get_chat_logs').animate({ 
      scrollTop: $('#get_chat_logs').prop("scrollHeight")
      // $('#get_chat_logs').scrollTop($('#get_chat_logs').scrollHeight);
    }, 1000);
  }

</script>


<!-- new script -->

<script>

  function loadChat(){
    $("#get_chat_logs").load("Chat_Log.php");   
    dropScroll();
  }

   function countChat(){
    setInterval(function(){
      $.ajax({
          url:'private_message_ajax.php',
          method:'POST',
          dataType: 'text',
          data: {
            key: 'countChat',
          },success: function (response){
            if(response !== localStorage.getItem('countxxxxxx') ){
              loadChat();
              dropScroll();
              localStorage.setItem('countxxxxxx', response);
          }
        }
      });
    },2000);
  }

  function sendMessage(){
    message = $("#text_area").val()
      $.ajax({
        url:'private_message_ajax.php',
        method:'POST',
        dataType: 'text',
        data: {
          key: 'sendMessage',
          msg:message
        },success: function (response){
          $("#text_area").val(" ")
          loadChat();
          dropScroll();
        }
      });
  }

  function deleteUpload(file_name){
    $.ajax({
        url:'private_message_ajax.php',
        method:'POST',
        dataType: 'text',
        data: {
          key: 'deleteUpload',
          file_name : file_name
        },success: function (response){
          alert(file_name +" has been deleted")
      }
    });
  }

  // delete chat
  function deleteChat(id){
      $.ajax({
        url:'private_message_ajax.php',
        method:'POST',
        dataType: 'text',
        data: {
          key: 'deleteChat',
          id: id
        },success: function (response){
			}
		});
  	}

  function uploadHistory(){
    $(".sent").load("readUploaded.php");
  }  

</script>

<script>
  function Logout(){
  $.get("../Logout/Logout.php");
  }
</script>

</body>
</html>
