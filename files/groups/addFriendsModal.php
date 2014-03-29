<?php

	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();
	require_once("../secure/check_login.php");

	$friends = $carbon->friendsNotInGroup($_POST['groupNo']);

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Add Friends to Group</h4>
</div>
<div class="modal-body" id="newGroupBody">
	
	<?php
	
		if($friends){
									
				foreach($friends as $friend){
				
					echo("<div class='row' style='padding: 5px'>");
					echo("<div class='col-sm-2'><img class='media-object' src='".$carbon->getOtherFacebookUserImageFromUserId($friend['userid'])."' alt='...' width='60px'></div>");
					echo("<h3 class='col-sm-7'>".$friend['firstname']." ".$friend['surname']."</h3>");
					?>
					<button class="btn btn-success" id='add_friend_button_<?php echo($friend['friend_username']) ?>' style="margin-top: 20px" onclick="addFriendToGroup('<?php echo($friend['friend_username']) ?>')"> Add to Group</button>
					<button class='btn' id='friend_added_button_<?php echo($friend['friend_username']) ?>' style='margin-top: 20px; display: none;'> Friend Added</button>
					<?php
					echo("</div>");
				}
						
		}else{
			echo("<h2> No friends are available to add to this group. </h2>");
		}
	
	?>
	
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>