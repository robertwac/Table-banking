
<?php 
session_start();
  require_once "include/config.php";


if(isset($_POST['submit']))
{
    $amount=$member_id="10";
//$amount= trim($_POST['amount']);
//$member_id = $_GET['id'];

if(empty($member_id)){

$query="INSERT INTO contributions('id', 'amount', 'member_id','date_created') VALUES ('','$amount','$member_id','')";
if(mysqli_query($link, $query)){

  
 echo '$member_id';
header('location: index.php');

    
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
}

}?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
        .form{
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
include("include/sidebar.php");
    ?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 

<?php /*
$sql = "SELECT name, email FROM member where id='".$_GET['id']."'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
 while($row = $result->fetch_assoc()) {
   // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  $name=$row["name"];
  $email=$row["email"];


}
} else {
  echo "0 results";
}*/
?>
    <h3 class="text-center text-dark">Add New Contribution</h3>
    <div class="form">

    <div class="form-group row">
        <label for="Name" class="col-sm-4 col-form-label"> Name</label>
        <div class="col-sm-8">
    <input type="text" readonly class="form-control-plaintext" id="name" value="<?php // echo $name ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="Name" class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-8">
 <input type="text" readonly class="form-control-plaintext" id="name" value="<?php //echo    $email ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="amount" class="col-sm-4 col-form-label">Amount Contributed</label>
        <div class="col-sm-10">
            <input type="number" name= "amount"class="form-control" id="amount" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>
</form>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="sources/css.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
