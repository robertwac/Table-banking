<?php
// Initialize the session
session_start();
 include('include/config.php');
// Check if the user is logged in, if not then redirect him to login page
if(strlen($_SESSION['username'])==0 ){
    header("location: login.php");
    exit;
}

 if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}
// check if the submit button is clicked
 if(isset($_POST["submit"]))  
 {
 $months="";
 $interest_percentage="";
 $penalty_rate="";       

$months=trim($_POST["months"]);
$interest_percentage=trim($_POST["interest_percentage"]);
$penalty_rate=trim($_POST["penalty_rate"]);
//insert records
$sql = "INSERT INTO loan_plan (months,interest_percentage,penalty_rate)
VALUES ('$months','$interest_percentage','$penalty_rate')";

if (mysqli_query($link, $sql)) {
 // echo "New record created successfully";
       header("location: loan_plan.php");
        exit();
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
}




include("include/header.php"); 
  include("include/sidebar.php");

?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="loan_plan.php" method="post">
				<div class="card">
					<div class="card-header">
						  <h4 class="text-center"> Loan plan </h4>
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Plan (in months)</label>
								<input type="number" name="months" id="" class="form-control text-right">
							</div>
							<div class="form-group">
								<label class="control-label">Interest</label>
								<div class="input-group">
								  <input type="number" step="any" min="0" max="100" class="form-control text-right" name="interest_percentage" aria-label="Interest">
								  <div class="input-group-append">
								    <span class="input-group-text">%</span>
								  </div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Monthly Over due Penalty</label>
								<div class="input-group">
								  <input type="number" step="any" min="0" max="100" class="form-control text-right" aria-label="Penalty percentage" name="penalty_rate" required>
								  <div class="input-group-append">
								    <span class="input-group-text">%</span>
								  </div>
								</div>
							</div>
							
							
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<input type="submit" name="submit" value="submit" class="btn btn-primary">
								<input type="reset" name="reset" value="CLear" class="btn btn-danger pull-right">
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Plan</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$plan = $link->query("SELECT * FROM loan_plan order by id asc");
								while($row=$plan->fetch_assoc()):
									$months = $row['months'];
									$months = $months / 12;
									if($months < 1){
										$months = $row['months']. " months";
									}else{
										$m = explode(".", $months);
										$months = $m[0] . " yrs.";
										if(isset($m[1])){
											$months .= " and ".number_format(12 * ($m[1] /100 ),0)."month/s";
										}
									}
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p>Years/Month: <b><?php echo $months ?></b></p>
										 <p><small>Interest: <b><?php echo $row['interest_percentage']."%" ?></b></small></p>
										 <p><small>Over dure Penalty: <b><?php echo $row['penalty_rate']."%" ?></b></small></p>
									</td>
									<td class="text-center">
										 <button class="btn btn-sm btn-success edit_plan" type="button" data-id="<?php echo $row['id'] ?>" data-months="<?php echo $row['months'] ?>" data-interest_percentage="<?php echo $row['interest_percentage'] ?>" >Edit</button>
										<a href="<?php echo 'delete_plan.php?id='. $row['id'] .'"' ?>"><button class="btn btn-sm btn-warning  pull-right" type="button" data-id="<?php echo $row['id'] ?>">Delete</button></a>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<?php include("include/footer.php"); ?>
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