<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   RIDE SHARE </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="entercar.php">Add Car</a></li>
              <li> <a href="enterdriver.php"> Add Driver</a></li>
              <li> <a href="clientview.php">View</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Menu <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="createtrip.php">Create Ride</a></li>
              <li> <a href="addtrip.php"> Search Ride</a></li>
              <li> <a href="details.php"> My Details</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="clientlogin.php">Client</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
                        <a href="#"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
 
<?php 

    $login_customer = $_SESSION['login_customer']; 
    $user = $_SESSION['login_customer']; 
	$link = @mysqli_connect("localhost","root","enormousviju1770","merge") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;
    $sql = "SELECT trip_id,dname,mob from booking where rider1='$user' OR rider2='$user' OR rider3='$user' OR rider4='$user' " ;
    if ($res = mysqli_query($link,$sql)){
		if(mysqli_num_rows($res)>0){


?>


<div class="container">
      <div class="jumbotron">
        <h1 class="text-center" style="color: green;" >My Bookings</h1>
		</br>
		</br>
			

<?php
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
			$tripid = $row["trip_id"];
			$sql1 = "Select trip_id,car_no,dname,pno,jdate from trips where trip_id = $tripid";
			$res1 = mysqli_query($link, $sql1);
			echo "<table class='table table-hover table-striped table-condensed table-bordered'>
								  <tr>
								  <th>Sl No.</th>
								  <th>Trip Id</th>
								  <th>Car Number</th>
								  <th>Name</th>
								  <th>Phone Number</th>
								  <th>Trip Date</th>
								  								  
							";
							$x=1	;
							while($row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC)){
								echo "<tr>";
								echo "<td>" . $x++ . "</td>";
								echo "<td>" . $row1["trip_id"] . "</td>";
								echo "<td>" . $row1["car_no"] . "</td>";
								echo "<td>" . $row1["dname"] . "</td>";
								echo "<td>" . $row1["pno"] . "</td>";
								echo "<td>" . $row1["jdate"] . "</td>";
								
								
							}
							echo "</table>";
							mysqli_free_result($res);
	
			   
	
	
?>

			
	    </br>
        <p> Hope you Liked Our Website </p>
      </div>
    </div>

        <?php } else { 
            ?>
        <div class="container">
		  <div class="jumbotron">
			<h1>No booked cars</h1>
			<p> <a href="addtrip.php">Book a Car Now </a> </p>
		  </div>
		</div>
		<?php } ?>
	<?php } ?>
  </body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© RIDE SHARE</h5>
                </div>
            </div>
        </div>
    </footer>
</html>