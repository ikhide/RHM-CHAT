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
    $update_profile_query = "UPDATE users_table SET Profile_Picture = '$myfiles' WHERE user_fname = '$selected_username'AND user_lname ='$users_last_name' ";
    $execute_update_profile_query = mysqli_query($connection_String,$update_profile_query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>General Share</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    
    <link href="css/style3.css" rel="stylesheet" />
    <link href="css/genShare.css" rel="stylesheet">
   
</head>

<body>
    <div id="wrapper" class="toggled">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <br/>
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
                <li><a style="border-left:4px solid rgba(69, 162, 255, 0.93); border-radius:10px" href="General_Share.php"><img src="../img/businessman.png" class="navimg img-responsive" /><span class="nav-writting">Public Share</span></a></li>
                <li><a href="../General_announcement/general_announcement.php"><img src="../img/log-file-format-1.png" class="navimg img-responsive" /><span class="nav-writting">General Announcements</span></a></li>
                <li onclick="Logout()"><a href="../../index.php"><img src="../img/logout.png" class="navimg img-responsive" /><span class="nav-writting">Logout</span></a></li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <a href="#menu-toggle" class="btn btn-secondary btn-sm" id="menu-toggle"><i class="fas fa-bars"></i></a>
          
            <div class="container" id="main_content">
                <div class="row">
                    <div class="col-md-8">
                        <div class = "panel-body pbody">
                            <form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
                                <div id="drop">
                                    Drop Here(max~3MB)
                                    <a>Browse</a>
                                    <input type="file" name="upl" multiple hidden/>
                                </div>
                                <ul>
                                    <!-- The file uploads will be shown here -->
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="side_bar_holder">
                            <div class="designer">
                                <div style="text-align:center;padding-top:15px"><span style="color:white;font-weight:bold">General Uploads<span>
                                </div>
                            </div>
                        <div class="uploaded_container">
                        </div>
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
<script src="js/jquery.knob.js"></script>
<script src="js/jquery.ui.widget.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<!-- Our main JS file -->
<script src="js/script.js"></script>


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

    setInterval(function(){
        $(".uploaded_container").load("uploaded.php");
    },2000);
</script>

<script type="text/javascript">
    function Logout(){
        $.get("../Logout/Logout.php");
    }
</script>

</body>

</html>
