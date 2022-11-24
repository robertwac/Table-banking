

<?php
// Initialize the session
session_start();
 require_once "../public/config.php";
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['loggedin'])==0 ){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <style>
     body{ font: 14px sans-serif; 
        width: 100%;
        height: 100%; 
        background-image: url("../images/pic8.jpg");
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
<body >

      <?php 
 require_once("include/header.php");
       
 require_once("include/sidebar.php"); 
      $sql= ("SELECT name, email from member where id ='".$_SESSION['id']."'"); 

$result = $link->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
	
  while($row = $result->fetch_assoc()) {

   // echo   '<h6 style="text-transform: capitalize;" class="text-center">Member: ' . $row["name"]. '</h5> <br>' ;
 
  }
} else {
  echo "0 results";
}
//

?>
<h4 class="text-center text-white"><u>Member dashboard</u></h4>
<div  class="jumbotron">
	 <div class="row ml-2 mr-2">
				<div class="col-md-3">
                        <div class="card bg-success text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 ">Members in Numbers</div>
                                        <div class="text-lg font-weight-bold">
                                       <?php 
                                       $sql= "SELECT * FROM member";
                                            $result = mysqli_query($link,$sql);
                                             $rows = mysqli_num_rows($result);
                                             echo  $rows;
                                       ?> 	
                                        		
                                    	</div>
                                    </div>
                                    <i class="fa fa-group"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">Total members</a>
                                <div class="small text-white">
                                	<i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-md-3">
                        <div class="card bg-warning text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Total group contribution</div>
                                        <div class="text-lg font-weight-bold">
                                        	
                                        	       <?php 
                            $sql= "SELECT SUM(amount) as total from contributions ";
                               
$result = mysqli_query($link,$sql);

while ($row = mysqli_fetch_assoc($result))
{ 
   echo $row['total'];
}

                                            ?>
	
                                    	</div>
                                    </div>
                                    <i class="fas fa-donate"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="">Group Contributions</a>
                                <div class="small text-white">
                                	<i class="fas fa-coins"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                  <div class="col-md-3">
                        <div class="card bg-primary text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Contribution </div>
                                        <div class="text-lg font-weight-bold">

<?php
  $sql= "SELECT SUM(amount) as total from contributions where member_id='".$_SESSION["id"]."'";
                               
$result = mysqli_query($link,$sql);

while ($row = mysqli_fetch_assoc($result))
{ 
    if($row['total']){
   echo $row['total'];}
   else echo '0.00';
}

                                            ?>

                                    	</div>
                                    </div>
                                    <i class="fas fa-donate"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="contribution.php">Individual </a>
                                <div class="small text-white">
                                	<i class="fas fa-coins"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="card bg-danger text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Pending loan</div>
                                        <div class="text-lg font-weight-bold">
                                        	
                                        		                   <?php 
                            $sql= "SELECT SUM(amount) as total from loan_list where 
                            borrower_id='".$_SESSION['id']."' && status<4";
                               
$result = mysqli_query($link,$sql);

while ($row = mysqli_fetch_assoc($result))
{ 
    
    if($row['total']){
   echo $row['total'];}
   else echo '0.00';
}



                                            ?>
                                                   
                                    	</div>
                                    </div>
                                    <i class="  fas fa-coins"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                             <a class="small text-white stretched-link" href="loan_history.php">loan history</a>
                               
                            </div>
                        </div>
                    </div>

				</div>
</div>
</body>
<?php// include("../public/footer.php"); ?>

</html>
