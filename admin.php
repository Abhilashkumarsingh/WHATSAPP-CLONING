<?php session_start();
require_once "connect.php"?>
<!doctype html>
<html>
<head>
<script src="sub/jquery.js"></script>
<link rel="stylesheet" href="admin.css" type="text/css">
</head>
<body>
	<div class="nav" style="background-color:blue;">
	<?php
	echo '<p style="float:right;color:white;font-size:25px;margin-top:15px;margin-right:7%;">'.$_SESSION['username'].'</p>';
	?>
	<div class="logo">
		<p>just</p>
		<p>chat</p>
	</div>
	<?php
	echo '<a style="float:right;margin-right:5%;text-decoration:none;position:absolute;top:2%;left:85%;" href="logout.php"><img src="logout.png" width="50px" height="50px"></a>';
	?>
	</div>
	<div class="container">
	<button type="submit" id="some1">CHECK REPORT</button>
	<button type="submit" id="some2">BLOCK ACCOUNT</button>
	<button type="submit" id="some3">SEND MESSAGE</button>
	<button type="submit" id="some4">DELETE ACCOUNT</button>
	<div id="showbtn">
	<button type="submit" id="some4"></button>
	</div>
	<div class="show" id="show" style="padding-left:8px;padding-top:5px;overflow-y:auto">
	<div id="default">
	<?php
	$q="select * from chat where `receiver`='admin'";
	$r=mysqli_query($con,$q);
	if($r){
		if(mysqli_num_rows($r)>0){
			while($row=mysqli_fetch_assoc($r)){
				?>
				<pre><span style="color:red;font-size:15px"><?= $row['sender']?>:</span>  <span style="color:green;font-size:15px"><?= $row['message']?></span><br/></pre>
				<?php
			}
		}
	}
	
	?>
	</div>
	</div>
	<div class="side_nav">
	<div class="button1" id="button1" style="overflow:auto;width:100%;height:100%">
	<?php
	$q="select * from chat c, report r where r.id=c.id order by r.id ;";
	$r=mysqli_query($con,$q);
	if($r){
		if(mysqli_num_rows($r)){
			while($row=mysqli_fetch_assoc($r)){
				?>
				<pre> <p style="color:green"><?= $row['receiver'];?></p> reported <p style="color:red"><?=$row['sender']?></p>    for message->  <?= $row['message']?></pre><br/><br/>
				<?php
			}
		}
	}else{
		
	}
	
	?>
	</div>
	<div id="button6">
	<fieldset>
	<legend>DELETE ACCOUNT</legend>
	<form id="form6">
	<input type="text" id="box" placeholder="ENTER USER ID" name="account" id="account" required>
	<button  type="submit" id="delete" name="delete">DELETE ACCOUNT</button>
	</form>
	</fieldset>
	</div>
	
	<div class="button5">
	<img src="adminpro.png" width="570px" height="430px" style="margin-left:4%">
	</div>
	<div class="button2" id="button2">
		<form id="form2"  method="post">
		<fieldset>
		<table>
		<legend>BLOCK USER</legend>
		<tr>
		<td>Who you gonna call?</td>
		<td><input type="text"  size="25" name="user_id" class="blocked" required></td>
		
		</table>
		</fieldset>
		<button type="submit" id="create" name="create" id="form2btn" style="background-color:#28a745;padding:7px;font-size:15px;border:none;width:300px;color:white;">
		BLOCK</button>
		</form>
				<form id="form4"  method="post">
		<fieldset>
		<table>
		<legend>UNBLOCK USER</legend>
		<tr>
		<td>Who you gonna cut?</td>
		<td><input type="text"  size="25" name="user_id" class="unblocked" required></td>
		
		</table>
		</fieldset>
		<button type="submit" id="create" name="create" id="form4btn" style="background-color:#28a745;padding:7px;font-size:15px;border:none;width:300px;color:white;">
		UNBLOCK</button>
		</form>
		<div id="resultform4"><p style="color:red;margin-top:4%;margin-left:5%"><script> $(".unblocked").val() </script> Unblocked.....</p></div>
	</div>

	
	
	
	<div class="button3" id="button3">
	<form id="form3" action="join.php" method="post">
	<fieldset>
	<legend>SEND MESSAGE</legend>
	<table>
	<tr>
	<td><input type="text" name="user" id="user" placeholder="user name" required size="40"></td>
	</tr>
	<tr>
	<td><input type="textbox" name="mess" id="mess" placeholder="write your message here ..." required size="40"></td>
	</tr>
	</table>
	</fieldset>
	<button  type="submit" id="join" name="join">SEND</button>
	</form>
	<div id="resultform3"><p style="color:red;margin-top:10%">MESSAGE SENT....</p></div>
	</div>
	</div>
	</div>
</body>
</html>


<script>
$( document ).ready(function() {
	$("#button2").hide();
	$("#button3").hide();
	$("#button1").hide();
	$("#button4").hide();
	$("#result").hide();
	$("#button6").hide();
	//$("#resultform1").hide();
	$("#resultform3").hide();
	$("#resultform2").hide();
	$("#resultform4").hide();
	
    $("#some1").click(function(){
		$("#button2").hide();
		$("#button3").hide();
		$("#button1").show();
		$("#button4").hide();
		$('.button5').hide();
		$("#button6").hide();
	});
	
	 $("#some2").click(function(){
		$("#button2").show();
		$("#button3").hide();
		$("#button1").hide();
		$("#button4").show();
		$('.button5').hide();
		$("#button6").hide();
	});
	
	 $("#some3").click(function(){
		$("#button2").hide();
		$("#button3").show();
		$("#button1").hide();
		$("#button4").hide();
		$('.button5').hide();
		$("#button6").hide();
	});
	$("#some4").click(function(){
		$("#button2").hide();
		$("#button3").hide();
		$("#button1").hide();
		$("#button4").hide();
		$('.button5').hide();
		$("#button6").show();
	});
	
	$("#form1").submit(function(e) {
        e.preventDefault();
        $.ajax( {
            
            url: "action.php",
            method: "post",
            data: $("form").serialize(),
            dataType: "text",
            success: function(strMessage) {
			$("#resultform1").show();
            $("#form1")[0].reset();
			//$('#resultform1').delay(2000).fadeOut('slow');
            }
        });
    });

	
	$("#form2").submit(function(e) {
        e.preventDefault();
        $.ajax( {
            
            url: "blockuser.php",
            method: "post",
            data: {blocker:"admin",blocked:$(".blocked").val()},
            dataType: "text",
            success: function(strMessage) {
			$("#resultform2").show();
            $("#form2")[0].reset();
			alert($(".blocked").val() +"blocked..")
			$('#resultform2').delay(2000).fadeOut('slow');
            }
        });
    });
	$("#form6").submit(function(e) {
        e.preventDefault();
        $.ajax( {
            
            url: "account.php",
            method: "post",
            data:{user:$("#account").val()} ,
            dataType: "text",
            success: function(strMessage) {
            $("#form6")[0].reset();
			alert(strMessage);
			
            }
        });
    });
		$("#form4").submit(function(e) {
        e.preventDefault();
        $.ajax( {
            
            url: "unblockuser.php",
            method: "post",
            data: {blocker:"admin",blocked:$(".unblocked").val()},
            dataType: "text",
            success: function(strMessage) {
			$("#resultform4").show();
            $("#form4")[0].reset();
			$('#resultform4').delay(2000).fadeOut('slow');
            }
        });
    });
	
	$("#form3").submit(function(e) {
        e.preventDefault();
        $.ajax( {
            
            url: "senduser.php",
            method: "post",
            data: {
				user:$('#user').val(),
				message:$('#mess').val()
			},
            dataType: "text",
            success: function(strMessage) {
				if(strMessage==='inserted'){
			$("#resultform3").show();
            $("#form3")[0].reset();
			$('#resultform3').delay(2000).fadeOut('slow');
			}else{
				alert(strMessage);
			}
            }
        });
    });
	
	


});

</script>