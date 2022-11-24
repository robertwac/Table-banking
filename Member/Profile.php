<?php
// Initialize the session
session_start();
 require_once "../public/config.php";
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['loggedin'])==0 ){
    header("location: login.php");
    exit;
}
else{
date_default_timezone_set('Africa/Nairobi');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
$successmsg="";
$errormsg= "";
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$email=$_POST['email'];

$query=mysqli_query($link,"UPDATE member set name='$name',email='$email' where id='".$_SESSION['id']."'");
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
<style>
     body{ font: 14px sans-serif; 
        width: 100%;
        height: 100%; 
        background-image: url("../images/pic7.jpg");
        background-color: black;
        background-size: cover;

        background-repeat: no-repeat;
        background-position: 10% 10%;
        
         }
.wrapper{
    width: 900px;
            margin: 0 auto;
            background-color: whitesmoke;}
</style>
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
 <?php $query=mysqli_query($link,"SELECT * from member where id='".$_SESSION['id']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?>                     

  <h4 class="mb text-capitalize"> &nbsp;&nbsp;<?php echo htmlentities($row['name']);?></h4>
    <h5><b>Joined on :</b>&nbsp;&nbsp;<?php echo htmlentities($row['date_created']);?></h5>
                      <form class="form-horizontal style-form" method="post" name="profile" >

<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Name</label>
<div class="col-sm-4">
<input type="text" name="name" required="required" value="<?php echo htmlentities($row['name']);?>" class="form-control" >
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
