<!DOCTYPE html>

<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
    <title> User Signup | Ride Share  </title>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/clientlogin.css">
<body>
     <!-- Navigation -->
     <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   Ride Share </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <?php
                if(isset($_SESSION['login_client'])){
					$user = $_SESSION['login_client'];
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
					$user  = $_SESSION['login_customer'];
            ?>
                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                            </li>
                            <li>
                                <a href="#">History</a>
                            </li>
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
                                    <a href="adminlogin.php">Admin</a>
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
	<?php 
	
	    $user  = $_SESSION['login_customer'];
		
		$link = @mysqli_connect("localhost","root","enormousviju1770","merge") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;
		
		$missingmodel = '<p><strong>Please Specify your Car Model</strong></p>';
		$missingnum = '<p><strong>Please Specify your Car Number</strong></p>';
		$missingdl = '<p><strong>Please Specify your Car Model</strong></p>';
		$errors = '';

		//    <!--Get Car Number, Car model and dl num-->
		//Get Car Model
		if(empty($_POST["model"])){
			$errors .= $missingmodel;
		}else{
			$model = filter_var($_POST["model"], FILTER_SANITIZE_STRING);   
		}
		
		//Get Car Number
		if(empty($_POST["name"])){
			$errors .= $missingnum;
		}else{
			$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);   
		}
		
		//Get username
		if(empty($_POST["dlno"])){
			$errors .= $missingdl;
		}else{
			$dlno = filter_var($_POST["dlno"], FILTER_SANITIZE_STRING);   
		}		
		
	
		if($errors){
		$resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
		echo $resultMessage;
		exit;
		}

		//no errors

		//Prepare variables for the queries
		$user = mysqli_real_escape_string($link, $user);
		$name = mysqli_real_escape_string($link, $name);
		$dlno = mysqli_real_escape_string($link, $dlno);
		$model = mysqli_real_escape_string($link, $model);
		
		
		$query = "INSERT into car_details(username, car_model, car_no, dlnum) VALUES('" . $user . "','" . $model . "','" . $name . "','" . $dlno . "')";
		mysqli_query($link,$query);
		
		$success = $link->query($query);
		if (!$success){
			die("Couldnt enter data: ".$link->error);
		}

		$link->close();
		header("Location:details.php"); 
	
	?>
    
</body>
<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h5>©RIDE SHARE</h5>
            </div>
        </div>
    </div>
</footer>

</html>