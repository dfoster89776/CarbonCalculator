<?php

	$data = $_POST['json'];

?>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Add Daily Lifestyle</h4>
</div>
<div class="modal-body" id="lifestyleModalBody" style="margin-top: -40px;">
	<?php echo $data ?>
</div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>