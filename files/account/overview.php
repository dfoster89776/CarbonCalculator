<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
	if(file_exists("../carbon.php")){
		require_once("../carbon.php");
	}else{
		require_once("files/carbon.php");
	}

	$carbon = new Carbon();
	
	$data = $carbon->getOverviewDetails();
	
	
	
?>
<div class="panel panel-default">
  <div class="panel-heading">Account Overview</div>
  <div class="panel-body">
	<form class="form-horizontal" role="form">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Username:</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo $data['username']; ?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Firstname:</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo $data['firstname']; ?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Surname:</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo $data['surname']; ?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Email:</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo $data['email']; ?></p>
	    </div>
	  </div>
	   <div class="form-group">
	    <label class="col-sm-2 control-label">Join Date:</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo $data['join_date']; ?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Last Login:</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo $data['last_login']; ?></p>
	    </div>
	  </div>
	 </form>
  </div>
</div>