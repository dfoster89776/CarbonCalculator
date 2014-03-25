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
				elseif($data['carbon']['type'] == "lifestyle"){
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
				elseif($data['carbon']['type'] == "lifestyle"){
					echo("Daily Lifestyle");
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
			}elseif($data['carbon']['type'] == "lifestyle"){
		?>  
				<div style="margin-bottom: 30px">
					<h4> Date:  <div class="pull-right"> <?php echo round($data['lifestyle']['date'] , 2)?></div></h4>
					<h4> Total Carbon Output: <div class="pull-right"><?php echo round($data['lifestyle']['lifestyleTotal'],2)?></div></h4>
				</div>
		
				<div class="panel-group" id="accordion">
				  <div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				          Hot Water Washing <div class="pull-right"><?php echo round($data['lifestyle']['HotWaterWashingTotal'] , 2)?>  kge CO2</div>
				        </a>
				      </h4>
				    </div>
				    <div id="collapseOne" class="panel-collapse collapse">
				      <div class="panel-body">
						  <div class="row">
				      		<div class="col-xs-7">Baths</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['bath'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Electric Showers (Normal or Eco-power)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['esnap'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Electric Showers (POWER)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['esp'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Showers (Normal or Eco-Power) from Hot Water System</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['snep'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Showers (POWER) from Hot Water System</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['sp'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Wash Hands and Face</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['whaf'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Wash Clothes by Hand</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['wch'] , 2)?> kge CO2</div>
				      	</div>
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
				          Gas and Electric Appliances <div class="pull-right"><?php echo round($data['lifestyle']['gasElectricAppliancesTotal'] , 2)?>  kge CO2</div>
				        </a>
				      </h4>
				    </div>
				    <div id="collapseTwo" class="panel-collapse collapse">
				      <div class="panel-body">
				      	<div class="row">
				      		<div class="col-xs-7">Gas Cooker</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['gasCooker'] , 2)?> kge CO2</div>
				      	</div>
				        <div class="row">
				      		<div class="col-xs-7">Electric Cooker</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['electricCooker'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Mugs (0.3l) of water boiled in kettle</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['kettle1'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Laptop</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['laptop'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Desktop PC</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['desktop'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Power Supplies/Chargers</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['chargers'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">TV</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['tv'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Electric Fire (1kW)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['electricFire'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Electric Blanket</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['electricBlanket'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Energy Efficient Refrigerator</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['fridge'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Energy Efficient Lightbulbs</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['energyEfficientLightbulb'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Old-Fashioned Light Bulbs</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['traditionalLight'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Wash Clothes in Machine</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['washingMachine'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Tumble Dryer</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['tumbleDryer'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Hand Wash Dishes</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['handWashDishes'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Dishwasher</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['dishwasher'] , 2)?> kge CO2</div>
				      	</div>
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
				          Cold Water and Bottled Water <div class="pull-right"><?php echo round($data['lifestyle']['coldWaterBottledWaterTotal'] , 2)?>  kge CO2</div>
				        </a>
				      </h4>
				    </div>
				    <div id="collapseThree" class="panel-collapse collapse">
				      <div class="panel-body">
				        <div class="row">
				      		<div class="col-xs-7">Toilet Flushes</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['toilet'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Mugs (0.3 l) of water (electric kettle) boiled</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['kettle2'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Glasses of water</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['glassOfWater'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Small bottled water (0.5l)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['bottledWater'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Brushing teeth with running water</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['brushTeethTapOn'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Brushing teeth with tap off</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['brushTeethTapOff'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Rinse clothes by hand cold water</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['rinseClothes'] , 2)?> kge CO2</div>
				      	</div>
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
				          Food <div class="pull-right"><?php echo round($data['lifestyle']['foodTotal'] , 2)?>  kge CO2</div>
				        </a>
				      </h4>
				    </div>
				    <div id="collapseFour" class="panel-collapse collapse">
				      <div class="panel-body">
				        <div class="row">
				      		<div class="col-xs-7">Vegetarian Meals</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['vegetarian'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Vegan Meals</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['vegan'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Red-Meat Based Meals</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['redMeat'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Poultry Based Meals</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['poultry'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Fish (sustainable fishing/farming method)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['fishSus'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Fish (Non-sustainable fishing/farming method)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['fishUnsus'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Cheese based meals</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['cheese'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Egg Based Meals</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['egg'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Dairy products (milk, yogurt)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['dairy'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Bread/cake based meals</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['bread'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Beer (pints)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['beer'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Bottles of Wine</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['wine'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Packaging factor: Supermarket Meals (packaged) (50g plastic)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['packaging'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Transport factor: Local/Garden/Farmers Market Meals (food miles)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['transport'] , 2)?> kge CO2</div>
				      	</div>
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
				          Shopping <div class="pull-right"> <?php echo round($data['lifestyle']['consumerGoods'] , 2)?> kge CO2</div>
				        </a>
				      </h4>
				    </div>
				    <div id="collapseFive" class="panel-collapse collapse">
				      <div class="panel-body">
				      	<div class="row">
				      		<div class="col-xs-7">Pounds spent on NEW clothes, electronic goods, books/CDs, consumer goods</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['consumerGoods'] , 2)?> kge CO2</div>
				      	</div>
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
				          Recycling <div class="pull-right"> <?php echo round($data['lifestyle']['recyclingTotal'] , 2)?> kge CO2</div>
				        </a>
				      </h4>
				    </div>
				    <div id="collapseSix" class="panel-collapse collapse">
				      <div class="panel-body">
				        <div class="row">
				      		<div class="col-xs-7">Aluminum cans bought and recycled (15g)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['aluminiumCansRecycled'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Aluminum cans bought but NOT  recycled (15g)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['aluminiumCansNotRecycled'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Steel cans recycled (baked beans tin, 20g)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['steelCansRecycled'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Glass bottles recycled (wine, 0.5 kg)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['glassBottlesRecycled'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Paper Recycled</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['paperRecycled'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Clothes Bought New and Recycled</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['clothesRecycled'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Polythene or PET Plastic bottles recycled(25g)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['plasticBottlesRecycled'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Plastic bags (5g) (Not Recyclable)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['plasticBagsNotRecycled'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Food Wasted/Not Eaten/Leftovers Which Is Composted</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['foodWasteRecycled'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Recycled Electronic Waste</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['electronicWaste'] , 2)?> kge CO2</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-7">Landfill Waste (Not Recycled)</div>
				      		<div class="col-xs-5" style="text-align: right"><?php echo round($data['lifestyle']['landfillWaste'] , 2)?> kge CO2</div>
				      	</div>
				      </div>
				    </div>
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