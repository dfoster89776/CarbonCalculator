<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Create New Group</h4>
</div>
<div class="modal-body" id="newGroupBody">
	<div class='form-horizontal' role='form'>
		<div class='form-group'>
			<label for='journeyNotes' class='col-md-offset-1 col-md-3 control-label'>Group Name</label>
			<div class='col-md-6'>
			<input type='text' class='form-control' id='groupName'>
		</div>
		</div>
	</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success" onclick="submitNewGroup()" id="newGroupSubmitButton">Submit</button>
</div>