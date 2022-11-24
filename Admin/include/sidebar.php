<?php 
include_once 'include/config.php';                                    
     $sql= "SELECT * FROM loan_list where status=1";
     $result = mysqli_query($link,$sql);
     $rows = mysqli_num_rows($result);
      $applications = $rows;
 ?> 
 <?php 
                                    
     $sql= "SELECT * FROM loan_list where status=2";
     $result = mysqli_query($link,$sql);
     $rows = mysqli_num_rows($result);
      $approved = $rows;
 ?> 
 <?php 
                                    
     $sql= "SELECT * FROM loan_list where status=3";
     $result = mysqli_query($link,$sql);
     $rows = mysqli_num_rows($result);
      $released = $rows;
 ?>
  <?php 
                                    
     $sql= "SELECT * FROM loan_list where status=4";
     $result = mysqli_query($link,$sql);
     $rows = mysqli_num_rows($result);
      $paid = $rows;
 ?>
<!DOCTYPE html>

<head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <title></title>
  <style type="text/css">
    .sidebar {
   margin: 0;
  padding: 0;
  width: 220px;
  background-color: black;
  position: absolute;
  height: 100%;
  overflow: auto;

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
  background-color: whitesmoke;


}
.dropbtn {
  background-color: #000;
  color: #000;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 308px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
  background-color: wheat;
}
.dropbtn:hover{
  background-color: yellow;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: yellow;
  border: none;

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

<body>
<!-- The sidebar -->
<div class="sidebar sticky-sidebar" >
<nav id="sidebar" class='mx-lt-5 bg-warning' >
    
    <div class="sidebar-list">
   <a href="index.php" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a> 
   <a href="Members.php" class="nav-item nav-loans"><span class='icon-field'><i class="fa fa-group"></i></span> Members</a> 
     <a href="contribution.php" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-book"></i></span>Contribution</a>
    
        <div class="dropdown bg-warning">
  <button type="button" class="dropbtn bg-warning"><span class='icon-field'><i class="  fas fa-chart-line"></i>    <span class="text-dark">Manage Payments</span></button>
  <div class="dropdown-content">
    <a href="payments.php" class="nav-item nav-payments"><span class='icon-field'><i class="  fas fa-balance-scale-right"></i></span> Make payment <span class="badge badge-warning"><?php echo $released ?></span></a></a>
     <a href="settledpayments.php"  class="nav-item nav-borrowers "><span class='icon-field'><i class="fas fa-balance-scale"></i></span> Settled loans <span class="badge badge-success"><?php echo $paid ?></span></a> </a>

  </div>
</div>
        

<div class="dropdown bg-warning">
  <button type="button" class="dropbtn bg-warning"><span class='icon-field'><i class="fas fa-cash-register"></i>    <span class="text-dark">Manage borrowers</span></button>
  <div class="dropdown-content">
    <a href="borrowers.php"  class="nav-item nav-borrowers "><span class='icon-field'><i class="fas fa-comment-dollar"></i></span> Applications <span class="badge badge-danger"><?php echo $applications ?></span></a>
     <a href="approved_applications.php"  class="nav-item nav-borrowers "><span class='icon-field'><i class=" fas fa-comments-dollar"></i></span> Approved <span class="badge badge-info"><?php echo $approved ?></span></a>
     <a href="released_loans.php"  class="nav-item nav-borrowers "><span class='icon-field'><i class=" fas fa-hand-holding-usd"></i></span> Released <span class="badge badge-success"><?php echo $released ?></span></a>
  </div>
</div>

       
        <a href="loan_plan.php" class="nav-item nav-plan"><span class='icon-field'><i class="fa fa-list-alt"></i></span> Loan Plans</a> 
        <a href="loan_type.php" class="nav-item nav-loan_type"><span class='icon-field'><i class="fa fa-th-list"></i></span> Loan Types</a>  
        <?php if($_SESSION["user_type"] == 1){?>  
        <a href="users.php" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
        <?php } ?>
      
    </div>

</nav>
</div>

<!-- Page content -->
<div class="content">

</body>
</html>
