<div id="left-col-container">
	<input type="submit" class="new" onclick="document.getElementById('new-message').style.display='block'" value="NEW MESSAGE">
<?php
require_once "connect.php";
$q='select distinct `receiver`,`sender` from `chat` where `sender`="'.$_SESSION['username'].'" or `receiver`="'.$_SESSION['username'].'" order by `id` desc';
$r=mysqli_query($con,$q);
if($r){
	if(mysqli_num_rows($r)>0){
		$counter=0;
		$added_user=array();
		while($row=mysqli_fetch_assoc($r)){
			$sender_name=$row['sender'];
			$receiver_name=$row['receiver'];
			if($_SESSION['username']==$sender_name){
				if(in_array($receiver_name,$added_user)){
					
				}else{
					$qt="select * from `users` where `username`='$receiver_name'";
					$rr=mysqli_query($con,$qt);
					if($rr){
						if(mysqli_num_rows($rr)>0){
							$row=mysqli_fetch_assoc($rr);
							$path=$row['path'];
							
						}
					}
					?>
					<div id="one">
					<img src="<?= $path?>" class="image" width="50px" height="50px">
					<p><?php echo '<a href="?user='.$receiver_name.'">'.$receiver_name.'</a>' ; ?></p>
					<hr/>
					</div>
					
					<?php
					$added_user=array($counter => $receiver_name);
					$counter++; 
				}
			}elseif($_SESSION['username']==$receiver_name){
				if(in_array($sender_name,$added_user)){
					
				}else{
					$qt="select `path` from `users` where `username`='$receiver_name'";
					$rr=mysqli_query($con,$qt);
					if($rr){
						if(mysqli_num_rows($rr)>0){
							$row=mysqli_fetch_assoc($rr);
							$path=$row['path'];
						}
					}
					?>
					<div id="one">
					<img src="<?=$path?>" class="image" width="50px" height="50px">
					<p><?php echo '<a href="?user='.$sender_name.'">'.$sender_name.'</a>'; ?></p>
					<hr/>
					</div>
					
					<?php
					$added_user=array($counter => $sender_name);
					$counter++;
				}
				
			}
		}
	}else{
		echo 'no user sent you message ';
	}
}else{
	echo 'query problem';
}

?>


	
</div>