<?php
// Initialize the session
session_start();
 include('include/config.php');
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['username'])==0 ){
    header("location: login.php");
    exit;
}

date_default_timezone_set('Africa/Nairobi');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
$successmsg="";
$errormsg= "";
$username="";
$email="";
if(isset($_POST['submit']))
{
$username=$_POST['username'];
$email=$_POST['email'];

$query=mysqli_query($link,"UPDATE users set username='$username',email='$email' where user_id='".$_GET['id']."'");
if($query)
{
$successmsg="Profile Successfully Updated !!";
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
  </head>

  <body>
     <?php include("include/header.php");
       include("include/sidebar.php");?>
  <section id="container" >

      <section id="main-content">
          <section class="wrapper">
            <h3 class="text-center"><i class="text-justify fa fa-user  "></i>  Update User Profile</h3>
            
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
 <?php $query=mysqli_query($link,"SELECT * from users where user_id='".$_GET['id']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?>                     

  <h4 class="mb text-capitalize text-center"> &nbsp;&nbsp;<?php echo htmlentities($row['username']);?></h4>
    <h5>Created on :&nbsp;&nbsp;<?php echo htmlentities($row['date_created']);?></h5>
                      <form class="form-horizontal style-form" method="post" name="profile" >

<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">username</label>
<div class="col-sm-4">
<input type="text" name="username" required="required" value="<?php echo htmlentities($row['username']);?>" class="form-control" >
 </div>
   
<label class="col-sm-2 col-sm-2 control-label">User Email </label>
 <div class="col-sm-4">
<input type="email" name="email" required="required" value="<?php echo htmlentities($row['email']);?>" class="form-control">
</div>
 </div>


</div>

<?php } ?>

                          <div class="form-group">
                           <div class="col-sm-10" style="padding-left:25% ">
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
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

