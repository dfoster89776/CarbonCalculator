<div class='form-horizontal' role='form'>
	<div class='form-group' id='inputJourneyTypeDiv'>
		<label for='journeyMainCategory' class='col-md-offset-1 col-md-3 control-label'>Category</label>
		<div class='col-md-6'>
		<select class='form-control' id="journeyMainCategory" onchange="updateCategory()">
			<option value="car">Car</option>
			<option value="motorcycle">Motorcycle</option>
			<option value="taxi">Taxi</option>
			<option value="coach">Coach</option>
			<option value="rail">Rail</option>
			<option value="plane">Plane</option>
			<option value="ferry">Ferry</option>
		</select>
		</div>
	</div>
	<div class='form-group' id='subCategoryDiv' style="display: none;">
		<label for='journeySubCategory' class='col-md-offset-1 col-md-3 control-label'>Subcategory</label>
		<div class='col-md-6'>
		<select class='form-control' id="journeySubCategory" onchange="updateSubCategory()">
		</select>
		</div>
	</div>
	<div class='form-group'>
		<label for='journeyDate' class='col-md-offset-1 col-md-3 control-label'>Date</label>
		<div class='col-md-6'>
			<input type='email' class='form-control' id='journeyDate' value='<?php date_default_timezone_set('UTC'); 
echo date('d-m-Y'); ?>'>
		</div>
	</div>
	<div class='form-group'>
		<label for='journeyNotes' class='col-md-offset-1 col-md-3 control-label'>Notes</label>
		<div class='col-md-6'>
			<textarea class='form-control' id='journeyNotes' rows='5' style='max-width: 100%;'></textarea>
		</div>
	</div>
	<div class='form-group'>
		<label for='journeyDistance' class='col-md-offset-1 col-md-3 control-label'>Distance (km)</label>
		<div class='col-md-6'>
			<input type='number' class='form-control' id='journeyDistance' placeholder='0' onchange="updateCarbon()">
		</div>
	</div>
	<div class='form-group'>
		<label for='journeyConversionRate' class='col-md-offset-1 col-md-3 control-label'>Conversion Rate</label>
		<div class='col-md-6'>
			<p class='form-control-static' id='journeyConversionRate'> 0.0 </p>
		</div>
	</div>
	<div class='form-group'>
		<label for='journeyCarbon' class='col-md-offset-1 col-md-3 control-label'>Carbon Output</label>
		<div class='col-md-6'>
			<p class='form-control-static' id='journeyCarbon'> 0.0 </p>
		</div>
	</div>
</div>