<?php
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");
	
	$data = $carbon->getUsersFullActivity($_POST['username']);
	
?>	

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel" ><?php echo($_POST['username']); ?></h4>
</div>
<div class="modal-body">


	<?php
		
		foreach ($data as $activity){
			
			
			if($activity['activity_type'] == "login"){
				
				echo("<h4> Logged in </h4>".$activity['timestamp']);
				
			}
			elseif($activity['activity_type'] == "carbon_activity"){
				
				echo("<h4> Posted Carbon Activity </h4>".$activity['timestamp']);
				
			}
			else{
				var_dump($activity);	
			}
			
			echo("<hr/>");
			
			
		}
		
	?>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
</div>
