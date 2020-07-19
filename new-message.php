<div id="new-message">
	<p class="head" style="background-color:blue;color:white">new message</p>
	<p class="body">
	<form method="post">
	<input type="text"  name="user" id="user" placeholder="sender name" onkeyup="suggest_user()" size="60" required style="float:left">
	<div id="cancel" style="color:red;width:200px;font-size:15px;text-align:center">user doesn't exist</div>
	<textarea placeholder="enter your message "  rows="3" cols="65 "required name="message"></textarea><br/>
	<input type="submit" value="send" name="submit" id="submit">
	<input type="submit" value="cancel" name="cancel" onclick="document.getElementById('new-message').style.display='none' ">
	
	
	</p>
	<p class="footer" style="background-color:blue;color:white">click send </p>
	</form>

</div>


<script src="sub/jquery.js"></script>
<script>
document.getElementById("submit").disabled=true;
document.getElementById("cancel").style.display='none';
function suggest_user(){
	var name=document.getElementById("user").value;
	$.post("suggest_user.php",
	{
		user:name
	},
	function(data,status){
		if(data== 'user doesnot exixt' ){
			document.getElementById("submit").disabled=true;
			document.getElementById("cancel").style.display='block';
			
		}
		if(data=='verified'){
			document.getElementById("submit").disabled=false;
			document.getElementById("cancel").style.display='none';
		}
			
	}
	
	);
}
</script>

<?php
require_once "connect.php";
if(isset($_POST['submit'])){
	$sender=$_SESSION['username'];
	$receiver=$_POST['user'];
	$message=$_POST['message'];
	$q="insert into `chat`(`sender`,`receiver`,`message`) values ('".$sender."','".$receiver."','".$message."')";
	$r=mysqli_query($con,$q);
	if($r){
		$url ="index.php?user=".$receiver;
		header('location:' .$url);
	}else{
		echo 'message not sent';
	}
	
}


?>



