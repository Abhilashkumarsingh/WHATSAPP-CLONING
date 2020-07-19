<?php require_once('connect.php');?>
<!doctype html>
<html>
<head>
<title> Sign </title>
<link rel="stylesheet" href="createaccount.css">
</head>

	<body>
	<div class="logo">
				<p>just</p>
				<p>chat</p>
				<div><img src="signup.png" width="50px" height="50px" style="float:right;margin-right:30px;margin-top:5px;"></div>
			</div>
	<div class="sign-up-form">
	
		<div class="same">
		<div class="page">
		<table>

<form method ="post" enctype="multipart/form-data">

	<h2> Registration Form</h2>
	
	
<tr>
<td colspan="2"><input type ="text" name="name" class="input-box" id="name" placeholder="Name" size="50" required></td>
</tr>
<tr>
<td colspan="2"><input type ="email" name="email" id="email" class="input-box" size="50" placeholder="Email address" required></td>
</tr>
<tr>
<td colspan="2"><input type ="text" name="username" autocomplete="off" id="username" size="50" class="input-box" onkeyup="check_user()" placeholder="Username" required></td>
</tr>
<tr>
<td><input type ="Password" name="password" id="Password" class="input-box" size="20" placeholder="Password" required></td>
<td><input type ="Password" name="password1" id="Password" class="input-box" size="20" placeholder="Confirm Password" required></td>
</tr>
<tr>
<td colspan="2"><input type ="file" name="file" id="file"></td>
</tr>
<tr>
<td colspan="2"><div id="check"></div></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="signup" class ="signup-btn" id="signup"></td>
</tr>
<tr>
<td><a href="login.php">Already registered?Sign In</a></td>
</tr>
</form>
</table>
<div id="check">
</div>
</div>
</div>
</div>
'</body>
</html>
<?php
if(isset($_POST['signup'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$uname=$_POST['username'];
	$pass=$_POST['password'];
	$pass1=$_POST['password1'];
	$file=$_FILES['file'];
	$filename=$_FILES['file']['name'];
	$filetmpname=$_FILES['file']['tmp_name'];
	$filesize=$_FILES['file']['size'];
	$fileerror=$_FILES['file']['error'];
	$filetype=$_FILES['file']['type'];
	$fileext=explode('.',$filename);
	$fileactext=strtolower(end($fileext));
	$allowed=array('jpg','jpeg','png');
	if(in_array($fileactext,$allowed)){
		$filenamenew= uniqid('',true).".".$fileactext;
		$filedestination='images/'.$filenamenew;
		move_uploaded_file($filetmpname,$filedestination);
	}
if($pass==$pass1)
{	$q="insert into `users`(`username`,`pass`,`name`,`email`,`path`)values('".$uname."','".$pass."','".$name."','".$email."','".$filedestination."')";
	$r=mysqli_query($con,$q);
	if($r)
	{
		echo 'user inserted';
		header("location:login.php");
	}
	else
	{
		echo 'query problem';
	}
}
}
?>

<script src="sub/jquery.js"></script>
<script>

function check_user(e)
{
	if($('#username').val()=="")
	{
		$('#check').html("<p style=\"color:red\">empty name not allowed</p>");
		return;
	}
	$.ajax({
		type:"post",
		url:"sub/check_user.php",
		data:{username:$("#username").val()},
		success:function(ss)
		{
			$('#check').html(ss);
		},
		error:function(x,y,z)
		{
			alert("errpr");
		}
	});
}
</script>	