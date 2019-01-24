<?php

$selectedID = $_POST['userID'];
$selectedUsername = $_POST['username'];
$selectedUsername_last_name = $_POST["userslast_name"];

setcookie("clicked_on_user_last_name",$selectedUsername_last_name,time() + (86400 * 30));

setcookie("default_clicked_on_username",$selectedUsername,time() + (86400 * 30));

include "Chat_Log.php";

?>
