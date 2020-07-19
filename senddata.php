<html>
<body>
<input type="textarea" rows="6" cols="60" name="text" id="text" required placeholder="ENTER YOUR MESSAGE">
<input type="submit" value="submit" name="submit" id="submit">
</body>
</html>
<script src="sub/jquery.js"></script>
<script>
$(document).ready(function(){
	$('#submit').click(function(){
		$.ajax({
			url:"perform.php",
			method:"post",
			data:"text";
			dataType:"Text",
			success:function(strmessage){
				
			}
			
		})
		
		
	})
	
	
	
})
</script>