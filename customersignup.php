		<html>

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
    <div class="container">
        <div class="jumbotron">
            <h1>Welcome to Ride Share</h1>
            <br>
            <p>start Sharing Rides With Others by creating your account</p>
        </div>
    </div>

    <div class="container" style="margin-top: -1%; margin-bottom: 2%;">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading"> Create Account </div>
                <div class="panel-body">

                    
					<form role="form" action="customer_registered_success.php" method="POST">
						
							  <div class="modal-body">
								  
								  <!--Sign up message from PHP file-->
								  <div id="signupmessage"></div>
								  
								  <div class="form-group">
									  <label for="username" class="sr-only">Username:</label>
									  <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
								  </div>
								  <div class="form-group">
									  <label for="firstname" class="sr-only">Firstname:</label>
									  <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Firstname" maxlength="30">
								  </div>
								  <div class="form-group">
									  <label for="lastname" class="sr-only">Lastname:</label>
									  <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Lastname" maxlength="30">
								  </div>
								  <div class="form-group">
									  <label for="email" class="sr-only">Email:</label>
									  <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">
								  </div>
								  <div class="form-group">
									  <label for="password" class="sr-only">Enter password:</label>
									  <input class="form-control" type="password" name="password" id="password" placeholder="Enter password" maxlength="30">
								  </div>
								  <div class="form-group">
									  <label for="password2" class="sr-only">Confirm password</label>
									  <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">
								  </div>
								  <div class="form-group">
									  <label for="phonenumber" class="sr-only">Phone No.:</label>
									  <input class="form-control" type="text" name="phonenumber" id="phonenumber" placeholder="Mobile Number" maxlength="15">
								  </div>
								  <div class="form-group">
									  <label><input type="radio" name="radio" id="male" value="male">Male</label>
									  <label><input type="radio" name="radio" id="female" value="female">Female</label>
								  </div>
								  
							  </div>
							  <div class="modal-footer">
								  <input class="btn green" name="signup" type="submit" value="Sign up">
								<button type="button" class="btn btn-default" data-dismiss="modal">
								  Cancel
								</button>
							  </div>
						  </div>
					  </div>
					  </div>
					  </form>
					
					

                </div>

            </div>

        </div>
    </div>
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