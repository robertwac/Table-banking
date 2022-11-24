<?php
session_start();
 include('include/config.php');
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['username'])==0 ){
    header("location: login.php");
    exit;
}
      include("include/header.php"); 
include_once 'include/sidebar.php';
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

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h4 class="text-center">Payment Details</h4>
                    </div>
                    <?php
             
                  
                    
                    // Attempt select query execution
                    $sql = "SELECT payments.*, member.*,loan_list.date_borrowed from payments join member on member.id = payments.member_id
                      JOIN loan_list on loan_list.id=payments.loan_id
                     where loan_id= '".$_GET['id']."'";
                    
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Pay.No</th>";
                                        echo "<th>Name</th>";
                                         echo "<th>Date borrowed</th>";
                                        echo "<th>Date paid</th>";
                                        echo "<th>Amount paid (Ksh)</th>";
                                                                            echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                $total = 0;
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['pay_id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['date_borrowed'] . "</td>";
                                        echo "<td>" . $row['date_paid'] . "</td>";
                                        echo "<td>" . $row['amount'] . "</td>";
                                                                        
                                    echo "</tr>";
                                    $total += $row['amount'];
                                } 
                                echo "</tbody>";  
                                echo "</tfooter>";
                                 echo '<td colspan=4 style="font-weight: bold;" > Total: </td>';
                                 echo "<td> <u>" .$total. "</u></td>";
                                 echo "</tfooter>";                         
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
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
    </div>
</body>
</html>