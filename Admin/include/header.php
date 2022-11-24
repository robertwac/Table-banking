<?php
@session_start();
?>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
<a href="index.php" class="navbar-brand"><i class="fa fa-cube " style="font-size: 30px;"></i>  TABLE <b>  BANKING CHAMA</b></a> 

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
        <form class="d-flex ml-3">
                <div class="input-group">                    
                    <input type="text" class="form-control" placeholder="Search member">
                    <button type="button" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                </div>
            </form>
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
      <a href="#profileModal" class="dropdown-item" data-toggle="modal"><i style="background-color:green; color:white;" class="fa fa-user-o"></i> Profile</a>

          <a href="#resetModal" class="dropdown-item"  data-toggle="modal"><i class="fa fa-angle-right"></i> Reset password</a>
                    <div class="divider dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item"><i style="color: red;" class="material-icons">&#xE8AC;</i> Logout</a>
      </div>
    </li>
    </ul>
  </div>
</nav>

<!---modal -->

    <?php
 
// Check if the user is logged in, otherwise redirect to login page
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST['submitButton'])){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 4){
        $new_password_err = "Password must have atleast 4 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_username = $_SESSION["username"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                 
                header("location:../index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
          //  mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
   // mysqli_close($link);
}
?>
<!-- Modal HTML -->
<div id="resetModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Password reset</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div  class="form-group col-sm-6">
                <label class="text-dark">New Password</label>
                <input type="password"  name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            
            <div class="form-group col-sm-6">
                <label class="text-dark">Confirm Password</label>
                <input type="password"  name="confirm_password"  class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback text-dark "><?php echo $confirm_password_err; ?></span>
            </div>
            </div>
            <b class="text-danger"><small> !!!Note you will be automatically loged out on clicking submit</small></b>
            <div class="modal-footer">
               

                <button type="button"  class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <input type="submit" name="submitButton" class="btn btn-primary" value="Submit">

            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!--user profile modal -->

<div id="profileModal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" style="padding-left: 36%;"><i style="font-size: 96px; color: green;" class="  fa fa-user"></i><br>User Profile</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                 
               <h5 style = "text-transform:capitalize; padding-left: 20%;" class="text-dark"><b>Username : &nbsp;&nbsp;&nbsp;</b><?php echo($_SESSION['username']."<br />");?></h5>
               <?php
               if ($_SESSION["user_type"]==1){
                    echo "<h5><b style = 'text-transform:capitalize; padding-left: 20%;' > Role : </b> &nbsp;&nbsp;Chairperson/Admin</h5>";
                }

               ?>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              
            </div>
        </div>
    </div>
</div>