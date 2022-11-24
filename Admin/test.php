
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
header('location: test.php');

    
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
<body>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Payments Details</h2>
                  <a href="#payModal" class="btn btn-success pull-right" data-toggle="modal"><i class="fa fa-plus"></i> Add New Payment</a>
                    </div>
                    <form id="#data">
                    <?php                    
                    // Attempt select query execution
$sql = "SELECT sum(p.amount) as payment, p.pay_id,l.amount,concat(m.name,', -',m.email,'- ',m.contact)as name from payments p inner join loan_list l on l.id = p.loan_id inner join member m on m.id = l.borrower_id where l.amount > p.amount  GROUP by p.loan_id  ";

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Details</th>";
                                        echo "<th>Borrowed Amt</th>";                                      
                                        echo "<th>Amount paid</th>";
                                        echo "<th>bal</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                        //            require_once 'calculate.php';
                        
                        //calculating interest using the compound interest
                     $balance =    $row['amount'] - $row['payment'];

                                    echo "<tr>";
                                    
                                        echo "<td>"  .$row['name']. "</td>";
                                        echo "<td>Ksh : " . $row['amount'] . "</td>";
                                        echo "<td>Paid : " . $row['payment'] . "</td>";
                                        echo "<td> (" . $balance . ")</td>";

                                            echo "<td>";
                                            echo '<a href="read.php?id='. $row['pay_id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update_application.php?id='. $row['pay_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                            
                                        echo "</td>";
                                       
                            echo "</tr>";

                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-info"><em>No payment found.</em></div>';
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





<body>
   

<div id="payModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add payment</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="test.php">
    <div class="container">
        <div class="col-md-6">
            <label class="control-label">Payee Name</label>
<select  name="user_id" id="user_id" class="form-control" onblur ="GetDetail(this.value)" value="" >
<option  class="text-dark" value="">Select Name</option>
<?php 
$sql="SELECT  loan_list.amount,loan_list.id as loan_id, member.* from loan_list join member on loan_list.borrower_id=member.id ";
                    // select data and display in drop dowm menu
                    $records=mysqli_query($link,$sql);
                    while ($data=mysqli_fetch_array($records)) {
                      # populating dropdown
                      echo "<option value=".$data['id'].">".$data['name']."</option>";
                    }
                                        
?>
</select>
<input type="hidden" name="loan_id">
<input type="hidden" name="member_id">
</div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Loan Id:</label>
                    <input type="text" name="name"
                        id="name" class="form-control"
                        placeholder=''
                        value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Amount borrowed:</label>
                    <input type="text" name="amount"
                        id="amount" class="form-control"
                        placeholder='ksh'
                        value="" disabled>
                </div>

            </div>
        </div>

         <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Amount paid:</label>
                    <input type="number" name="amt"
                        id="amt" class="form-control"
                        placeholder='ksh'
                        value="" >
                </div>
                
            </div>
        </div>
    </div>


         <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
   
</div>
</div>
</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                 <button type="submit" name="submitBtn" class="btn btn-primary">Submit</button>
            

            </div>
        </div></form>
    </div>
</div>
    <script>

        // onkeyup event will occur when the user
        // release the key and calls the function
        // assigned to this event
        function GetDetail(str) {
            if (str.length == 0) {
                document.getElementById("name").value = "";
                document.getElementById("amount").value = "";
                return;
            }
            else {

                // Creates a new XMLHttpRequest object
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {

                    // Defines a function to be called when
                    // the readyState property changes
                    if (this.readyState == 4 &&
                            this.status == 200) {
                        
                        // Typical action to be performed
                        // when the document is ready
                        var myObj = JSON.parse(this.responseText);

                        // Returns the response data as a
                        // string and store this array in
                        // a variable assign the value
                        // received to first name input field
                        
                        document.getElementById
                            ("name").value = myObj[0];
                        
                        // Assign the value received to
                        // last name input field
                        document.getElementById(
                            "amount").value = myObj[1];
                    }
                };

                // xhttp.open("GET", "filename", true);
                xmlhttp.open("GET", "request.php?user_id=" + str, true);
                
                // Sends the request to the server
                xmlhttp.send();
            }
        }
    </script>

</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</html>