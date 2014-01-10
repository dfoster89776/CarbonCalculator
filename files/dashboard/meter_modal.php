<div class='form-horizontal' role='form'>
	<div id="alerts">
		
	</div>
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
	<div class='form-group' id='previousReadingDiv'>
		<label for='meterPrevious' class='col-md-offset-1 col-md-3 control-label'>Previous Reading</label>
		<div class='col-md-6'>
			<p class='form-control-static' id='meterPrevious'> - </p>
		</div>
	</div>
	<div class='form-group' id='inputReadingDiv'>
		<label for='meterInputReading' class='col-md-offset-1 col-md-3 control-label'>New Reading</label>
		<div class='col-md-6'>
			<input type='text' class='form-control' id='meterInputReading' placeholder='New Reading' onchange='updateMeterModal()' disabled='true'>
		</div>
	</div>
	<div class='form-group' id='amountUsedDiv'>
		<label for='meterUsedAmount' class='col-md-offset-1 col-md-3 control-label'>Amount Used</label>
		<div class='col-md-6'>
			<p class='form-control-static' id='meterUsedAmount'> - </p>
		</div>
	</div>
	<div class='form-group' id='inputUsernameDiv'>
		<label for='meterCarbon' class='col-md-offset-1 col-md-3 control-label'>Carbon Output</label>
		<div class='col-md-6'>
			<p class='form-control-static' id='meterCarbon'> - </p>
		</div>
	</div>
</div>