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
	$link = @mysqli_connect("localhost","root","enormousviju1770","merge") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;
	$user = $_SESSION['login_customer'];
	
		
	$sql = "select * from users where username = '$user' ";
	if ($res = mysqli_query($link,$sql)){
		if(mysqli_num_rows($res)>0){
	   		$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
		    $fname = $row["first_name"];	
		    $lname = $row["last_name"];	
		    $email = $row["email"];	
		    $pno = $row["phonenumber"];	
					
		mysqli_free_result($res);
		}else{
			echo "<p> It returns an empty result set</p>";
		}
	}else{
		echo "<p> Unable to execute: $sql. " . mysqli_error($link). "</p>";
	}
	
	

	$link->close();
    
?>


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
              <li> <a href="createtrip.php">Create Trip</a></li>
              <li> <a href="booknow.php">Join Trip</a></li>
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
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: black;"><span class="glyphicon glyphicon-user"style="color: blue;"></span> My Profile.</h1>
        </div>
    </div>
    <br>
 
    <div class="container">
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <br>
                <h3 style="color: orange;">My Details</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
				<table class='table table-hover table-striped table-condensed table-bordered'>
					<tr>
						<td> <strong> Name </strong> </td>
						<td> <strong> <?php echo $fname . " " . $lname; ?> </strong> </td>
					</tr>
					<tr>
						<td> <strong> Phone Number </strong> </td>
						<td> <strong> <?php echo $pno ?> </strong> </td>
					</tr>
					<tr>
						<td> <strong> Email </strong> </td>
						<td> <strong> <?php echo $email ?> </strong> </td>
					</tr>
				</table>
				</br>
				
				
				
				
				<?php
					$link = @mysqli_connect("localhost","root","enormousviju1770","merge") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;
					$user = $_SESSION['login_customer'];
					
						
					$sql = "select * from car_details where username = '$user' ";
					if ($res = mysqli_query($link,$sql)){
						if(mysqli_num_rows($res)>0){
							$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
							$carname = $row["car_model"];	
							$carno = $row["car_no"];	
							$dlno = $row["dlnum"];	
							$x = 1;
									
						mysqli_free_result($res);
						}else{
							$x = mysqli_num_rows($res);
						}
					}else{
						echo "<p> Unable to execute: $sql. " . mysqli_error($link). "</p>";
					}					
					$link->close();
					
				?>				
				
				
				
				
				<!-- Enter Car Details  -->
				<h6>  View Car Details &nbsp; <button onclick=disp()> <span class="glyphicon glyphicon-chevron-down"></span>  </h6>
				<div id="car" style="display:none;" > 
					<?php 
					    if ($x>0){
					?>		
						<table class='table table-hover table-striped table-condensed table-bordered'>
							<tr>
								<td> <strong> Car Model </strong> </td>
								<td> <strong> <?php echo $carname; ?> </strong> </td>
							</tr>
							<tr>
								<td> <strong> Car Number </strong> </td>
								<td> <strong> <?php echo $carno ?> </strong> </td>
							</tr>
							<tr>
								<td> <strong> DL Number </strong> </td>
								<td> <strong> <?php echo $dlno ?> </strong> </td>
							</tr>
						</table>	
										
					<?php }else{ ?>
						<h6> Currently there is no Car details to show. </h6>
						</br>
						
				<h6 class="text-right" style="color: blue;"><span class="glyphicon glyphicon-pencil"></span><a href="car.php"> Add My Car Details</a> </h6>
					<?php } ?>
				</div>
				</br>
					
				
                <?php     
                if($pno <1000 ){
                ?>
                                                     
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
			</br>
            <h6 style="text-align:red;">Warning! <strong>Do not reload this page</strong> or the above display will be lost. </h6>
        </div>
    </div>
</body>
<?php } else { ?>
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
              <li> <a href="viewuser.php">View Users</a></li>
              <li> <a href="viewtrip.php"> View Trips</a></li>
              <li> <a href="viewfeedback.php">View Feedbacks</a></li>

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
              <li> <a href="booknow.php">Book Trips</a></li>
			  <li> <a href="mybookings.php">My Bookings</a></li>
			  <li> <a href="details.php"> Car Details</a></li>
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
                        <a href="clientlogin.php">Admin</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">User</a>
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
    <div class="container">
	
                <?php } ?>

<script <script type="text/javascript">
		
	function disp(){
		document.getElementById("car").style.display="block";
	}


</script>


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