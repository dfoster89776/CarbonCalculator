<?php
	if (!isset($_SESSION['teacher'])){
		$_SESSION['teacher'] = $carbon->getTeacherStatus();
	}
?>

<nav class='navbar navbar-default navbar-inverse navbar-fixed-top' role='navigation'>
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class='navbar-header'>
    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
      <span class='sr-only'>Toggle navigation</span>
      <span class='icon-bar'></span>
      <span class='icon-bar'></span>
      <span class='icon-bar'></span>
    </button>
    <a class='navbar-brand' href='http://drf8.host.cs.st-andrews.ac.uk/Carbon/dashboard.php'>Carbon Calculator</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class='collapse navbar-collapse navbar-ex1-collapse '>
    <ul class='nav navbar-nav'>
      <li><a href='http://drf8.host.cs.st-andrews.ac.uk/Carbon/dashboard.php'>Profile</a></li>
      <li><a href='http://drf8.host.cs.st-andrews.ac.uk/Carbon/social.php'>Social</a></li>
      <li><a href='http://drf8.host.cs.st-andrews.ac.uk/Carbon/setup.php'>Setup</a></li>
      <?php if ($_SESSION['teacher']){
	      echo ("<li><a href='http://drf8.host.cs.st-andrews.ac.uk/Carbon/teaching.php'>Teaching</a></li>");
      }?>
    </ul>
	<ul class='nav navbar-nav navbar-right' >
		<li class='dropdown'>
    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
      <?php echo "Logged in as ".$carbon->getUsersName()?> 
      <b class='caret'></b>
    </a>
    <ul class='dropdown-menu navbar-right'>
      <li><a href='http://drf8.host.cs.st-andrews.ac.uk/Carbon/account.php'>Account</a></li>
      <li><a href='http://drf8.host.cs.st-andrews.ac.uk/Carbon/files/secure/logout.php'>Logout</a></li>
    </ul>
  </li>
	</ul>
  
	
    
  </div><!-- /.navbar-collapse -->
  
</nav>