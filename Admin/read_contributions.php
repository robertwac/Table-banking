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
            width: 180px;
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
                        <h4 class="text-center">Contributions Details</h4>
                    </div>
                    <?php
             
                  
                    
                    // Attempt select query execution
                    $sql = "SELECT contributions.amount, contributions.id as c_id, contributions.date_created as date, member.* from contributions join member on member.id = contributions.member_id where member_id= '".$_GET['id']."'";
                    
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-stripped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>C.No</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>  Date </th>";
                                        echo "<th>Amount contributed (Ksh)</th>";
                                                                            echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                $total = 0;
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['c_id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['amount'] . "</td>";
                                                                        
                                    echo "</tr>";
                                    $total += $row['amount'];
                                } 
                                echo "</tbody>";  
                                echo "</tfooter>";
                                 echo "<td colspan=3> Total: </td>";
                                 echo "<td>" .$total. "</td>";
                                 echo "</tfooter>";                         
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No  contribution records  found.</em></div>';
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