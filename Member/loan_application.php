 <?php

// Initialize the session
@session_start();
 @include('../public/config.php');
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['loggedin'])==0 ){
    header("location: login.php");
    exit;
}


if(isset($_POST['submitBtn']))
{
//if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitBtn'])){
  date_default_timezone_set('Africa/Nairobi');
$date = date('y-m-d h:i:s',time());
$status= 1;
$borrower =  $_SESSION['id'];
$plan= $_POST['plan'];
$type= $_POST['type'];
$amount=$_POST['amt'];
if(!empty($amount)){
$sql="INSERT INTO loan_list (id,type_id,borrower_id,purpose,amount,plan_id,status,date_released,date_borrowed) VALUES ('','$type','$borrower','','$amount','$plan','$status','','$date')";
if(mysqli_query($link, $sql)){
// echo '<script>alert(" sent")</script>';
header('location: index.php');

    
} else{
 
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}

 }


?>

<script>
$(document).ready(function(){
    $(".launch-modal").click(function(){
        $("#borrowModal").modal({
            backdrop: 'static'
        });
    }); 
});
</script>
<!-- modal for loan application form. The php code is on the top-->
<div id="borrowModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">loan application</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body">
                
            <form  method="post" class="form"  ><!--
<label class="col-sm-2 col-sm-2 text-dark control-label">Borrower</label>
<div class="col-sm-8">
<select name="borrower" id="category" class="form-control">
<option  class="text-dark" value="">Select borrower</option>
<?php /*
$sql="SELECT member.*, contributions.amount from member join contributions on member.id=contributions.member_id where amount > 1 group by member_id";
                    // select data and display in drop dowm menu
                    $records=mysqli_query($link,$sql);
                    while ($data=mysqli_fetch_array($records)) {
                      # populating dropdown
                      echo "<option value=".$data['id'].">".$data['name']."</option>";
                    } */
                                        
?>
</select>
</div> -->

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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">