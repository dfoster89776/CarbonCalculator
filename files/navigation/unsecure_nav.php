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
      <li><a href='about.php'>About</a></li>
      
    </ul>
    <form class='navbar-form navbar-right' role='search' action='files/secure/login.php' method='post'>
      <div class='form-group'>
        <input type='text' name='username' class='form-control' placeholder='Username'>
      </div>
      <div class='form-group'>
        <input type='password' name='password' class='form-control' placeholder='Password'>
      </div>
      <button type='submit' class='btn btn-primary'>Login</button>
    </form>    
  </div><!-- /.navbar-collapse -->
</nav>