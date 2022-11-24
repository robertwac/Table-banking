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
 if(isset($_POST["Submit1"]))  
 {
 $name="";
 $description="";       

$name=trim($_POST["type_name"]);
$description=trim($_POST["description"]);
//insert records
$sql = "INSERT INTO loan_type (type_name, description)
VALUES ('$name', '$description')";

if (mysqli_query($link, $sql)) {
 // echo "New record created successfully";
       header("location: loan_type.php");
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


			<form action="loan_type.php" method="post" >
				<div class="card">
					<div class="card-header">
						   Loan Type Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Type</label>
								<textarea name="type_name" required="cannot be empty" id="type_name" cols="30" rows="2" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea name="description" required id="description" cols="30" rows="2" class="form-control"></textarea>
							</div>
							
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<input type="submit" name="Submit1" class="btn btn-primary col-sm-3">
								<input type="reset" name="CLear" value="Clear" class="btn btn-danger col-sm-3 pull-right">
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
									<th class="text-center">Loan Type</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$types = $link->query("SELECT * FROM loan_type order by type_id asc");
								while($row=$types->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									
									<td class="">
										 <p><b>Type Name: </b><?php echo $row['type_name'] ?></p>
										 <p><small><b>Description:</b> <?php echo $row['description'] ?></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-success " type="button" data-id="<?php echo $row['type_id'] ?>" data-type_name="<?php echo $row['type_name'] ?>" data-description="<?php echo $row['description'] ?>" >Edit</button>
									<a href="<?php echo 'delete_type.php?id='. $row['type_id'] .'"' ?>">	<button class="btn btn-sm btn-warning delete_ltype" type="button" data-id="<?php echo $row['type_id'] ?>">Delete</button>
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
