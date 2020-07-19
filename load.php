<?php
if(isset($_POST['data'])){
	echo 'yes set';
}else echo 'not set';
session_start();
require_once "connect.php";
if(isset($_GET['user'])){
$_GET['user']=$_GET['user'];
$temp=$_GET['user'];
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
$q='select * from `chat` where `sender`="'.$_SESSION['username'].'" and `receiver`="'.$_GET['user'].'"
	or `sender`="'.$_GET['user'].'" and `receiver`="'.$_SESSION['username'].'"';
 $r=mysqli_query($con,$q);
 if($r){
	 while($row= mysqli_fetch_assoc($r)){
		 $sender_name= $row['sender'];
		 $receiver_name= $row['receiver'];
		 $mess= $row['message'];
		 if($sender_name==$_SESSION['username']){
		?>
			<div id="yellow" style="background-color:yellow;text-align:right;padding:3px 5px;width:auto;border:none">
			<a href="delete.php?txt=<?php echo $mess;?>&user=<?php echo $receiver_name;?>">delete</a> <a href="#"><?php echo $_SESSION['username']; ?>:</a> 
			<p class="wrap" ><?php echo $mess; ?></p>
			</div>
		<?php
			 
		 }else{
		?>
			<div id="white" style="text-align:left;padding:3px 5px;width:auto;border:none;">
			<a href="#"><?php echo $sender_name; ?>:</a>
			<p class="wrap" style="overflow:hidden;overflow-wrap:break-word"><?php echo $mess; ?></p>
			</div>
		<?php
		 }
	 }
 }else{
	 echo 'query problem';
 }



?>