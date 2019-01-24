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
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <!-- <link href="css/bootstrap-theme.min.css" rel="stylesheet"/> -->
  <link href="css/bootstrap-select.css" rel="stylesheet"/>
  <!-- <link href="css/style.css" rel="stylesheet" rel="stylesheet"/> -->
  <link href="css/general_announcement.css" media="all" rel="stylesheet"/>

</head>

<body>

  <!-- wrapper -->
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
        <li><a href="../Private_Message/Private_Message.php"><img src="../img/send-file.png" class="navimg img-responsive" /><span class="nav-writting">Private Chat</span></a></li>
        <li><a href="../General_Message/General_Message.php"><img src="../img/chat-1.png" class="navimg img-responsive" /><span class="nav-writting">Public Chat</span></a></li>
        <li><a href="../General_Share/General_Share.php"><img src="../img/businessman.png" class="navimg img-responsive" /><span class="nav-writting">Public Share</span></a></li>
        <li><a style="border-left:4px solid rgba(69, 162, 255, 0.93); border-radius:10px" href="#"><img src="../img/log-file-format-1.png" class="navimg img-responsive" /><span class="nav-writting">General Announcements</span></a></li>
        <li onclick="Logout()"><a href="../../index.php"><img src="../img/logout.png" class="navimg img-responsive" /><span class="nav-writting">Logout</span></a></li>
      </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <a href="#menu-toggle" class="btn btn-secondary btn-sm" id="menu-toggle"><i class="fas fa-bars"></i></a>
      
      <div class="container" id="main_content">
        <div class="row">

          <div class="col-md-9">
            <div class="announcement_page">
              <div class="row row-adjusted">

              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="right-page">
              <br>
              <div style="text-align:center">
                <span style="text-align:center;font-weight:bold">POST ANNOUNCEMENT</span>
                <hr>
              </div>

              <form method="post" action="">
                <div class="form-group">
                  <label for="txt_title" class="msg_title">Message Title</label>
                  <input type="text" class="form-control form-control-adjusted" id="txt_title" placeholder="Enter message title">
                </div>
                <div class="form-group">
                  <label for="txt_announcement" class="msg_title">Message </label>
                  <textarea  class="form-control" id="txt_announcement" placeholder="Enter announcement here"></textarea>
                </div>
                <div class="form-group" id="btn_holder">
                  <button class="btn btn-primary" id="btn_post">Post</button>
                </div>
              </form>

            </div>
          </div>

        </div>
      </div>

    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").mouseover(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
  </script>
  <script>
    $(document).ready(function(){

        $("#my_profile_picture").load("Get_Profile_Picture.php");

      setInterval(function(){
      $(".row-adjusted").load("get_announcement.php").fadeIn("slow");
    },500);

      $("#btn_post").click(function(){
        var title_holder = $("#txt_title").val();
        var message_holder = $("#txt_announcement").val();
        $.ajax({
          method:"POST",
          url:"",
          data:{title:title_holder,
            message:message_holder},
          success:function(status){
            $(".row-adjusted").load("get_announcement.php").fadeIn("slow");
              }
        });
      });


    $(" #my_profile_picture").click(function(){
    $('#file').trigger("click");
    });

    $("#file").change(function(){
      $("#submit_file").trigger("click");
    });

    $("#submit_file").click(function(){
        $(this).submit();
    });

      });
  </script>

  <script>
    function Logout(){
    $.get("../Logout/Logout.php");
    }
  </script>

<?php

  $host = "localhost";
  $user = "root";
  $pass = "";
  $database = "solid";

  $connection_String = mysqli_connect($host,$user,$pass,$database);

    $message_title = $_POST["title"];
    $message_body = $_POST["message"];
    $message_sender = $_COOKIE["user_first_name"];

    if($message_title!=""&& $message_body!=""){

      $insert_query_command = "INSERT INTO general_announcement (`id`, `message_title`, `message_body`, `sender`, `date`) VALUES (NULL, '$message_title', '$message_body', '$message_sender', CURRENT_TIMESTAMP)";
      $execute_insert_query = mysqli_query($connection_String,$insert_query_command);
    }
?>

</body>
</html>
