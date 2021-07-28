<!DOCTYPE html>
<html>

<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>

<body>

<?php
    $missingUsername = '<p><strong>Please enter a username!</strong></p>';
	$missingUsername = '<p><strong>Please enter a username!</strong></p>';
	$errors = '';
	
	if(empty($_POST["dest"])){
    $errors .= $missingUsername;
	}else{
		$dest = filter_var($_POST["dest"], FILTER_SANITIZE_STRING);   
	}
	
	if(empty($_POST["via"])){
    $errors .= $missingUsername;
	}else{
		$via = filter_var($_POST["via"], FILTER_SANITIZE_STRING);   
	}
	
	$date = date('Y-m-d', strtotime($_POST['date']));
	
	$link = @mysqli_connect("localhost","root","enormousviju1770","merge") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;

?>

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
              <li> <a href="createtrip.php">Create Trip</a></li>
              <li> <a href="prereturncar.php">Join Trip</a></li>
              <li> <a href="prereturncar.php">My Bookings</a></li>
              <li> <a href="mybookings.php"> Car details</a></li>
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
		$sql = "select trip_id,car_no,sources,destination,dname,pno,seats,fare,time from trips where via ='$via' AND destination = '$dest' AND jdate = '$date' AND seats>0 ";
		if ($res = mysqli_query($link,$sql)){
			if(mysqli_num_rows($res)>0){
	?>
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Trip Found</h1>
        </div>
    </div>
    <br>
    <h2 class="text-center"> Thank you for sharing ride and saving environment. </h2>
      <div class="container">
        <h5 class="text-center">The Following Trips Are found.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <?php
						
							echo "<table class='table table-hover table-striped table-condensed table-bordered'>
								  <tr>
								  <th>Trip Id</th>
								  <th>Name</th>
								  <th>Source</th>
								  <th>Destination</th>
								  <th>Seats Available</th>
								  <th>Fare</th>
								  <th>Trip Time</th>
								  <th>phone Number</th>
								  <th> Book Now</th>
								  
							";
							while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
								echo "<tr>";
								echo "<td>" . $row["trip_id"] . "</td>";
								echo "<td>" . $row["dname"] . "</td>";
								echo "<td>" . $row["sources"] . "</td>";
								echo "<td>" . $row["destination"] . "</td>";
								echo "<td>" . $row["seats"] . "</td>";
								echo "<td>" . $row["fare"] . "</td>";
								echo "<td>" . $row["time"] . "</td>";
								echo "<td>" . $row["pno"] . "</td>";
								echo "<td>" . "<p> <a href='booknow.php'>Book Now</a> </p>" . "</td>";
							}
							echo "</table>";
							mysqli_free_result($res);
													   

				?>
						
			</div>
			<div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
				<h6>NOTE:  <strong>Please Note Down the Trip Id </strong> for booking the ride.</h6>
				</div>
			</div>
		</div>
	
	
	
	<?php }else { ?>
			<!-- Navigation -->
		
				<div class="container">
				<div class="jumbotron">
					<h1 class="text-center" style="color: red;"><span class="glyphicon glyphicon-remove-circle"></span> No Trip Found</h1>
				</div>
			</div>
			<br>
			<h2 class="text-center"> Thank you for sharing ride and saving environment. </h2></br>
			  <div class="container">
				<h5 class="text-center">Sorry, Currently there is no trip available for you :( </h5>
				<h5 class="text-center"><strong><a href="addtrip.php"> Search Another Trip With Nearby location? </strong> </a> .</h5>
			 </div>
				<!-- Collect the nav links, forms, and other content for toggling -->
	
	
	</body>
	<?php } ?>
		
	
		<?php } ?>	
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