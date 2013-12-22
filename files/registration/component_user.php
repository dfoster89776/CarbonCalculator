<div class='page-header'>
	<h1>Registration <small>User Details</small></h1>
</div>

<div class='progress'>
	<div class='progress-bar' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 0%;'>
		<span class='sr-only'>0% Complete</span>
	</div>
</div>

<br class='hidden-xs hidden-sm'/>

<div id='alerts'> </div>

<br class='hidden-xs hidden-sm'/>

<div class='form-horizontal; role='form'>
	<div class='form-group' id='inputUsernameDiv'>
		<label for='inputUsername' class='col-md-offset-1 col-md-3 control-label'>Username</label>
		<div class='col-md-6'>
			<input type='email' class='form-control' id='inputUsername' placeholder='Username' onkeyup='checkUsername()'  onchange='checkUsername()'>
		</div>
	</div>
	<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>
	<div class='form-group' id='inputEmailDiv'>
		<label for='inputEmail1' class='col-md-3 col-md-offset-1 control-label'>Email</label>
		<div class='col-md-6'>
			<input type='email' class='form-control' id='inputEmail1' placeholder='Email' onkeyup='validateEmail()' onchange='validateEmail()'>
		</div>
	</div>
	<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>
	<div class='form-group' id='inputPasswordDiv'>
		<label for='inputPassword1' class='col-md-3 col-md-offset-1 control-label'>Password</label>
		<div class='col-md-6'>
			<input type='password' class='form-control' id='inputPassword1' placeholder='Password' onkeyup='checkPasswordStrength()' onchange='checkPasswordStrength()'>
		</div>
	</div>
	<br class='hidden-xs hidden-sm'/><br class='hidden-xs hidden-sm'/>
	<div class='form-group' id='inputPassword2Div'>
		<label for='inputPassword2' class='col-md-3 col-md-offset-1 control-label'>Re-type Password</label>
		<div class='col-md-6'>
			<input type='password' class='form-control' id='inputPassword2' placeholder='Re-type Password' onkeyup='checkPasswordMatch()' onchange='checkPasswordMatch()'>
		</div>
	</div>
</div>

<br class='hidden-xs'/><br class='hidden-xs'/><br class='hidden-xs'/>

<div class='row' style='text-align: right'>
	<div class='col-md-offset-8 col-md-2'>
		<button class='btn-primary  btn btn-block' style='min-width: 100%' onclick='submitLoginDetails()'>Continue</button>
	</div>
</div>

<br/><br/>