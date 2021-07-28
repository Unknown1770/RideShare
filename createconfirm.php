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
    //defining errors 
	$missingname = '<p><strong>Please enter Your Name!</strong></p>';
	$missingcarno = '<p><strong>Please enter Your Car Number!</strong></p>';
	$missingdl = '<p><strong>Please enter Your DL Details!</strong></p>';
	$missingphone = '<p><strong>Please enter Your Phone Number!</strong></p>';
	$missingsource = '<p><strong>Please enter Your Source Point!</strong></p>';
	$missingdest = '<p><strong>Please enter Your Destination Point!</strong></p>';
	$missingvia = '<p><strong>Please enter Your Route Details! Minimum one stoppage</strong></p>';
	$missingseats = '<p><strong>Please enter Number of seats available</strong></p>';
	$missingfare = '<p><strong>Please enter Seat fare</strong></p>';
	$missingtype = '<p><strong>Please enter YOur Trip Type</strong></p>';
	$missingfreq = '<p><strong>Please enter YOur Trip frequency</strong></p>';
	$errors = '';
	
	//checking name
	if(empty($_POST["name"])){
		$errors .= $missingname;
	}else{
		$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);   
	}
	
	//checking car number
	if(empty($_POST["carno"])){
		$errors .= $missingcarno;
	}else{
		$carno = filter_var($_POST["carno"], FILTER_SANITIZE_STRING);   
	}


/*	
	//checking dl details
	if(empty($_POST["dl"])){
		$errors .= $missingdl;
	}else{
		$dlno = filter_var($_POST["dl"], FILTER_SANITIZE_STRING);   
	}
*/

	//checking phone number
	if(empty($_POST["phonenumber"])){
		$errors .= $missingphone;
	}else{
		$phonenumber = filter_var($_POST["phonenumber"], FILTER_SANITIZE_STRING);   
	}
	
	//checking Trip Source
	if(empty($_POST["source"])){
		$errors .= $missingsource;
	}else{
		$source = filter_var($_POST["source"], FILTER_SANITIZE_STRING);   
	}
	
	//checking Trip Destination
	if(empty($_POST["dest"])){
		$errors .= $missingdest;
	}else{
		$dest = filter_var($_POST["dest"], FILTER_SANITIZE_STRING);   
	}
	
	//checking Trip Route
	if(empty($_POST["via"])){
		$errors .= $missingvia;
	}else{
		$via = filter_var($_POST["via"], FILTER_SANITIZE_STRING);   
	}
	
	//checking seats
	if(empty($_POST["seat"])){
		$errors .= $missingseats;
	}else{
		$seat = filter_var($_POST["seat"], FILTER_SANITIZE_STRING);   
	}
	
	//checking fare
	if(empty($_POST["fare"])){
		$errors .= $missingfare;
	}else{
		$fare = filter_var($_POST["fare"], FILTER_SANITIZE_STRING);   
	}
	
	//checking Trip Frequency
	if(empty($_POST["radio"])){
		$errors .= $missingfreq;
	}else{
		$freq = filter_var($_POST["radio"], FILTER_SANITIZE_STRING);   
	}
	
	//checking Trip Type
	if(empty($_POST["radio1"])){
		$errors .= $missingtype;
	}else{
		$type = filter_var($_POST["radio1"], FILTER_SANITIZE_STRING);   
	}
	
		
    $date = date('Y-m-d', strtotime($_POST['date']));
    $time = $_POST['time'];
     
    //CHECKING FOR ANY ERRORS
    if($errors){
		$resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
		echo $resultMessage;
		exit;
	}	 
	
	$tripid = rand(1000,100000000);
	$x=1;
	while($x==1){
		$sql = "select trip_id  from trips where trip_id ='$tripid' ";
		if ($res = mysqli_query($conn,$sql)){
			if(mysqli_num_rows($res)==0){
				$x=0;
				mysqli_free_result($res);
			}else{
				$tripid = rand(1000,100000000);
			}
		}
	}
	
	
	
	
    // PREPARING THE QUERIES FOR INSERTING INTO TRIPS TABLE
    $name = mysqli_real_escape_string($conn, $name);
	$carno = mysqli_real_escape_string($conn, $carno);
	//$dlno = mysqli_real_escape_string($conn, $dlno);
	$phonenumber = mysqli_real_escape_string($conn, $phonenumber);
	$source = mysqli_real_escape_string($conn, $source);
	$dest = mysqli_real_escape_string($conn, $dest);
	$via = mysqli_real_escape_string($conn, $via);
	$seat = mysqli_real_escape_string($conn, $seat);
	$fare = mysqli_real_escape_string($conn, $fare);
	$freq = mysqli_real_escape_string($conn, $freq);
	$type = mysqli_real_escape_string($conn, $type);
	$tripid = mysqli_real_escape_string($conn, $tripid);
		
		
	/* 
			$sql = "SELECT * FROM admin WHERE username = '$username'";
			$result = mysqli_query($conn, $sql);
			if(!$result){
				echo '<div class="alert alert-danger">Error running the query!</div>';
			//    echo '<div class="alert alert-danger">' . mysqli_error($conn) . '</div>';
				exit;
			}
    */
	
	$query = "INSERT into trips(trip_id,car_no,dname,pno,fare,seats,sources,destination,via,jdate,type,trip,time) VALUES('" . $tripid . "','" . $carno . "','" . $name . "','" . $phonenumber . "','" . $fare ."','" . $seat ."','" . $source ."','" . $dest ."','" . $via ."','" . $date ."','" . $freq ."','" . $type ."','" . $time ."')";
	$success = $conn->query($query);
	if (!$success){
		die("Couldnt enter data: ".$conn->error);
	}

	
	$query = "INSERT into booking(trip_id,car_no,dname,mob,seats) VALUES('" . $tripid . "','" . $carno . "','" . $name . "','" . $phonenumber . "','" . $seat ."')";
	$success = $conn->query($query);

	if (!$success){
		die("Couldnt enter data: ".$conn->error);
	}

	
	$conn->close();
	
	
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
                        <a href="clientlogin.php">Admin</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Users</a>
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
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Trip Created Succesfully.</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Thank you creating a sharing a trip with RIDE SHARE! We wish you a happy journey. </h2>

 

    <div class="container">
        <h5 class="text-center">Please read the following information about your trip.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">Your trip has been created.</h3>
                <br>
                <h3 style="color: orange;">Details</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
				<h4> <strong>Trip Id: </strong> <?php echo $tripid; ?></h4>
                <br>
                <h4> <strong>Name: </strong> <?php echo $name; ?></h4>
                <br>
				<h4> <strong>Phone Number:</strong> <?php echo $phonenumber; ?></h4>
                <br>
                <h4> <strong>Car Number:</strong> <?php echo $carno; ?></h4>
                <br>
				<h4> <strong>Trip Date and Time:</strong> <?php echo $date ."    ".  $time  ; ?></h4>
                <br>
                
                <?php     
                if($fare <0 ){
                ?>
                     <h4> <strong>Fare:</strong> ₹<?php echo $fare; ?>/day</h4>
                

                <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Vehicle Number: </strong> <?php echo $carno; ?></h4>
                <br>
                <h4> <strong>DL Detail:</strong> <?php echo $dlno; ?></h4>
                <br>
                <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $date; ?></h4>
                <br>
                <h4> <strong>Return Date: </strong> <?php echo $time; ?></h4>
                <br>
                <h4> <strong>Driver Name: </strong> <?php echo $name; ?> </h4>
                <br>
                <h4> <strong>Driver Gender: </strong> <?php echo $carno; ?> </h4>
                <br>
                <h4> <strong>Driver License number: </strong>  <?php echo $dl_number; ?> </h4>
                <br>
                <h4> <strong>Driver Contact:</strong>  <?php echo $phonenumber; ?></h4>
                <br>
                <h4> <strong>Client Name:</strong>  <?php echo $name; ?></h4>
                <br>
                <h4> <strong>Client Contact: </strong> <?php echo $phonenumber; ?></h4>
                <br>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h6>
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
              <li> <a href="mybookings.php">Join Trips</a></li>
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