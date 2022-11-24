<?php
session_start();
 require_once "../public/config.php";
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['loggedin'])==0 ){
    header("location: login.php");
    exit;
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
<body>
    <?php 
  include("include/header.php"); 
include("include/sidebar.php");
    ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h4 class="text-center text-dark"><u>Your borrowings</u></h4>
                      
                    </div>
                    <form id="#data">
                    <?php
 

                    
                    // Attempt select query execution
                    // query to join for tables...loan_list, loan_plan, loan_type and member tables
                     $sql = "SELECT  loan_list.id as loan_id,loan_list.amount,loan_list.borrower_id,loan_list.date_borrowed,member.*, loan_plan.*,loan_type.* FROM loan_list
join member on member.id=loan_list.borrower_id 
join loan_plan on  loan_plan.id=loan_list.plan_id
join loan_type on loan_type.type_id=loan_list.type_id  where borrower_id='".$_SESSION['id']."'
";

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped table-dark" id ="loan-list">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Personal Details</th>";
                                        echo "<th>Borrowed Amt</th>";
                                        echo "<th>Interest</th>";
                                        echo "<th>Amount payable</th>";
                                        echo "<th>Duration</th>";
                                        echo "<th>Borrowed date</th>";
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
                                        echo "<td>" . $row['months'] . "( months)</td>";
                                        echo "<td>" . $row['date_borrowed'] . "</td>";
                                       
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