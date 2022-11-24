<?php
// Initialize the session
session_start();
 include('include/config.php');
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['username'])==0 ){
    header("location: login.php");
    exit;
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
  
    <style>
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <?php include("include/header.php"); 
 include("include/sidebar.php"); 
    ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h3 class="pull-left text-dark">USERS</h3>
                       <?php if($_SESSION["user_type"] == 1){?>   <a href="#myModal" class="btn  btn-primary pull-right" data-toggle="modal"><i class="fa fa-plus">  </i> Add New user</a>  <?php } ?>
                    </div>
                    <?php
                    $user1="Chairperson";
                    $user2="Accountant";
                    // Attempt select query execution
                    $sql = "SELECT * FROM users";
                  if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table id="#data" class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Username</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Role</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['user_id'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                      echo "<td>" . $row['email'] . "</td>";

                         if($row["user_type"]==1) {  echo "<td>" .$user1. "</td>";
                                        echo "<td>";}
                           if($row["user_type"]==2) {  echo "<td>" .$user2. "</td>";
                                        echo "<td>";}
              
                                            echo '<a href="update_user.php?id='. $row['user_id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete_user.php?id='. $row['user_id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                  
                    ?> 
                </div>
            </div>        
        </div>
    </div>
     
</body>
<script >
      $(document).ready(function(){
        $('#data').DataTable();
      });
  </script>
      
</html>





<!--modal -->
<?php
// Include config file
 
// Define variables and initialize with empty values
$username = $email=$user_type=$password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT user_id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                    
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 4){
        $password_err = "Password must have atleast 4 characters.";
    } else{
        $password = trim($_POST["password"]);
        $email= trim($_POST["email"]);
        $user_type= trim($_POST["usertype"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email,password,user_type) VALUES (?,?,?, ?)";
         

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_username,$param_email, $param_password,$param_usertpye);
            
            // Set parameters
            $param_email= $email;
            $param_usertpye=$user_type;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                        
} else{
    echo 'Unable to send email. Please try again.';
}

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                @header("location:index.php");
                // Redirect to login page
$to = $param_email;
$subject = 'Account creation';
$from = 'robertkimaru1998@gmail.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h4 style="color:#060;">Hi,</h4><p>'.$username.'</p>';
$message .= '<p style="color:#060;font-size:18px;">Your account  for the Table-banking chama was successfully created</p>';
$message .= '<p> your user password is</p><p>'.$password. '</p>';
$message .= '</body></html>'; 
// Sending email
if(mail($to, $subject, $message, $headers)){
   // echo 'Your mail has been sent successfully.';
  

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>

<style>
body {
    color: #fff;
        font-family: 'Roboto', sans-serif;
}
.form-control {
    min-height: 41px;
    box-shadow: none;
    border-color: #ddd;
}
.form-control, .btn {        
    border-radius: 3px;
}
.signup-form {
    width: 450px;
    margin: 0 auto;
    padding: 20px 0;
}
.signup-form form {
    color: #999;
    border-radius: 3px;
    margin-bottom: 15px;
    background: #fff;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.signup-form h2 {
    color: #333;
    font-weight: bold;
    margin-top: 0;
}
.signup-form hr {
    margin: 0 -30px 20px;
}
.signup-form .form-group {
    margin-bottom: 20px;
}
.signup-form label {
    font-weight: normal;
    font-size: 14px;
}
.signup-form input[type="checkbox"] {
    margin-top: 6px;
}    
.signup-form .btn {        
    font-size: 16px;
    font-weight: bold;
 
    border: none;
    min-width: 140px;
}
.signup-form .btn:hover, .signup-form .btn:active {

    outline: none !important;
}
.signup-form a {
    color: #fff;
    text-decoration: underline;
}
.signup-form a:hover {
    text-decoration: none;
}
.signup-form form a {
    color: #3598dc;
    text-decoration: none;
}
.signup-form form a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
    
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               
               <h4 class="text-dark">Add new user</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">


<div class="signup-form">
    <form action="users.php" method="post">
        
        <div class="form-group">
            <label>Username</label>         
             <input type="text" name="username" required="required"class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span> 
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="form-control" name="email" required="required">
        </div>
       <div class="form-group">
            <label for="type">User Type</label>
            <select name="usertype" id="usertype" class="custom-select">
                <option value="1" <?php echo isset($meta['usertype']) && $meta['usertype'] == 1 ? 'selected': '' ?>>Admin</option>
                <option value="2" <?php echo isset($meta['usertype']) && $meta['usertype'] == 2 ? 'selected': '' ?>>Accountant</option>
            </select>
        </div>


        <div class="form-group">
            <label>Password</label>
               <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
               <div class="form-group">
            <button type="submit" class="btn btn-primary btn-md">Create</button>
             <button type="reset" class="btn btn-warning btn-md pull-right">Reset</button>
        </div>
    </form>
</div>
</div>
</div></div></div>
</body>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="sources/css.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>
<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
  <div class="toast" style="position: absolute; top: 0; right: 0;">
    <div class="toast-header">
      <img src="..." class="rounded mr-2" alt="...">
      <strong class="mr-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>