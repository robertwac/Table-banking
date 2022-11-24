<?php
// Initialize the session
session_start();
 require_once "../public/config.php";
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['username'])==0 ){
    header("location: login.php");
    exit;
}
else{
date_default_timezone_set('Africa/Nairobi');
$currentTime = date( 'd-m-Y h:i:s A', time () );
$successmsg="";
$errormsg= "";
if(isset($_POST['submit']))
{
$username=$_POST['name'];
$email=$_POST['email'];

$query=mysqli_query($link,"UPDATE users set username='$username',email='$email' where username='".$_SESSION['username']."'");
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>

  <body>
     <?php include("include/header.php");
       include("include/sidebar.php");?>
  <section id="container" >

      <section id="main-content">
          <section class="wrapper">
          	<h3 class="text-center"><i class="text-justify fa fa-user  "></i>  Update Profile</h3>
          	
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
 <?php $query=mysqli_query($link,"SELECT * from users where username='".$_SESSION['username']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?>                     

  <h4 class="mb text-capitalize"> &nbsp;&nbsp;<?php echo htmlentities($row['username']);?></h4>
    <h5><b>Joined on :</b>&nbsp;&nbsp;<?php echo htmlentities($row['date_created']);?></h5>
                      <form class="form-horizontal style-form" method="post" name="profile" > 

<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Name</label>
<div class="col-sm-4">
<input type="text" name="name" required="required" value="<?php echo htmlentities($row['username']);?>" class="form-control" >
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
</html>
<?php } ?>
