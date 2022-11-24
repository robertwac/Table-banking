
<?php
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

$member_id =  $_POST['user_id'];
$loan_id= $_POST['name'];
$amount=$_POST['amt'];
if(!empty($amount)){
$sql="INSERT INTO payments (member_id,amount,date_paid,loan_id) 
VALUES ('$member_id','$amount','$date','$loan_id')";
if(mysqli_query($link, $sql)){
// echo '<script>alert(" sent")</script>';
header('location: payments.php');

    
} else{
 
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}

 }


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
  <?php 
include("include/header.php"); 
include("include/sidebar.php");
    ?>
<body>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h4 class="text-center text-dark">Settled Payments Details</h4>
                 
                    </div>
                    <form id="#data">
                    <?php                    
                    // Attempt select query execution
$sql = "SELECT sum(p.amount) as payment, p.pay_id,p.loan_id,l.borrower_id,l.amount as loan,concat(m.name,', -',m.contact)as name from payments p inner join loan_list l on l.id = p.loan_id inner join member m on m.id = l.borrower_id WHERE
p.amount <= l.amount && status=4 GROUP by l.id  ";

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Details</th>";
                                        echo "<th>Borrowed Amt</th>";                                      
                                        echo "<th>Amount paid</th>";
                                        echo "<th>Charges</th>";
                                         echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                        //            require_once 'calculate.php';
                        
                        //calculating interest using the compound interest
                    $balance =   -($row['loan'] - $row['payment']);
                     //$id = $row['borrower_id'];

                                    echo "<tr>";
                                    
                                        echo "<td>"  .$row['name']. "</td>";
                                        echo "<td>Ksh : " . $row['loan'] . "</td>";
                                        echo "<td>Paid : " . $row['payment'] . "</td>";
                                        echo "<td> (" . $balance . ")</td>";
                                        echo "<td>";
                                         echo '<a href="read_payment.php?id='. $row['loan_id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                          echo "</td>";
                                                                                 
                            echo "</tr>";

                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-info"><em>No  payment found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
                    </form>
    </div>





<body>
   


</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</html>