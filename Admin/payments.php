
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

$member_id =   $_POST['member_id'];
$loan_id= $_POST['name'];
$amount=$_POST['amt'];
if(!empty($amount)){
$sql="INSERT INTO payments (member_id,amount,date_paid,loan_id) 
VALUES ('$member_id','$amount','$date','$loan_id')";
if(mysqli_query($link, $sql)){
echo '<script>alert(" sent")</script>';
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
                        <h2 class="pull-left">Payments Details</h2>
                  <a href="#payModal" class="btn btn-success pull-right" data-toggle="modal"><i class="fa fa-plus"></i> Add New Payment</a>
                    </div>
                    <form id="#data">
                    <?php                    
                    // Attempt select query execution
$sql = "SELECT sum(p.amount) as payment, p.pay_id,p.loan_id,l.borrower_id,l.plan_id,l.id,l.amount as loan,concat(m.name,', -',m.email)as name,loan_plan.* from payments p inner join loan_list l on l.id = p.loan_id inner join member m on m.id = l.borrower_id join loan_plan on loan_plan.id =l.plan_id WHERE
p.amount <= l.amount && status=3 GROUP by l.id  ";

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Details</th>";
                                        echo "<th>Owed amount</th>";                                      
                                        echo "<th>Amount paid</th>";
                                        echo "<th>bal</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                        //            require_once 'calculate.php';
                           //         CREATE VIEW dividends as SELECT loan_list.amount as loan,loan_list.id, loan_list.status,payments.amount as payments,member.name FROM loan_list JOIN payments ON loan_list.id=payments.loan_id JOIN member on member.id=payments.member_id GROUP BY loan_list.id
                        
                        //calculating interest using the compound interest
                      //calculating interest using the compound interest
                        $amount1 = $row['loan'] * pow((1 + $row['interest_percentage']/100),$row['months']);
                        
                        $interest = number_format(($amount1 - $row['payment']),2);
                        $amount1=number_format($amount1,2);

                     $balance =    $amount1 - $row['payment'];
                     $balance=number_format($balance);
                     $id = $row['loan_id'];
if ($balance <= 0 ){
$query=mysqli_query($link,"UPDATE loan_list set status='4' where id= $id");

}

                                    echo "<tr>";
                                    
                                        echo "<td>"  .$row['name']. "</td>";
                                        echo "<td>Ksh : " . ceil($amount1). "</td>";
                                        echo "<td>Paid : " .number_format($row['payment'],2) . "</td>";
                                        echo "<td> (" .number_format($balance,2) . ")</td>";

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
                            echo '<div class="alert alert-info"><em>No ongoing payment found.</em></div>';
                            echo '<button class="btn btn primary" ><a href="settledpayments.php">View Settled payments </a></button>';
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
                <form method="post" action="payments.php">
    <div class="container">
        <div class="col-md-6">
            <label class="control-label">Payee Name</label>
<select  name="user_id" id="user_id" class="form-control" onblur ="GetDetail(this.value)" value="" required >
<option  class="text-dark" value="" selected="selected" >Select Name</option>
<?php 
$sql="SELECT  loan_list.amount,loan_list.id as loan_id, member.* from loan_list join member on loan_list.borrower_id=member.id where status=3 ";
                    // select data and display in drop dowm menu
                    $records=mysqli_query($link,$sql);
                    while ($data=mysqli_fetch_array($records)) {
                      # populating dropdow
                      echo "<option value=".$data['loan_id'].">".$data['name']."</option>";
                 echo "<input type=hidden name=member_id value=".$data['id'].">";
                    }
                                        
?>
</select>
    
</div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Loan Id:</label>
                    <input type="text" name="name"
                        id="name" class="form-control"
                        placeholder='L.No:'
                        value="" >
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