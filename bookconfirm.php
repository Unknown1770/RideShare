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
	$missingid = '<p><strong>Please enter the Trip Id</strong></p>';
	$missingname = '<p><strong>Please enter Your Name</strong></p>';
	$missingsource = '<p><strong>Please enter Your Phone Number</strong></p>';
	$errors = '';
	
	//checking name
	if(empty($_POST["tripid"])){
		$errors .= $missingid;
	}else{
		$tripid = filter_var($_POST["tripid"], FILTER_SANITIZE_STRING);   
	}
	
	//checking name
	if(empty($_POST["name"])){
		$errors .= $missingname;
	}else{
		$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);   
	}
	
	//checking name
	if(empty($_POST["source"])){
		$errors .= $missingsource;
	}else{
		$source = filter_var($_POST["source"], FILTER_SANITIZE_STRING);   
	}
	
		
	//CHECKING FOR ANY ERRORS
    if($errors){
		$resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
		echo $resultMessage;
		exit;
	}
	
		
	$sql = "select dname,pno,car_no,seats,fare  from trips where trip_id ='$tripid' ";
	if ($res = mysqli_query($link,$sql)){
		if(mysqli_num_rows($res)>0){
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
		    $dname = $row["dname"];	
		    $carno = $row["car_no"];	
		    $dmob = $row["pno"];	
			$seats = $row["seats"];
			$fare = $row["fare"];
		
		mysqli_free_result($res);
		}else{
			echo "<p> It returns an empty result set</p>";
		}
	}else{
		echo "<p> Unable to execute: $sql. " . mysqli_error($link). "</p>";
	}
	
	
	//preparing the queries to put it into bookings table
	$tripid = mysqli_real_escape_string($link, $tripid);
	$name = mysqli_real_escape_string($link, $name);
	$source = mysqli_real_escape_string($link, $source);
	$dname = mysqli_real_escape_string($link, $dname);
	$carno = mysqli_real_escape_string($link, $carno);
	$dmob = mysqli_real_escape_string($link, $dmob);
	$seats = mysqli_real_escape_string($link, $seats);
	
	$query = "INSERT into booking (trip_id,car_no,dname,mob,seats) VALUES('" . $tripid . "','" . $carno . "','" . $dname . "','" . $dmob . "','" . 0 ."')";
	mysqli_query($link,$sql);
	
	
	//inserting the values into the table
	if ($seats==4){
		$query = "update booking set rider1 = '$name', source1='$source', seats=1 where trip_id ='$tripid' ";
		$sql = "update trips set seats = 3 where trip_id ='$tripid'";
		mysqli_query($link,$sql);
	}
	else if($seats==3){
		$query = "update booking set rider2 = '$name', source2='$source', seats=2 where trip_id ='$tripid' ";
		$sql = "update trips set seats = 2 where trip_id ='$tripid'";
		mysqli_query($link,$sql);
	}
	else if($seats==2){
		$query = "update booking set rider3 = '$name', source3='$source', seats=3 where trip_id ='$tripid' ";
		$sql = "update trips set seats = 1 where trip_id ='$tripid'";
		mysqli_query($link,$sql);
	}
	else {
		$query = "update booking set rider4 = '$name', source4='$source', seats=4 where trip_id ='$tripid'  ";
		$sql = "update trips set seats = 0 where trip_id ='$tripid'";
		mysqli_query($link,$sql);
	}

	$success = $link->query($query);
	if (!$success){
		die("Couldnt enter data: ".$link->error);
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
              <li> <a href="addtrip.php">Join Trip</a></li>
              <li> <a href="mybookings.php">My Bookings</a></li>
              <li> <a href="details.php"> Car details</a></li>
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
                        <a href="customerlogin.php">Users</a>
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
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Trip Booked Succesfully.</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Thank you creating a sharing a trip with RIDE SHARE! We wish you a happy journey. </h2>

 

    <div class="container">
        <h5 class="text-center">Please read the following information about your trip.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">Your Ride has Been Booked.</h3>
                <br>
                <h3 style="color: orange;">Your Ride Details</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Person Name: </strong> <?php echo $dname; ?></h4>
                <br>
				<h4> <strong>Phone Number:</strong> <?php echo $dmob; ?></h4>
                <br>
                <h4> <strong>Car Number:</strong> <?php echo $carno; ?></h4>
                <br>
				<h4> <strong>Trip Id:</strong> <?php echo $tripid ; ?></h4>
                <br>
                
                <?php     
                if($fare >0 ){
                ?>
                     <h4> <strong>Fare:</strong> ₹ <?php echo $fare; ?></h4>
                                
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