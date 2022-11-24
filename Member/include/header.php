<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
<a href="#" class="navbar-brand"><i class="fa fa-cube"></i>TABLE <b>  BANKING</b></a> 

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse " id="collapsibleNavbar">
    <ul class="navbar-nav navbar-dark ml-auto">
      <li class="nav-item">
        
      </li>
      </li>
            <li class="nav-item dropdown">
      <a style="margin-right:2px;" class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
       <?php 
       echo "{$_SESSION["email"]}"; ?>
 <i class="fa fa-user-o"></i>
      </a>
      <div class="dropdown-menu dropdown-right">
      <a href="Profile.php" class="dropdown-item"><i  style="background-color:green; color: white; " class="fa fa-user-o"></i> Profile</a>
          <a href="password-reset.php" class="dropdown-item"><i class="fa fa-angle-right"></i> Reset password</a>
                    <div class="divider dropdown-divider"></div>
          <a href="../public/logout.php" class="dropdown-item"><i style="color:red" class="material-icons">&#xE8AC;</i> Logout</a>
      </div>
    </li>
    </ul>
  </div>
</nav>