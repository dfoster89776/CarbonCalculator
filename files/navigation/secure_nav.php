<nav class='navbar navbar-default navbar-inverse navbar-fixed-top' role='navigation'>
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class='navbar-header'>
    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
      <span class='sr-only'>Toggle navigation</span>
      <span class='icon-bar'></span>
      <span class='icon-bar'></span>
      <span class='icon-bar'></span>
    </button>
    <a class='navbar-brand' href='index.php'>Carbon Calculator</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class='collapse navbar-collapse navbar-ex1-collapse '>
    <ul class='nav navbar-nav'>
      <li><a href='dashboard.php'>Profile</a></li>
      <li><a href='#'>Social</a></li>
      <li><a href='setup.php'>Setup</a></li>
    </ul>
	<ul class='nav navbar-nav navbar-right' >
		<li class='dropdown'>
    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
      <?php echo "Logged in as ".$carbon->getUsersName()?> 
      <b class='caret'></b>
    </a>
    <ul class='dropdown-menu navbar-right'>
      <li><a href='account.php#home'>Account</a></li>
      <li><a href='files/secure/logout.php'>Logout</a></li>
    </ul>
  </li>
	</ul>
  
	
    
  </div><!-- /.navbar-collapse -->
  
</nav>