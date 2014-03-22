<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Add Daily Lifestyle</h4>
</div>
<div class="modal-body" id="journey_body">
	
	<div id="stage1">
		<h1> Day </h1>
	</div>
	<div id="stage2" style="display: none">
		<h1> Hot Water Washing </h1>
	</div>
	<div id="stage3" style="display: none">
		<h1> Gas and Electrical Appliances </h1>
	</div>
	<div id="stage4" style="display: none">
		<h1> Cold Water and Bottled Water </h1>
	</div>
	<div id="stage5" style="display: none">
		<h1> Food </h1>
	</div>
	<div id="stage6" style="display: none">
		<h1> Shopping </h1>
	</div>
	<div id="stage7" style="display: none">
		<h1> Recycling </h1>
	</div>
	<div id="stage8" style="display: none">
		<h1> Summary </h1>
	</div>
	
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-success" onclick="nextStage()" id="lifestyle_next_stage">Next</button>
<button type="button" class="btn btn-success" style="display: none;" onclick="submitJourney()" id="lifestyle_submit_button">Submit</button>
</div>