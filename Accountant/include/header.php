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
      <a style="padding-left:39px;" class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
       <?php if($_SESSION["user_type"] == 2){ echo htmlentities('Accountant');}else { echo ('Admin');} ?>
 <i class="fa fa-user-o"></i>
      </a>
      <div class="dropdown-menu dropdown-right">
      <a href="Profile.php" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a>
          <a href="#" class="dropdown-item"><i class="fa fa-angle-right"></i> Reset password</a>
                    <div class="divider dropdown-divider"></div>
          <a href="../public/logout.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a>
      </div>
    </li>
    </ul>
  </div>
</nav>