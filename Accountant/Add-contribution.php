<?php
// Include config file
session_start ();
require_once "include/config.php";
 
// Define variables and initialize with empty values
$amount = "";
 $amount_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    

    $input_amount = trim($_POST["amount"]);
    if(empty($input_amount)){
        $amount_err = "Please enter a amount.";
    }  else{
         $member_id  = $_GET['id'];
        $amount = $input_amount;
    }
    
 
     
    // Check input errors before inserting in database
    if(!empty($amount)){
        // Prepare an insert statement
        $sql = "INSERT INTO contributions (amount,member_id) VALUES ( ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_amount, $param_id,);
            echo 'binding';
            // Set parameters
            $param_amount = $amount;
            $param_id = $member_id;
                        
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         echo 'closed';
        // Close statement
       // mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
        .form{
           margin: auto;
width: 60%;
border: 0px solid grey;
padding: 10px;      
  
    background-color: WHITE;
   
    box-shadow: 10px 10px 4px #aaaaaa;
        }
    </style>
</head>
<body>
 <?php include("include/header.php"); 
include("include/sidebar.php");
    ?>

<form method="post"> 

<?php 
$sql = "SELECT name, email FROM member where id='".$_GET['id']."'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
 while($row = $result->fetch_assoc()) {
   // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  $name=$row["name"];
  $email=$row["email"];


}
} else {
  echo "0 results";
}
?>
    <h3 class="text-center text-dark">Add New Contribution</h3>
    <div class="form ">

    <div class="form-group row">
        <label for="Name" class="col-sm-4 col-form-label"> Name</label>
        <div class="col-sm-8">
    <input type="text" readonly class="form-control-plaintext" id="name" value="<?php  echo $name ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="Name" class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-8">
 <input type="text" readonly class="form-control-plaintext" id="name" value="<?php echo    $email ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="amount" class="col-sm-4 col-form-label">Amount Contributed</label>
        <div class="col-sm-10">
            <input type="number" required="cannot  be empty" name="amount" class="form-control" id="amount" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">


<a href="#myModal" class="btn  btn-primary" data-toggle="modal">Save</a>
    
<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Do you want to save the member contribution ?</p>
                <p class="text-secondary"><small>If you don't save, your changes will be lost.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                 <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

           
        </div>
    </div>
</div>
</form>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="sources/css.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

</html>