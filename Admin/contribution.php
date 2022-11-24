
<?php
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
 <?php include("include/header.php"); 
include("include/sidebar.php");
    ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Members Contributions</h2>
                    </div>
                    <?php
                    // Include config file
                    require_once "include/config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT sum(contributions.amount) as total,contributions.id,member.name,member.contact,member.id as mem_id from contributions
                    JOIN member on contributions.member_id=member.id GROUP BY member.id";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Contribution Id</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Contact</th>";
                                        echo "<th>Amount</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['contact'] . "</td>";
                                        echo "<td>" . $row['total'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read_contributions.php?id='. $row['mem_id'] .'" class="mr-3" title="View Contribution Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                          if($_SESSION["user_type"] == 2){  echo '<a href="Add-contribution.php?id='. $row['mem_id'] .'" class="mr-3" title="New Contribution" data-toggle="tooltip"><span class="fa fa-pen"></span></a>';
                                           }
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
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>