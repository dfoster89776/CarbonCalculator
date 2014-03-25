<h3 class='page-header'>Histogram</h3>
<div class="well">
	<div class="btn-group" data-toggle="buttons">
	  <label class="btn btn-success active">
	    <input id="energyCheck" type="checkbox" onchange="updateGraph()" checked> Energy
	  </label>
	  <label class="btn btn-success active">
	    <input id="transportCheck" type="checkbox" onchange="updateGraph()" checked> Transport
	  </label>
	  <label class="btn btn-success active">
	    <input id="lifestyleCheck" type="checkbox" onchange="updateGraph()" checked> Lifestyle
	  </label>
	</div>
	
	<div class="btn-group pull-right" data-toggle="buttons">
	  <label class="btn btn-success">
	    <input type="radio" name="options" id="option1" value="7days" onchange="updateGraph()"> 7 Days
	  </label>
	  <label class="btn btn-success">
	    <input type="radio" name="options" id="option2" value="5weeks" onchange="updateGraph()"> 1 Month
	  </label>
	  <label class="btn btn-success active">
	    <input type="radio" name="options" id="option3" value="6months" onchange="updateGraph()" checked> 6 Months
	  </label>
	</div>


	<div id="chart_div" style="height: 500px; margin-top: 20px"><div style="text-align: center; padding-top: 100px;"><img src='files/images/loading.gif' id='loading-indicator'></div></div>
</div>