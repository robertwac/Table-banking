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
        <a href="contribution.php" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-book"></i></span>Contribution</a>
        <a href="index.php?page=loans" class="nav-item nav-loans"><span class='icon-field'><i class="fa fa-file"></i></span> Loans</a> 
        <a href="index.php?page=payments" class="nav-item nav-payments"><span class='icon-field'><i class="fa fa-money"></i></span> Payments</a>
        <a href="index.php?page=borrowers" class="nav-item nav-borrowers"><span class='icon-field'><i class="fa fa-users"></i></span> Borrowers</a>
        <a href="index.php?page=plan" class="nav-item nav-plan"><span class='icon-field'><i class="fa fa-list-alt"></i></span> Loan Plans</a> 
        <a href="../Admin/loan_type.php" class="nav-item nav-loan_type"><span class='icon-field'><i class="fa fa-th-list"></i></span> Loan Types</a>  
        <?php if($_SESSION["user_type"] == 1){?>  
        <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
        <?php } ?>
      
    </div>

</nav>
</div>

<!-- Page content -->
<div class="content">

</body>
</html>
