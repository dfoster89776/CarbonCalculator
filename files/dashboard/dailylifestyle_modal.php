<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Add Daily Lifestyle</h4>
</div>
<div class="modal-body" id="journey_body" style="margin-top: -40px;">
	<div id="stage1">
		<div class="page-header">
		  <h1> Date </h1>
		</div>
		<div class="form-horizontal">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Date</label>
		    <div class="col-sm-3">
		      <input type="date" class="form-control" id="inputEmail3" value="<?php echo Date("d/m/Y") ?>">
		    </div>
		  </div>
		</div>
	</div>
	<div id="stage2" style="display: none">
		<div class="page-header">
		  <h1> Hot Water Washing </h1>
		</div>
		<div class="form-horizontal">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Baths</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="hwwBath" value="0" onchange="updateHotWaterWashing()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='hwwBathCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Electric Showers (Normal or Eco-power) (minutes)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="hwwESN" value="0" onchange="updateHotWaterWashing()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='hwwESNCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Electric Showers (POWER) (minutes)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="hwwESP" value="0" onchange="updateHotWaterWashing()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='hwwESPCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Showers (Normal or Eco-Power) from Hot Water System (minutes)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="hwwSN" value="0" onchange="updateHotWaterWashing()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='hwwSNCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Showers (POWER) from Hot Water System (minutes)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="hwwSP" value="0" onchange="updateHotWaterWashing()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='hwwSPCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Wash Hands and Face</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="hwwWHF" value="0" onchange="updateHotWaterWashing()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='hwwWHFCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Wash Clothes by Hand</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="hwwWCH" value="0" onchange="updateHotWaterWashing()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='hwwWCHCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		</div>
		<h4 id="hwwTotalCarbon" class="pull-right"> Total Carbon Output: 0.00 kge CO2 </h4>
	</div>
	<div id="stage3" style="display: none">
		<div class="page-header">
		  <h1> Gas and Electric Appliances </h1>
		</div>
		<div class="form-horizontal">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Gas Cooker (hob use, oven counts as two uses)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaGasCooker" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Electric Cooker (hob use, oven counts as two uses)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaElectricCooker" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaElectricCookerCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Mugs (0.3l) of water in Kettle Boiled</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaKettle" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaKettleCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Laptop (hours)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaLaptop" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaLaptopCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		   <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Desktop PC (Hours)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaDesktop" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaDesktopCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Number of Power Supplies/Chargers plugged in 24/7</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaChargers" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaChargersCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">TV (hours)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaTV" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaTVCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Electric Fire (1kW) (hours)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaElectricFire" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaElectricFireCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Electric Blanket (hours)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaElectricBlanket" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaElectricBlanketCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Energy Efficient Refrigerator (number operating, double number for A vs A+++ rating, 200kWh per year)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaFridge" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaFridgeCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Energy Efficient Lightbulbs On (number X hours) (assume 15W)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaEfficientLighbulb" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaEfficientLighbulbCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Old-Fashioned Light Bulbs On (number X hours) (assume 100W)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaOldLightbulb" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaOldLightbulbCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Wash Clothes in Machine (times) (30-40 C)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaWashingMachine" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaWashingMachineCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Tumble Dryer (times)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaTumbleDryer" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaTumbleDryerCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Hand Wash Dishes (times)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaHandWashDishes" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaHandWashDishesCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Dishwasher (times)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="geaDishwasher" value="0" onchange="updateGasElectricAppliances()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaDishwasherCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		</div>
		<h4 id="geaTotalCarbon" class="pull-right"> Total Carbon Output: 0.00 kge CO2 </h4>
	</div>
	<div id="stage4" style="display: none">
		<div class="page-header">
		  <h1> Cold Water and Bottled Water </h1>
		</div>
		<div class="form-horizontal">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Toilet Flushes</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="cwbwToilet" value="0" onchange="updateColdWaterAndBottledWater()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='cwbwToiletCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		   <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Mugs (0.3 l) of water (electric kettle) boiled</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="cwbwKettle" value="0" onchange="updateColdWaterAndBottledWater()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='cwbwKettleCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Glasses of water</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="cwbwGlassOfWater" value="0" onchange="updateColdWaterAndBottledWater()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='cwbwGlassOfWaterCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Small bottled water (0.5l)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="cwbwSmallBottledWater" value="0" onchange="updateColdWaterAndBottledWater()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='cwbwSmallBottledWaterCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Brushing teeth with running water</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="cwbwBrushTeethRunning" value="0" onchange="updateColdWaterAndBottledWater()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='cwbwBrushTeethRunningCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		   <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Brushing teeth with tap off</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="cwbwBrushTeethNotRunning" value="0" onchange="updateColdWaterAndBottledWater()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='cwbwBrushTeethNotRunningCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		   <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Rinse clothes by hand cold water</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="cwbwRinceClothes" value="0" onchange="updateColdWaterAndBottledWater()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='cwbwRinceClothesCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		</div>
		<h4 id="cwbwTotalCarbon" class="pull-right"> Total Carbon Output: 0.00 kge CO2 </h4>
	</div>
	<div id="stage5" style="display: none">
		<div class="page-header">
		  <h1>Food</h1>
		</div>
		<div class="form-horizontal">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Vegetarian meals ("lacto" includes dairy)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		   <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Vegan meals</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Red-meat based meals</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Poultry based meals</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateMeals()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Fish (sustainable fishing/farming method)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateMeals()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Fish (Non-sustainable fishing/farming method)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateMeals()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Cheese based meals</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateMeals()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Egg based meals</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateMeals()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Dairy products (milk, yogurt)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateMeals()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Bread/cake based meals</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateMeals()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Beer (pints)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateMeals()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Bottles of Wine</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateMeals()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		</div>
		<h4 id="hwwTotalCarbon" class="pull-right"> Total Carbon Output: 0.00 kge CO2 </h4>
	</div>
	<div id="stage6" style="display: none">
		<div class="page-header">
		  <h1>Shopping</h1>
		</div>
		<div class="form-horizontal">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Pounds spent on NEW clothes, electronic goods, books/CDs, consumer goods</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="sPSOG" value="0" onchange="updateShopping()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='sPSOGCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		</div>
		<h4 id="shoppingTotalCarbon" class="pull-right"> Total Carbon Output: 0.00 kge CO2 </h4>
	</div>
	<div id="stage7" style="display: none">
		<div class="page-header">
		  <h1>Recycling</h1>
		</div>
		<div class="form-horizontal">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">No of Aluminum cans bought and recycled (15g)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		   <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">No of Aluminum cans bought but NOT  recycled (15g)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">No of Steel cans recycled (baked beans tin, 20g)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Glass bottles recycled (wine, 0.5 kg)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">kg of paper recycled</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">kg of clothes BOUGHT NEW AND recycled (not necessarily  same items)(Note 6)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">No of Polythene or PET Plastic bottles recycled(25g)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">No of Plastic bags 5g, BOUGHT per week  (NOT RECYCLABLE)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">kg  worth of food WASTED/NOT EATEN/LEFTOVERS WHICH IS  composted (Note6)</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">Recycled electronic waste kg</label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>

		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-6 control-label">kg  landfill  waste per week (NOT RECYCLED) </label>
		    <div class="col-sm-3">
		      <input type="number" class="form-control" id="inputEmail3" value="0" onchange="updateRecycling()">
		    </div>
		    <div class="col-sm-3">
		      <p class='form-control-static' id='geaGasCookerCarbon'> 0.00 kge CO2</p>
		    </div>
		  </div>
		</div>
		<h4 id="hwwTotalCarbon" class="pull-right"> Total Carbon Output: 0.00 kge CO2 </h4>
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