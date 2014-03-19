<div id="alerts"></div>

<div id="subscribedClasses">
	  <?php require_once("subscribedClasses.php"); ?>
</div>

<!-- Button trigger modal -->
<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#classModal" style="width: 100%">
  Add New Class
</button>

<!-- Modal -->
<div class="modal fade" id="classModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
 	<?php require_once("classModal.php"); ?>
 	 
 </div><!-- /.modal -->

<script>