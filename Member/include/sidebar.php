<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
    .sidebar {
  margin: 0;
  padding: 0;
  width: 220px;
  background-color: black;
  position: fixed;
  height: 100%;
  overflow: auto;

}

.sidebar-list{
  /*background-color: #f0ad4e;*/
}
/* Sidebar links */
.sidebar a {
  display: block;
  color: #996515;
  padding: 16px;
  text-decoration: none;
}

/* Active/current link */
.sidebar a.active {
  background-color: #46C7C7;
  color: #996515;
}
.dropdown-menu :hover {
  color: white;


}

/* Links on mouse-over */
.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

/* Page content. The value of the margin-left property should match the value of the sidebar's width property */
div.content {
  margin-left: 220px;
  padding: 1px 16px;
  height: 630px;


}

/* On screens that are less than 700px wide, make the sidebar into a topbar */
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}
i{
  color: ;
}
/* On screens that are less than 400px, display the bar vertically, instead of horizontally */
@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
  </style>
</head>
 <?php require 'loan_application.php';

       $sql = "SELECT * FROM contributions where member_id='".$_SESSION['id']."'";
                    $result = mysqli_query($link, $sql);
                    if(mysqli_num_rows($result) > 0){
                            $ct=1;}
                            else{
                             $ct=2;
                            }
                   
  ?>
<body>
<!-- The sidebar -->
<div class="sidebar sticky-sidebar" >
<nav id="sidebar" class="bg-warning" >
    
    <div class="sidebar-list">

        <a href="index.php" class="nav-item "><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
        <a href="contribution.php" class="nav-item "><span class='icon-field'><i class="fa fa-usd"></i></span>Contributions</a> 
       
        <a href="payments.php" class="nav-item "><span class='icon-field'><i class=" fa fa-cc-mastercard"></i></span> Payments</a>
<?php if($ct==1){ ?>
  <div class="dropdown">
  <button class="btn bg-warning dropdown-toggle" type="button" data-toggle="dropdown"><span class='icon-field'><i class="fa fa-money"></i></span>  Loans
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li > <a href="#borrowModal" class="nav-item " data-toggle="modal"><i class="fa fa-plus"></i>
      <span class="text-dark">Make Application</span></a> </li>

    <li>   <li> <a href="loan_history.php" class="nav-item"><span class='icon-field'><i class="fa fa-money"></i></span>   <span class="text-dark">View history</span></a></li></li>
 
  </ul>
</div> <?php } ?>
      
    </div>

</nav>
</div>

<!-- Page content -->
<div class="content">

</body>z
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>
</html>
