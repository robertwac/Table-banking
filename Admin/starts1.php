<style type="text/css">
    i{
        color: ;
        font-weight: bold;
    }
</style>
<h4 class="text-center"><u>Admin dashboard</u></h4>

<div  class="jumbotron">
	 <div class="row ml-2 mr-2">
				<div class="col-md-3">
                        <div class="card bg-success text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Members</div>
                                        <div class="text-lg font-weight-bold">
                                       <?php 
                                       $sql= "SELECT * FROM member";
                                            $result = mysqli_query($link,$sql);
                                             $rows = mysqli_num_rows($result);
                                             echo  $rows;
                                       ?> 	
                                        		
                                    	</div>
                                    </div>
                                    <i class="fa fa-cube"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="members.php">View members</a>
                                <div class="small text-white">
                                	<i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

      <div class="col-md-3">
                        <div class="card bg-secondary text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Total Contributions</div>
                                        <div class="text-lg font-weight-bold">
                                            <?php 
                            $sql= "SELECT SUM(amount) as total from contributions";
                               
$result = mysqli_query($link,$sql);

while ($row = mysqli_fetch_assoc($result))
{ 
   echo $row['total'];
}

                                            ?>
                                                
                                        </div>
                                    </div>
                                    <i class="fas fa-coins"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="contribution.php">View contributions</a>
                                <div class="small text-white">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-md-3">
                        <div class="card bg-info text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Interests and Charges</div>
                                        <div class="text-lg font-weight-bold">
                                        	
                                  <?php 
                            $sql= "SELECT SUM(amount) as total from loan_list where status=4";
                               
$result = mysqli_query($link,$sql);

while ($row = mysqli_fetch_assoc($result))
{ 
   $x=$row['total'];
}


                $sql= "SELECT SUM(amount) as payment from payments";
                               
$result = mysqli_query($link,$sql);

while ($row = mysqli_fetch_assoc($result))
{ 
   $y= $row['payment'];
}
echo $y-$x;
                                  
                                            ?>
                                                   
                                    	</div>
                                    </div>
                                    <i class="fab fa-gg-circle"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">Shared as dividends </a>
                                <div class="small text-white">
                                	<i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                  <div class="col-md-3">
                        <div class="card bg-danger text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Active Loans</div>
                                        <div class="text-lg font-weight-bold">

 <?php 
                                    
     $sql= "SELECT * FROM loan_list where status=3";
     $result = mysqli_query($link,$sql);
     $rows = mysqli_num_rows($result);
    echo  $released = $rows;
 ?>
                                    	</div>
                                    </div>
                                    <i class="  fas fa-money-check-alt"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Loan List</a>
                                <div class="small text-white">
                                	<i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
               

				</div>
</div>