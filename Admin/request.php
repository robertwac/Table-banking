<?php

// Get the user id
$user_id = $_REQUEST['user_id'];

// Database connection
include('include/config.php');
$name='';
$amount='';
if ($user_id !== "") {
    
    // Get corresponding first name and
    // last name for that user id  
    $sql="SELECT *  FROM  to_pay  WHERE loanid='".$user_id."'"; 
    $query = mysqli_query($link, $sql);

   // $row = mysqli_fetch_array($query);
      while($row = mysqli_fetch_array($query)){
    // Get the first name
    $name = $row["loanid"];

    // Get the first name
    $amount = $row["amount"];
    $plan_id = $row["plan_id"];
    $plan_interest=$row["interest_percentage"];
    $plan_penalty;


} }
// Store it in a array
$result = array("$name", "$amount","$plan_id","$plan_interest");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>
