<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
	require_once("../carbon.php");
	$carbon = new Carbon();	
	$data['currentEnergy'] = $carbon->energyCarbonThisMonth();
	$data['previousEnergy'] = $carbon->energyCarbonLastMonth();
	@$data['percentageEnergy'] = round(($data['previousEnergy'] - $data['currentEnergy'])/$data['previousEnergy']*100);
	$data['currentTransport'] = $carbon->transportCarbonThisMonth();
	$data['previousTransport'] = $carbon->transportCarbonLastMonth();
	$data['currentTotal'] = $data['currentEnergy'] + $data['currentTransport'];
	$data['previousTotal'] = $data['previousEnergy'] + $data['previousTransport'];
	@$data['percentageTransport'] =  round(($data['previousTransport'] - $data['currentTransport'])/$data['previousTransport']*100);
	@$data['percentageTotal'] = round(($data['previousTransport'] - $data['currentTransport'])/$data['previousTransport']*100);
?>

<div class="row" style="border-bottom-style:solid; border-bottom-width: 1px; border-bottom-color: lightgrey;">
	<div class="col-xs-4 col-xs-offset-4 col-sm-offset-3" style="text-align: center">
	<h3> Last Month</h3>
	<h1 id="carbonTotalLastMonth" style="@media (min-width: @screen-md-min) {font-size: 80px;} text-align: center;"><?php echo $data['previousTotal']; ?></h1>
	</div>
	<div class="col-xs-4" style="text-align: center">
	<h3> This Month </h3>
	<h1 id="carbonTotalThisMonth" style="@media (min-width: @screen-md-min) {font-size: 80px;} text-align: center; <?php if($data['currentTotal'] > $data['previousTotal']){
			echo("color: red;");	
		}else{
			echo("color: green;");
		}?>"><?php echo $data['currentTotal']; ?></h1>
	
	</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-3">
		<h4> Energy <small>kge CO2</small></h4>
	</div>
	<div class="col-xs-4" style="text-align: center; font-size: 20px;">
		<h4 style="font-weight: normal;"><?php echo $data['previousEnergy']; ?></h4>
	</div>
	<div class="col-xs-4" style="text-align: center">
		<h4 style="font-weight: normal;<?php if($data['currentEnergy'] > $data['previousEnergy']){
			echo("color: red;");	
		}else{
			echo("color: green;");
		}?>"><?php echo $data['currentEnergy']; ?></h4>
	</div>
	<div class="col-xs-1 hidden-xs hidden-sm" style="text-align: right;">
		<h4 style="font-weight: normal;<?php if($data['currentEnergy'] > $data['previousEnergy']){
			echo("color: red;");	
		}else{
			echo("color: green;");
		}?>"><?php echo $data['percentageEnergy'];?>%</h4>
	</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-3">
		<h4> Journeys <small>kge CO2</small> </h4>
	</div>
	<div class="col-xs-4" style="text-align: center">
		<h4 style="font-weight: normal;"><?php echo $data['previousTransport']; ?></h4>
	</div>
	<div class="col-xs-4" style="text-align: center">
		<h4 style="font-weight: normal;<?php if($data['currentTransport'] > $data['previousTransport']){
			echo("color: red;");	
		}else{
			echo("color: green;");
		}?>"><?php echo $data['currentTransport']; ?></h4>
	</div>
	<div class="col-xs-1 hidden-xs hidden-sm" style="text-align: right;">
		<h4 style="font-weight: normal;<?php if($data['currentTransport'] > $data['previousTransport']){
			echo("color: red;");	
		}else{
			echo("color: green;");
		}?>"><?php echo $data['percentageTransport'] ?>%</h4>
	</div>
	
</div>

  