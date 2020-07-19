<div id="right-col-container">

<div id="message" style="margin-top:5%;">

<?php
if(isset($_GET['user'])){
$_GET['user']=$_GET['user'];
$temp=$_GET['user'];
?>

<?php

}else{
	$q='select `sender` , `receiver` from `chat` where `sender`="'.$_SESSION['username'].'" or receiver="'.$_SESSION['username'].'" order by `id` desc limit 1';
	$r=mysqli_query($con,$q);
	if($r){
	if(mysqli_num_rows($r)>0){
		while($row=mysqli_fetch_assoc($r)){
			$sender=$row['sender'];
			$receiver_name=$row['receiver'];
			
			if($sender==$_SESSION['username']){
				$_GET['user']=$receiver_name;
			}else{
				$_GET['user']= $sender;
			}
		}
		
	}else{
		echo 'no new message';
	}
	}else{
		echo 'query problem';
	}
}
if(isset($_GET['user']))
{
$ib = isBlocked($_SESSION['username'],$_GET['user']);
$sheb = isBlocked($_GET['user'],$_SESSION['username']);

$q='select * from `chat` where `sender`="'.$_SESSION['username'].'" and `receiver`="'.$_GET['user'].'"
	or `sender`="'.$_GET['user'].'" and `receiver`="'.$_SESSION['username'].'" order by `id`';
 $r=mysqli_query($con,$q);
 if($r and !($ib or $sheb)){
	 while($row= mysqli_fetch_assoc($r)){
		 $sender_name= $row['sender'];
		 $receiver_name= $row['receiver'];
		 $mess= $row['message'];
		 
		 ?>
		
		 <?php
		 if($sender_name==$_SESSION['username']){
		?>
			<div id="yellow" style="background-color:rgb(232,232,232);float:right;text-align:right;padding-right:5%;width:70%;border:none">
			<div class="extra">
			<a href="delete.php?mid=<?php echo $row['id'];?>& back=<?php echo $receiver_name;?>"><img src="delete.png" height="25px" width="25px"></a>
			</div>
			<a href="#"><?php echo $_SESSION['username']; ?>:</a> 
			 
			<p class="wrap" ><?php echo $mess; ?></p>
			</div>
		<?php
			 
		 }else{
		?>
			<div id="white" style="text-align:left;background-color:white;float:left;padding-left:5%;width:70%;border:none;">
			<div class="extra1">
	<!--<a href="report.php?mid=<?php echo $row['id'];?>&user=<?php echo $sender_name?>"><img src="report.png" height="25px" width="25px"></a>-->
			<button class="report" style="background-color:white; border:none;">	<input type="hidden" value=<?= $row['id'] ?> name="id" class="id">
			<input type="hidden" value=<?= $sender_name ?> name="back" class="back" ><img src="report.png" height="25px" width="25px"></button>
		
			</div>
			<a href="#"><?php echo $sender_name; ?>:</a>
			<p class="wrap" style="overflow:hidden;overflow-wrap:break-word"><?php echo $mess; ?></p>
			</div>
		<?php
		 }
		 
	 }
	 ?>
	 		
			<input type="hidden" value=<?= $_SESSION['username'] ?> name="blocker" id="blocker">
			<input type="hidden" value=<?= $_GET['user'] ?> name="blocked" id="blocked" >
			<button class="block" style="background-color:red; border:none;color:white;padding:5px;font-size:20px;position:absolute;top:1%;left:83%">BLOCK USER</button>
<?php
 }else{
	$s= $_SESSION['username'] ;
	 $r= $_GET['user'] ;
	 $code2=<<<EOD
	 			<input type="hidden" value=$s name="blocker" id="blocker">
			<input type="hidden" value=$r name="blocked" id="blocked" >
			<button class="block" style="background-color:red; border:none;color:white;padding:5px;font-size:20px;position:absolute;top:1%;left:83%">BLOCK USER</button>
EOD;

	 $code1=<<<EOD
	 	 		<input type="hidden" value=$s name="blocker" id="blocker">
			<input type="hidden" value=$r name="blocked" id="blocked" >
			<button class="unblock" style="background-color:red; border:none;color:white;padding:5px;font-size:20px;position:absolute;top:1%;left:81%">UNBLOCK USER</button>
EOD;

	 echo 'BLOCKED';
	 
	 if($ib)
		 echo $code1;
	 else if($sheb and !$ib)
		 echo $code2;
	 else
		 echo "error";
		 
	
}}
	?>

	</div>
	<div>
	<form method="post">
	<textarea style="margin-top:4px;overflow:auto" rows="4" cols="105" class="mess" placeholder="Enter your message here..." id="message_text" name="message_text"></textarea>
	<input type="submit" class="done" value="Send" name="send">
	</form>
	</div>
	<div id="status"></div>
	</div>
	
<script src="sub/jquery.js"></script>

<script>
	var a;
	$(document).ready(function(){
		
		var mydiv=document.getElementById("message");
		mydiv.scrollTop=mydiv.scrollHeight;
			
		
		$(".report").click(function(e){
			
		e.preventDefault();
        $.ajax( {
            
            url: "report.php",
            method: "post",
            data:{
				id:$(e.currentTarget.firstElementChild).val(),
				back:$(e.currentTarget.lastElementChild).val()
			},
            dataType: "text",
            success: function(strMessage) {
				a=e;
			alert("Message reported!!!");
			$("body").append(strMessage);
            },
			error: function(x,y,z)
			{
				alert("error");
			}
        });
	});	
		var blocker=$("#blocker").val();
		var blocked=$("#blocked").val();
		$(".block").click(function(e){
		e.preventDefault();
        $.ajax( {
            
            url: "blockuser.php",
            method: "post",
            data:{
				blocker:blocker,
				blocked:blocked
			},
            dataType: "text",
            success: function(strMessage) {
			
			alert("BLOCKED!!!");
			location.reload();
			$(".block").hide();
			$(".unblock").show();
            },
			error: function(x,y,z)
			{
				alert("error");
			}
        });
	});
	
	$(".unblock").click(function(e){
		e.preventDefault();
        $.ajax( {
            
            url: "unblockuser.php",
            method: "POST",
            data:{
				blocker:blocker,
				blocked:blocked
			},
            success: function(strMessage) {
				console.log(strMessage);
			$('body').append(strMessage);
			alert("USER UNBLOCKED!!!");
			location.reload();
			$(".block").show();
			$(".unblock").hide();
            },
			error: function(x,y,z)
			{
				alert("error");
			}
        });
	});
})
	
</script>

<?php

if(isset($_POST['send'])){
	if($_POST['message_text']!=''){
		$sender=$_SESSION['username'];
		$receiver=$_GET['user'];
		$message=$_POST['message_text'];
		$q="insert into `chat`(`sender`,`receiver`,`message`) values ('".$sender."','".$receiver."','".$message."')";
		$r=mysqli_query($con,$q);
		if($r){
		?>
		<script>
		window.location.href="index.php";
		</script>
		<?php
			
		}else echo 'query problem';
	}else echo 'enter some message';
	
}
exit()


?>


	
