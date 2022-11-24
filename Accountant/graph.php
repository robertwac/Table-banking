
<?php
header('Content-Type: application/json');

$link = mysqli_connect("localhost","root","","table_banking");

$sqlQuery = "SELECT sum(contributions.amount) as amount,member.name FROM contributions 
join member on member.id=contributions.member_id group by member_id ORDER BY amount";

$result = mysqli_query($link,$sqlQuery);

$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

mysqli_close($link);

echo json_encode($data);


?>
