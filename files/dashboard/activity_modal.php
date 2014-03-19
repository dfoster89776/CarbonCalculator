<?php
	
	session_start();
	require_once("../carbon.php");
	$carbon = new Carbon();	
	$data = $carbon->getActivityData($_POST['id']);

?>

<div class="modal-header">
	<div class="row">
		<div class="col-sm-2">
			<?php
				if($data['carbon']['type'] == "meter_reading"){
					echo("<image src='files/images/icon/icon-meter.png' width='100%'/>");
				}
				elseif ($data['journey']['main_category'] == "car"){
					echo("<image src='files/images/icon/icon-car.png' width='100%'/>");
				}
				elseif ($data['journey']['main_category'] == "motorcycle"){
					echo("<image src='files/images/icon/icon-bike.png' width='100%'/>");
				}
				elseif ($data['journey']['main_category'] == "taxi"){
					echo("<image src='files/images/icon/icon-taxi.png' width='100%'/>");
				}
				elseif ($data['journey']['main_category'] == "coach"){
					echo("<image src='files/images/icon/icon-bus.png' width='100%'/>");
				}
				elseif ($data['journey']['main_category'] == "rail"){
					echo("<image src='files/images/icon/icon-train.png' width='100%'/>");
				}
				elseif ($data['journey']['main_category'] == "plane"){
					echo("<image src='files/images/icon/icon-plane.png' width='100%'/>");
				}
				elseif ($data['journey']['main_category'] == "ferry"){
					echo("<image src='files/images/icon/icon-ferry.png' width='100%'/>");
				}
			?>
		</div>
		<div class="col-sm-9">
			<h3>
			<?php
				if($data['carbon']['type'] == "meter_reading"){
					if($data['meter_reading']['meter_type'] == "gas"){
						echo("Gas Meter Reading");
					}
					elseif($data['meter_reading']['meter_type'] == "electricity"){
						echo("Electricity Meter Reading");
					}
				}
				elseif ($data['journey']['main_category'] == "car"){
					echo("Car Trip");
				}
				elseif ($data['journey']['main_category'] == "motorcycle"){
					echo("Motorcycle Trip");
				}
				elseif ($data['journey']['main_category'] == "taxi"){
					echo("Taxi Ride");
				}
				elseif ($data['journey']['main_category'] == "coach"){
					echo("Coach Trip");
				}
				elseif ($data['journey']['main_category'] == "rail"){
					echo("Rail Journey");
				}
				elseif ($data['journey']['main_category'] == "plane"){
					echo("Flight");
				}
				elseif ($data['journey']['main_category'] == "ferry"){
					echo("Ferry Trip");
				}
			?>
			</h3>
		</div>
		<div class="col-sm-1">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
	</div>
</div>

<div class="modal-body">
	
	<form class="form-horizontal" role="form">
			
	
		<?php 
			if($data['carbon']['type'] == "journey"){
		?>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Journey Date:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php $oDate = new DateTime($data['journey']['journey_date']); echo($oDate->format("l jS F Y"));?></p>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Main Category:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php echo(ucfirst($data['journey']['main_category']));?></p>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Subcategory:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php echo(ucfirst($data['journey']['sub_category']));?></p>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Journey Notes:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php echo($data['journey']['details']);?></p>
				    </div>
				</div>	
				<div class="form-group">
					<label class="col-sm-4 control-label">Distance:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php echo($data['journey']['distance']." km");?></p>
				    </div>
				</div>	
				<div class="form-group">
					<label class="col-sm-4 control-label">Total Carbon Output:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php echo($data['carbon']['carbon_total']." kge CO2");?></p>
				    </div>
				</div>	
		
		<?php	
			}elseif($data['carbon']['type'] == "meter_reading"){
		?>	
			
				<div class="form-group">
					<label class="col-sm-4 control-label">Reading Date:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php $oDate = new DateTime($data['carbon']['date_added']); echo($oDate->format("l jS F Y"));?></p>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Period Covered:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php 	$oDate = new DateTime($data['meter_reading']['reading_start']); echo($oDate->format("jS F Y"));
					      									echo(" - ");
					      									$oDate = new DateTime($data['meter_reading']['reading_end']); echo($oDate->format("jS F Y"));
				      ?></p>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">New Reading:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php echo($data['meter_reading']['reading']);?></p>
				    </div>
				</div>	
				<div class="form-group">
					<label class="col-sm-4 control-label">Total Carbon Output:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php echo(number_format($data['carbon']['carbon_total'], 2)." kge CO2");?></p>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Average Daily Carbon Output:</label>
				    <div class="col-sm-8">
				      <p class="form-control-static"><?php echo(number_format($data['meter_reading']['carbon_per_day'], 2)." kge CO2");?></p>
				    </div>
				</div>
		<?php		
			}
		?>  
	
	</form>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-danger" onclick="deleteActivity(<?php echo($_POST['id'])?>)" id="journey_submit_button">Delete</button>
	<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
</div>