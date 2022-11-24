<?php
// Initialize the session
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
            width: 150px;
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
                        <h2 class="text-center"><u>Your Payments</u></h2>
                 
                    </div>
                    <form id="#data">
                    <?php                    
                    // Attempt select query execution
$sql = "SELECT sum(p.amount) as payment, p.pay_id,p.loan_id,l.borrower_id,l.plan_id,l.id,l.amount as loan,concat(m.name,', -',m.email)as name,loan_plan.* from payments p inner join loan_list l on l.id = p.loan_id inner join member m on m.id = l.borrower_id join loan_plan on loan_plan.id =l.plan_id WHERE
p.amount <= l.amount && status >2 && borrower_id='".$_SESSION['id']."' GROUP by l.id order by status desc ";

$row["status"]="";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Details</th>";
                                        echo "<th>Owed amount</th>";                                      
                                        echo "<th>Amount paid</th>";
                                        echo "<th>bal</th>";
                                        echo "<th>Status</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                        //            require_once 'calculate.php';
                           //         CREATE VIEW dividends as SELECT loan_list.amount as loan,loan_list.id, loan_list.status,payments.amount as payments,member.name FROM loan_list JOIN payments ON loan_list.id=payments.loan_id JOIN member on member.id=payments.member_id GROUP BY loan_list.id
                        
                        //calculating interest using the compound interest
                      //calculating interest using the compound interest
                        $amount1 = $row['loan'] * pow((1 + $row['interest_percentage']/100),$row['months']);
                        
                        $interest = ceil($amount1 - $row['payment']);
                        $amount1=ceil($amount1);

                     $balance =    $amount1 - $row['payment'];
                     $id = $row['loan_id'];

                                    echo "<tr>";
                                    
                                        echo "<td>"  .$row['name']. "</td>";
                                        echo "<td>Ksh : " .number_format($amount1,2). "</td>";
                                        echo "<td>Paid : " . number_format($row['payment'],2) . "</td>";
                                        echo "<td> (" . number_format($balance,2) . ")</td>";
                     if($balance>0){
                        echo '<td><button type="button"class="btn bg-warning"><p class="text-light">Pending ...</p></button></td>';
                     }
                    else
                       echo '<td><button type="button"class="btn bg-success"><P class="text-light">Fully paid</P></button></td>';
                                     
                                       
                            echo "</tr>";

                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-info"><em>You have no payments.</em></div>';
                          
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                   // mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
                    </form>
    </div>





</body>
</div></div></div></body></html>
   