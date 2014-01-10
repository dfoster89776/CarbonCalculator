<div class="panel panel-default">
  <div class="panel-heading">University Class</div>
  <div class="panel-body">
	  HERE
  </div>
</div>

<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="width: 100%">
  Add New Class
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add New Class</h4>
      </div>
      <div class="modal-body" id="class_modal_body">
		<div class='form-horizontal' role='form'>
			<div class='form-group' id='inputUsernameDiv'>
				<label for='inputClassCode' class='col-md-offset-1 col-md-3 control-label'>Class Code</label>
				<div class='col-md-6'>
					<input type='text' class='form-control' id='inputClassCode' onchange='checkClassValidity()' placeholder='Code'>
				</div>
			</div>
			<div class='form-group'>
				<div class='col-md-offset-4 col-md-6'>
					<div class="alert alert-danger" id="classAlert" style="visibility: hidden;">Class does not exist</div>
				</div>
			</div>
			<div class='form-group'>
				<label for='journeyConversionRate' class='col-md-offset-1 col-md-3 control-label'>Module Code</label>
				<div class='col-md-6'>
					<p class='form-control-static' id='module_code'> - </p>
				</div>
			</div>
			<div class='form-group'>
				<label for='journeyConversionRate' class='col-md-offset-1 col-md-3 control-label'>Teacher</label>
				<div class='col-md-6'>
					<p class='form-control-static' id='module_teacher'> - </p>
				</div>
			</div>
			<div class='form-group'>
				<label for='journeyConversionRate' class='col-md-offset-1 col-md-3 control-label'>Session</label>
				<div class='col-md-6'>
					<p class='form-control-static' id='module_session'> - </p>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="joinClass()">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>