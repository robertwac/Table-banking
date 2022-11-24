<?php
// Initialize the session
session_start();
 include('include/config.php');
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['username'])==0 ){
    header("location: login.php");
    exit;
}
$b_id= $_GET['id'];
date_default_timezone_set('Africa/Nairobi');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
$successmsg="";
$errormsg= "";
$username="";
$email="";

if(isset($_POST['submitbtn']) && $_SERVER["REQUEST_METHOD"] == "POST")
{
$status=$_POST['status'];
$amount=$_POST['amount'];
$id=$_POST['id'];
$query=mysqli_query($link,"UPDATE loan_list set status='$status',amount='$amount' where id= $id");
if($query)
{
$successmsg="Profile Successfully Updated !!";
header("location: borrowers.php");
}
else
{
$errormsg="Profile not updated !!";
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title> User </title>
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" /> 
    <style type="text/css">
      
.wrapper{
margin: auto;
width: 60%;
border: 0px solid grey;
padding: 10px;      
  
    background-color: WHITE;
   
    box-shadow: 10px 10px 4px #aaaaaa;
  }

    </style>
  </head>

  <body>
     <?php include("include/header.php");
       include("include/sidebar.php");?>
  <section id="container" >

      <section id="main-content">
          <section class="wrapper">
            <h3 class="text-center"><i class="text-justify fa fa-user  "></i>  Update loan application</h3>
            
            <!-- BASIC FORM ELELEMNTS -->
            
            <div class="row mt">
                <div class="col-lg-12">
                  <div class="form-panel">
                    

                      <?php if($successmsg)
                      {?>
                      <div class="alert alert-success alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>Well done!</b> <?php echo htmlentities($successmsg);?></div>
                      <?php }?>

   <?php if($errormsg)
                      {?>
                      <div class="alert alert-danger alert-dismissable">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>Oh snap!</b> </b> <?php echo htmlentities($errormsg);?></div>
                      <?php }?>
 <?php $query=mysqli_query($link,"SELECT loan_list.id as loan_id,loan_list.borrower_id,loan_list.amount,loan_list.date_borrowed,member.name FROM loan_list JOIN member on loan_list.borrower_id=member.id where loan_list.id='".$_GET['id']."' && status<3");
 while($row=mysqli_fetch_array($query)) 
 {
 ?>                     

  <h4 class="mb text-capitalize text-center">Applicant name:  &nbsp;&nbsp;<?php echo htmlentities($row['name']);?></h4>
    <p class="text-lg">Application made on :&nbsp;&nbsp;<?php echo htmlentities($row['date_borrowed']);?></p>
          <form class="form-horizontal style-form" id="form" method="post" name="profile"   >

<div class="form-group">
<label class="col-md-2 col-md-2 control-label">Amount Borrowed: </label>
<div class="col-md-3">
<input type="number" name="amount"  required="required" value="<?php echo htmlentities($row['amount']);?>" class="form-control" >
 </div>
   <div class="form-group">
<label for="status" class="control-label">  Update loan status:  </label>
<div class="col-md-8">
<select name="status" id="status" class="form-control col-md-4">
  <option  class="text-dark" selected value="">Select status</option>
  <option value="1" class="form-control">Keep-pending</option>
  <option value="2" class="form-control">Approve</option>
  <option value="3" class="form-control">Release</option>
  
</select>
</div> </div>
<input type="hidden" name="id" value="<?php echo htmlentities ($_GET['id']); ?>">
 </div>


</div>

<?php } ?>

                          <div class="form-group">
                           <div class="col-sm-10" style="padding-left:25% ">
<button type="submit" name="submitbtn" class="btn btn-primary">Submit</button>
</div>
</div>

                          </form>
                          </div>
                          </div>
                          </div>
                          
            
            
        </section>
      </section>
    <?php include("include/footer.php");?>
  </section> 
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="sources/css.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>

