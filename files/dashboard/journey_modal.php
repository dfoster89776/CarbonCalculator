<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Add Journey</h4>
  </div>
  <div class="modal-body" id="journey_body">
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
		<label for='journeyDistance' class='col-md-offset-1 col-md-3 control-label'>Distance</label>
		<div class='col-md-3'>
			<input type='number' class='form-control' id='journeyDistance' placeholder='0' onchange="updateCarbon()">
		</div>
		<div class='col-md-3'>
			<select class="form-control" id="distanceUnits" onchange="updateCarbon()">
			  <option value="km">km</option>
			  <option value="miles">Miles</option>
			</select>
		</div>
	</div>
	<div class='form-group'>
		<label for='journeyConversionRate' class='col-md-offset-1 col-md-3 control-label'>Conversion Rate (per km)</label>
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
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-success" onclick="submitJourney()" id="journey_submit_button">Submit</button>
  </div>