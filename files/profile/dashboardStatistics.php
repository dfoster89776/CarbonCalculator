<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
	$profile = $_SESSION['profile'];
	
	require_once("../carbon.php");
	$carbon = new Carbon();	
	
	//ENERGY
	$data['currentEnergy'] = $carbon->friendsEnergyCarbonThisMonth($profile);
	$data['previousEnergy'] = $carbon->friendsEnergyCarbonLastMonth($profile);
	
	//TRANSPORT
	$data['currentTransport'] = $carbon->friendsTransportCarbonThisMonth($profile);
	$data['previousTransport'] = $carbon->friendsTransportCarbonLastMonth($profile);
	
	//LIFESTYLE STATISTICS
	$data['currentLifestyle'] = $carbon->friendsLifestyleCarbonThisMonth($profile);
	$data['previousLifestyle'] = $carbon->friendsLifestyleCarbonLastMonth($profile);
	@$data['percentageLifestyle'] =  round(($data['previousLifestyle'] - $data['currentLifestyle'])/$data['previousLifestyle']*100);
	$data['currentLifestyleOffset'] = $carbon->friendsLifestyleCarbonOffsetThisMonth($profile);
	$data['previousLifestyleOffset'] = $carbon->friendsLifestyleCarbonOffsetLastMonth($profile);
	
	$data['currentTotal'] = $data['currentEnergy'] + $data['currentTransport'] + $data['currentLifestyle'] - $data['currentLifestyleOffset'];
	$data['previousTotal'] = $data['previousEnergy'] + $data['previousTransport'] + $data['previousLifestyle'] - $data['previousLifestyleOffset'];
	@$data['percentageTotal'] = round(($data['previousTransport'] - $data['currentTransport'])/$data['previousTransport']*100);
?>

<h3 class='page-header'>Overview</h3>
<div class="well">
<div class="row " style="border-bottom-style:solid; border-bottom-width: 1px; border-bottom-color: lightgrey;">
	<div class="col-sm-4 col-sm-offset-3" style="text-align: center">
	<h3> Last Month</h3>
	<h1 id="carbonTotalLastMonth" style="font-size: 80px; text-align: center;"><?php echo $data['previousTotal']; ?></h1>
	</div>
	<div class="col-sm-4" style="text-align: center">
	<h3> This Month </h3>
	<h1 id="carbonTotalThisMonth" style="font-size: 80px; text-align: center; <?php if($data['currentTotal'] > $data['previousTotal']){
			echo("color: red;");	
		}else{
			echo("color: green;");
		}?>"><?php echo $data['currentTotal']; ?></h1>
	</div>
</div>
<div class="row">
	<div class="col-sm-3">
		<h4> Energy <small>(kge CO2)</small></h4>
	</div>
	<div class="col-sm-4" style="text-align: center; font-size: 20px;">
		<h4 style="font-weight: normal;"><?php echo $data['previousEnergy']; ?></h4>
	</div>
	<div class="col-sm-4" style="text-align: center">
		<h4 style="font-weight: normal;<?php if($data['currentEnergy'] > $data['previousEnergy']){
			echo("color: red;");	
		}else{
			echo("color: green;");
		}?>"><?php echo $data['currentEnergy']; ?></h4>
	</div>
</div>
<div class="row">
	<div class="col-sm-3">
		<h4> Journeys <small>kge CO2</small> </h4>
	</div>
	<div class="col-sm-4" style="text-align: center">
		<h4 style="font-weight: normal;"><?php echo $data['previousTransport']; ?></h4>
	</div>
	<div class="col-sm-4" style="text-align: center">
		<h4 style="font-weight: normal;<?php if($data['currentTransport'] > $data['previousTransport']){
			echo("color: red;");	
		}else{
			echo("color: green;");
		}?>"><?php echo $data['currentTransport']; ?></h4>
	</div>
</div>
<div class="row">
	<div class="col-sm-3">
		<h4> Lifestyle <small>kge CO2</small> </h4>
	</div>
	<div class="col-sm-4" style="text-align: center">
		<h4 style="font-weight: normal;"><?php echo $data['previousLifestyle']; ?></h4>
	</div>
	<div class="col-sm-4" style="text-align: center">
		<h4 style="font-weight: normal;<?php if($data['currentLifestyle'] > $data['previousLifestyle']){
			echo("color: red;");	
		}else{
			echo("color: green;");
		}?>"><?php echo $data['currentLifestyle']; ?></h4>
	</div>
</div>
</div>