<head>
<script type="text/javascript" src="js/jquery.min.js"></script>
<style>

	.sender,.receiver{
		background-color: #d8d4d4;
		width: 70%;
		margin-top: 2px;
		margin-bottom: 2px;
	}

	.receiver{
		float: left;
		text-align: left;
		margin-left: 15px;
	}

	.sender{
		float:right;
		text-align: right;
		margin-right: 15px;
	}

	div[class="shape_receiver"]{
		background-color: white;
		padding: 5px 10px 5px 10px;
		border-radius: 0px 20px 20px 20px;
	}

	div[class="shape_sender"]{
		background-color: rgba(69, 162, 255, 0.93);
		padding: 0px 10px 5px 10px;
		border-radius: 20px 3px 20px 20px;
	}

	span[class="original_sender"]{
		color: white;
		display: inline-block;
		text-align: center;
	}

	span[class="original_receiver"]{
		color: gray;
		display: inline-block;
		text-align: center;
	}
	.time{
		font-size: 10px;
		margin-right:5px;
	}

	.chat-delete-sender{
		background-color:transparent;	
		border-color:transparent;
		float: right;
		padding:0;
	}
	.chat-delete-receiver{
		background-color:transparent;	
		border-color:transparent;
		float: right;
		padding:0;
	}
	.btn-default{
		float:right;
		padding:0;
		margin-bottom:5px;
		background-color:transparent;
	}

	.btn-default:hover{
		background-color:transparent;
		border-color:transparent;
	}

</style>
</head>

<body>
	

<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "solid";

$connection_String = mysqli_connect($host,$user,$pass,$database);

$sender = $_COOKIE["user_first_name"];
$receiver = $_COOKIE["default_clicked_on_username"];
$chat_log_query = "SELECT * FROM posts where sender = '$sender' and receiver = '$receiver' ORDER BY id ASC";

$executing_chat_log_query = mysqli_query($connection_String,$chat_log_query);

while($rows = mysqli_fetch_array($executing_chat_log_query))  :

if($rows["msg_sender"]==$_COOKIE["user_first_name"]){
	 echo 	"<div class='sender' id='sender'>
					 	<span class='original_sender'>
							<div class='shape_sender'>".$rows["msg"]."
								<br>
								<br>
								<div style='display:flex;flex-direction:row;width:100%;'>
									<span class='time' width='60%'>".$rows["time"]."</span>
									<div class='dropdown' width='40%' id='dropdown'>
										<button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
										</button>
									<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
										<button onclick='deleteChat(".$rows["id"].")' class='dropdown-item' href='#'>Delete</button>
									</div>
								</div>
							</div>

							<input name='my_chat' id='my_chat' type='text' value=".$rows['id']." hidden/>
							</div>
						</span>
					</div>";
}else{
	echo "<div class='receiver'>
					<span class='original_receiver'>
						<div class='shape_receiver'>".$rows["msg"]."
							<br>
							<br>
							<div style='display:flex;flex-direction:row;'>
								<span class='time' width='60%'>".$rows["time"]."</span>
								<div class='dropdown' width='40%' >
									<button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
									</button>
									<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
										<button onclick='deleteChat(".$rows["id"].")' class='dropdown-item' href='#'>Delete</button>
									</div>
								</div>
							</div>

							<input name='my_chat' id='my_chat' type='text' value=".$rows['id']." hidden/>
						</div>
					</span>
				</div>";
			}

endwhile;

?>
</body>
