
<div  class="jumbotron">
	 <div class="row ml-2 mr-2">
				<div class="col-md-3">
                        <div class="card bg-warning text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Borrowers</div>
                                        <div class="text-lg font-weight-bold">
                                       <?php 
                                       $sql= "SELECT * FROM loan_list";
                                            $result = mysqli_query($link,$sql);
                                             $rows = mysqli_num_rows($result);
                                             echo  $rows;
                                       ?> 	
                                        		
                                    	</div>
                                    </div>
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="borrowers.php">View borrowers</a>
                                <div class="small text-white">
                                	<i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-md-3">
                        <div class="card bg-info text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Payments</div>
                                        <div class="text-lg font-weight-bold">
                                        	 <?php 
                                       $sql= "SELECT * FROM payments GROUP BY loan_id";
                                            $result = mysqli_query($link,$sql);
                                             $rows = mysqli_num_rows($result);
                                             echo  $rows;
                                       ?>   
                                        		
                                    	</div>
                                    </div>
                                    <i class="fas fa-donate"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="payments.php">View Payments</a>
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
                                        <div class="text-white-75 small">Borrowed amount</div>
                                        <div class="text-lg font-weight-bold">

                                                <?php 
                            $sql= "SELECT SUM(amount) as total from loan_list";
                               
$result = mysqli_query($link,$sql);

while ($row = mysqli_fetch_assoc($result))
{ 
   echo $row['total'];
}

                                            ?>
                                        	                                    	</div>
                                    </div>
                                    <i class="  far fa-credit-card"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="borrowers.php">View Loan List</a>
                                <div class="small text-white">
                                	<i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="card bg-success text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Total Payments</div>
                                        <div class="text-lg font-weight-bold">
                                        	<?php 
                            $sql= "SELECT SUM(amount) as total from payments";
                               
$result = mysqli_query($link,$sql);

while ($row = mysqli_fetch_assoc($result))
{ 
   echo $row['total'];
}

                                            ?>
                                        		
                                    	</div>
                                    </div>
                                    <i class="  far fa-handshake"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="payments.php">View payments List</a>
                                <div class="small text-white">
                                	<i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

				</div>
</div>