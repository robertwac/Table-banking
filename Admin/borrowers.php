 <?php

// Initialize the session
session_start();
 include('include/config.php');
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['username'])==0 ){
    header("location: login.php");
    exit;
}


if(isset($_POST['submitBtn']))
{
//if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitBtn'])){
  date_default_timezone_set('Africa/Nairobi');
$date = date('y-m-d h:i:s',time());
$status= 1;
$borrower =  $_POST['borrower'];
$plan= $_POST['plan'];
$type= $_POST['type'];
$amount=$_POST['amt'];
if(!empty($amount)){
$sql="INSERT INTO loan_list (id,type_id,borrower_id,purpose,amount,plan_id,status,date_released,date_borrowed) VALUES ('','$type','$borrower','','$amount','$plan','$status','','$date')";
if(mysqli_query($link, $sql)){
// echo '<script>alert(" sent")</script>';
header('location: borrowers.php');

    
} else{
 
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}

 }


?>
<?php
  include("include/header.php"); 
include("include/sidebar.php");
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 1100px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 90px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Borrower Details</h2>
                        <a href="#borrowModal" class="btn btn-success pull-right" data-toggle="modal"><i class="fa fa-plus"></i> Add New Application</a>
                    </div>
                    <form id="#data">
                    <?php
 

                    
                    // Attempt select query execution
                    // query to join for tables...loan_list, loan_plan, loan_type and member tables
                     $sql = "SELECT  loan_list.id as loan_id,loan_list.amount,loan_list.borrower_id,loan_list.date_borrowed,member.*, loan_plan.*,loan_type.* FROM loan_list
join member on member.id=loan_list.borrower_id 
join loan_plan on  loan_plan.id=loan_list.plan_id
join loan_type on loan_type.type_id=loan_list.type_id  where loan_list.status = 1
";

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped" id ="loan-list">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Details</th>";
                                        echo "<th>Borrowed Amt</th>";
                                        echo "<th>Interest</th>";
                                        echo "<th>Amount payable</th>";
                                        echo "<th>Duration</th>";
                                        echo "<th>Borrowed date</th>";
                                        
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                        //            require_once 'calculate.php';
                        
                        //calculating interest using the compound interest
                        $amount1 = $row['amount'] * pow((1 + $row['interest_percentage']/100),$row['months']);
                        
                        $interest = number_format($amount1 - $row['amount']);
                        $amount1 =number_format($amount1);
                                    echo "<tr>";
                                    
                                        echo "<td>"  .$row['name']. '<br>'.$row['email']."</td>";
                                        echo "<td>Ksh : " . $row['amount'] . "</td>";
                                        echo "<td>Interest : " . $interest . "</td>";
                                        echo "<td> Ksh : " . $amount1 . "</td>";
                                        echo "<td>" . $row['months'] . "</td>";
                                        echo "<td>" . $row['date_borrowed'] . "</td>";
                                       
                                       
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update_application.php?id='. $row['loan_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                            
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-info"><em>No loan applications found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                   // mysqli_close($link);
                    ?>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>





<!-- modal for loan application form. The php code is on the top-->
<div id="borrowModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">loan application</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body">
                
            <form  method="post" class="form"  >
<label class="col-sm-2 col-sm-2 text-dark control-label">Borrower</label>
<div class="col-sm-8">
<select name="borrower" id="category" class="form-control">
<option  class="text-dark" value="">Select borrower</option>
<?php 
$sql="SELECT member.*, contributions.amount from member join contributions on member.id=contributions.member_id where amount > 1 group by member_id";
                    // select data and display in drop dowm menu
                    $records=mysqli_query($link,$sql);
                    while ($data=mysqli_fetch_array($records)) {
                      # populating dropdown
                      echo "<option value=".$data['id'].">".$data['name']."</option>";
                    }
                                        
?>
</select>
</div>

<label class="col-sm-6 col-sm-2 text-dark control-label">Plan(months)</label>
<div class="col-sm-6">
<select name="plan" id="plan" class="form-control">
<option  class="text-dark" id="time"value="">Select plan(months)</option>
<?php 
$sql="SELECT * from loan_plan ORDER BY months ";
                    // select data and display in drop dowm menu
                    $records=mysqli_query($link,$sql);
                    while ($data=mysqli_fetch_array($records)) {
                      # populating dropdown
                      echo "<option value=".$data['id'].">".$data['months']."</option>";

                    }
                                        
?>
</select>

</div>


<label class="col-sm-4 col-sm-4 text-dark control-label">Loan type</label>
<div class="col-sm-6">
<select name="type" id="category" class="form-control" required>
<option  class="text-dark" value="">Select type</option>
<?php 
$sql="SELECT * from loan_type ";
                    // select data and display in drop dowm menu
                    $records=mysqli_query($link,$sql);
                    while ($data=mysqli_fetch_array($records)) {
                      # populating dropdown
                      echo "<option value=".$data['type_id'].">".$data['type_name']."</option>";
                    }
                                        
?>
</select>
</div>
<div class="form inline">
<label class="col-sm-4 col-sm-4 text-dark control-label">Amount</label>
<div class="col-sm-6">
  <input type="number" class="form-control" name="amt" id="amount"required>
  <br>
  <button type="button" name="button1" class="btn btn-success pull-right" id="calculate">calculate</button>         
</div>

                </div>
         
            </div>
            <div id="demo1">
        <b><p class="text-success" style="margin-left: 30px;" id="demo"> </p></b>
                </div>      
<div class="modal-footer">



<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
<input type="submit" name="submitBtn" class="btn btn-primary">
</div>
</form>

            </div>




        </div>
    </div>
</div>

<script> 

    document.getElementById("calculate").addEventListener("click", function() {
     var  y = document.getElementById("amount").value;
      var x =document.getElementById("plan").value;
      const principal = y;
 
const time = x;
const rate = .02;
const n = 1;
const compoundInterest = (p, t, r, n) => {
   const amount = p * (Math.pow((1 + (r / n)), (n * t)));
   const interest = Math.floor(amount - p);
   return interest;
};
var z = compoundInterest(principal, time, rate, n);

        document.getElementById("demo").innerHTML = ("Interest: "  + z  +  "  Amount : "  +  y  +   "  Time(months) : "+time);
       
});

</script>

   
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js">
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</html>