<?php
	
	function isBlocked($blocker,$blockee)
	{
		include "connect.php";
		$sql = "select * from block where (blocker='$blocker' and blocked='$blockee');";
		$r = mysqli_query($con,$sql);
		if($r->num_rows)
			return true;
		else
			return false;
	}

?>