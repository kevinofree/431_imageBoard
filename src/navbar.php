<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="font-family: 'Press Start 2P', cursive;" href="index.php">GyroChan</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="#">Home</a></li>
        <li><a href="#">Rules</a></li>
        <li><a href="">FAQ</a></li>
        <li><a href="SignUp.php">Register</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Boards <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Anime</a></li>
            <li><a href="#">Food and Cooking</a></li>
            <li><a href="#">Video Games</a></li>
            <li><a href="#">Cars</a></li>
            <li><a href="#">Paranormal</a></li>
            <li><a href="#">Randomness</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        <li><a href="#">Contact</a></li>
      </ul>
      <form class="navbar-form navbar-right" method="post" action="/users/login">
        <div class="form-group">
          <input type="text" placeholder="Username" class="form-control" name="username">
        </div>
        <div class="form-group">
          <input type="password" placeholder="Password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-success">Login</button>
      </form>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<br><br><br><br>
