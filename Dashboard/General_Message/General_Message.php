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
    <link href="../css/jquery.yacal.css" rel="stylesheet"/>
    <link href="css/genStyle.css" rel="stylesheet">

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
                <li><a href="../Private_Message/Private_Message.php"><img src="../img/send-file.png" class="navimg img-responsive" /><span class="nav-writting">Private Chat</span></a></li>
                <li><a style="border-left:4px solid rgba(69, 162, 255, 0.93); border-radius:10px" href="General_Message.php"><img src="../img/chat-1.png" class="navimg img-responsive" /><span class="nav-writting">Public Chat</span></a></li>
                <li><a href="../General_Share/General_Share.php"><img src="../img/businessman.png" class="navimg img-responsive" /><span class="nav-writting">Public Share</span></a></li>
                <li><a href="../General_announcement/general_announcement.php"><img src="../img/log-file-format-1.png" class="navimg img-responsive" /><span class="nav-writting">General Announcements</span></a></li>
                <li onclick="Logout()"><a href="../../index.php"><img src="../img/logout.png" class="navimg img-responsive" /><span class="nav-writting">Logout</span></a></li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <a href="#menu-toggle" class="btn btn-secondary btn-sm" id="menu-toggle"><i class="fas fa-bars"></i></a>
            <div class="container-fluid"  id="main_content">
                <div class="row">
                    <!-- main chat -->
                    <div id="Main_Chat_Box" class="col-md-8">           
                        <br/>
                        <div id="get_chatting_user_name">
                            <div style="font-weight:bold;font-size:1.2em;float:left;color:rgba(69, 162, 255, 0.93)">General Chats</div>
                            <br>
                        </div>
                        <hr>
                        <div id="get_chat_logs">
                        </div>
                        <form action="" id="form_send_message" style="width:100%;background-color:white;height:40px;margin-top:10px;">
                            <textarea id="text_area" placeholder="Type Something Here" style='width:92%; height:100%;'></textarea>
                            <img src="../img/send.png" class='img-responsive' alt="Send Image" id="send_button" style='height:100%;margin-top:-30px;background-color:white;' />
                            <button id="btn_Send" style='display:none;'></button>
                        </form>
                    </div>
                    <!-- side calender -->
                    <div id="Right_side_bar" class="col-md-3">
                        <div>
                            <span class="right_side_logo"> Today <hr></span>
                            <div class="calendar"></div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div><span class="right_side_logo"> Uploads </span> <hr></div>
                        <div id="get_uploads"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                    </div>
                </div>     
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- ClickDesk Live Chat Service for websites -->
    <script type='text/javascript'>
    var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyEgsSBXVzZXJzGICA4NftzOYIDA');
    var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 
    'http://my.clickdesk.com/clickdesk-ui/browser/');
    var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
    var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; 
    glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
    var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
    </script>
    <!-- End of ClickDesk -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../js/jquery.yacal.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").mouseover(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
 <?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "solid";
    $connection_String = mysqli_connect($host,$user,$pass,$database);

    if(!empty($_POST["senders_message"])){
        $messageSender = $_COOKIE["user_first_name"];
        $newmessage = mysqli_real_escape_string($connection_String, $_POST["senders_message"]);

        $my_query = "INSERT INTO public_messages ( Sender, Message ) VALUES ('$messageSender','$newmessage')";

        if($run = mysqli_query($connection_String,$my_query)){
          echo "<embed loop='false' src='sound.wav' autoplay='true' hidden='false'/>";
        }
      }
  ?>

  <?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "solid";
    if(isset($_POST["submit_file"])){
    $selected_username = $_COOKIE["user_first_name"];
    $users_last_name = $_COOKIE["users_last_name"];
    move_uploaded_file($_FILES["file"]["tmp_name"],"../Profile_Pictures/".$_FILES["file"]["name"]);
    $connection_String = mysqli_connect($host,$user,$pass,$database);
    $myfiles = $_FILES["file"]["name"];
    $update_profile_query = "UPDATE users_table SET Profile_Picture = '$myfiles' WHERE user_fname ='$selected_username' AND user_lname = '$users_last_name'";
    $execute_update_profile_query = mysqli_query($connection_String,$update_profile_query);
  }
  ?>

    <script type="text/javascript">

    $(document).ready(function(){
    $("#my_profile_picture").load("Get_Profile_Picture.php");

    $(".calendar").yacal({
      tpl: {
        weekday: '<strong class="wday wd#weekday#">#weekdayName#<\/strong>'
      } });

    $(" #my_profile_picture").click(function(){
    $('#file').trigger("click");
    });

    $("#file").change(function(){
      $("#submit_file").trigger("click");
    });

    $("#submit_file").click(function(){
        $(this).submit();
    });

    $("#my_upload_file").change(function(){
    $("#upload_file").trigger("click");
    });

    $("#upload_file").click(function(){
        $(this).submit();
        scrolling;
    });

    $("#upload_file").submit(function(){
      $("#get_uploads").load("uploaded.php");
    });


    $("#send_button").click(function(){
    $("#btn_Send").trigger("click");
    });

    $("#btn_Send").click(function(){
      var message = $("#text_area").val();
      $.ajax({
        method:"POST",
        url:"",
        data:{senders_message:message},
      });
    });

    setInterval(function(){
     $("#get_uploads").load("uploaded.php");
   },500);

   function get_messages(){
     var old_scroll_height = $("#get_chat_logs").attr("scrollHeight") - 20;
     $.ajax({
        url: "chat.php",
        cache: false,
        success: function(html){
            $("#get_chat_logs").html(html);
            //updateScroll();
        },
    });
   }

    setInterval(get_messages,2000);
 
    $("#send_button").hover(function(){
    $(this).attr("src","../img/send2.png");
          }, function() {
    $(this).attr("src","../img/send.png");
      });

     window.setTimeout(function() {
     updateScroll();
    }, 3000);
    });

    </script>
    <script type="text/javascript">
    function Logout(){
    $.get("../Logout/Logout.php");
  };

    function dropScroll(){
      var elem = document.getElementById('get_chat_logs');
      elem.scrollTop = elem.scrollHeight;
    }

    
   function updateScroll(){
     
    $('#get_chat_logs').animate({ 
      scrollTop: $('#get_chat_logs').prop("scrollHeight")
    }, 1000);

  };

    
 </script>

</body>
</html>

