<div class='form-horizontal' role='form'>
	<div class='form-group' id='inputUsernameDiv'>
		<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Utility</label>
		<div class='col-md-6'>
			<div class="btn-group" data-toggle="buttons">
			  <label class="btn btn-primary" onclick="chooseElectric()">
			    <input type="radio" name="options" id="electricity"> Electricity
			  </label>
			  <label class="btn btn-primary" onclick="chooseGas()">
			    <input type="radio" name="options" id="gas"> Gas
			  </label>
			</div>
		</div>
	</div>
	<div class='form-group' id='inputUsernameDiv'>
		<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Previous Reading</label>
		<div class='col-md-6'>
			<p class='form-control-static' id='previous_reading'> - </p>
		</div>
	</div>
	<div class='form-group' id='inputUsernameDiv'>
		<label for='inputReading' class='col-md-offset-1 col-md-3 control-label'>New Reading</label>
		<div class='col-md-6'>
			<input type='text' class='form-control' id='inputReading' placeholder='New Reading' onchange=''>
		</div>
	</div>
</div>