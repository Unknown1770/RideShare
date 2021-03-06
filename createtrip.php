<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Create Trip </title>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="assets/js/custom.js"></script> 
 <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ng-app=""> 


      <!-- Navigation -->
     <!-- Navigation -->
     <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="createrip.php">
                   CREATE TRIP </a>
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
              <li> <a href="addtrip.php">Join Trip</a></li>
              <li> <a href="mybookings.php">My Bookings</a></li>
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
    
<div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
              
		
		<form role="form" action="createconfirm.php" method="POST">
		  <div class="modal-body">
		     <!--Sign up message from PHP file-->
			 <div id="signupmessage"></div>
			        
					<div class="form-group">
					  <label for="name" class="sr-only">name:</label>
					  <input class="form-control" type="text" name="name" id="name" placeholder="Name" maxlength="30">
					</div>
					
					<div class="form-group">
						  <label for="phonenumber" class="sr-only">Phone No.:</label>
						  <input class="form-control" type="text" name="phonenumber" id="phonenumber" placeholder="Mobile Number" maxlength="15">
					</div>
					
					<div class="form-group">
					  <label for="carno" class="sr-only">Car Number:</label>
					  <input class="form-control" type="text" name="carno" id="carno" placeholder="Car Number" maxlength="30">
					</div>
										
					<div class="form-group">
						  <label for="source" class="sr-only">source:</label>
					      <input class="form-control" type="text" name="source" id="source" placeholder="Starting Point" maxlength="30">
					</div>
					
					<div class="form-group">
					  <label for="dest" class="sr-only">dest</label>
					  <input class="form-control" type="text" name="dest" id="dest" placeholder="Destination Point" maxlength="50">
					</div>
					
					<div class="form-group">
					  <label for="via" class="sr-only">via</label>
					  <input class="form-control" type="text" name="via" id="via" placeholder="Enter Your Route Via :- " maxlength="30">
					</div>
					
					<div class="form-group">
						<label for="seat" class="sr-only">seat</label>
					    <input class="form-control" type="number" name="seat" id="seat" placeholder="Seats Available" max="9"></br>
						<label for="fare" class="sr-only">fare</label>
					    <input class="form-control" type="number" name="fare" id="fare" placeholder="Fare" max="999" min="0">

					</div>
					 
					 <div class="form-group">
						  <?php $today = date("Y-m-d") ?>
						  <label><h5>Date:</h5></label>&nbsp;&nbsp;&nbsp;
							<input type="date" name="date" min="<?php echo($today);?>" required="">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <label><h5>Time:</h5></label>&nbsp;&nbsp;&nbsp;
						  <input type="time" name="time" value="time" required="">
					</div>
					
					 <div class="form-group">
						  <label><h5>Select Trip Frequency:</h5></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <label><input type="radio" name="radio" id="regular" value="Regular Trip">Regular Trip</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <label><input type="radio" name="radio" id="oneday" value="One-day">One-day</label>
					 </div>
					 
					 <div class="form-group">
						  <label><h5>Select Trip Type:</h5></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <label><input type="radio" name="radio1" id="oneway" value="One-Way">One Way</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <label><input type="radio" name="radio1" id="updown" value="Up -Down">Up - Down</label>
					 </div>
								  
					 </div>
						
						<div class="modal-footer">
						<input class="btn green" name="create" type="submit" value="Create Trip">
					    <button type="button" class="btn btn-default" data-dismiss="modal">
				     		  Cancel
						</button>
					  </div>
				  </div>
			    </div>
			  </div>
			 </form>	  
		
		
		
		
		
        
      </div>
      <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6><strong>Kindly Note:</strong>  <span class="text-danger">Please behave well with Others</span>.</h6>
        </div>
    </div>

</body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>?? RIDE SHARE</h5>
                </div>
            </div>
        </div>
    </footer>
</html>