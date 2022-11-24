<?php
// Include config file
include ("include/config.php");
 
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
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Sign Up Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
    color: #fff;
    background: whitesmoke;
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
    width: 455px;
    margin: 0 auto;
    padding: 30px 0;
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
     <?php 
include('../public/navbar.html');
    ?>
<div class="signup-form">
    <form action="register_admin.php" method="post">
        <h2>Sign Up</h2>
        <p>Please fill in this form to create an account!</p>
        <hr>
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
            <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
             <button type="reset" class="btn btn-danger btn-lg">Reset</button>
        </div>
    </form>
    <div class="text-center">Already have an account? <a href="login.php">Login here</a></div>
</div>
</body>
</html>