<html>

<head>
    <title> Admin SignUp  </title>
</head>
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
            <h1>Welcome to RIDE SHARE Family</h1>
            <br>
            <p>Create your account</p>
        </div>
    </div>

    <div class="container" style="margin-top: -1%; margin-bottom: 2%;">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading"> Create Account </div>
                <div class="panel-body">

                    <form role="form" action="client_registered_success.php" method="POST">
						
							  <div class="modal-body">
								  
								  <!--Sign up message from PHP file-->
								  <div id="signupmessage"></div>
								  
								  <div class="form-group">
									  <label for="ids" class="sr-only">ID:</label>
									  <input class="form-control" type="number" name="ids" id="ids" placeholder="ID" max="999999">
								  </div>
								  <div class="form-group">
									  <label for="username" class="sr-only">Username:</label>
									  <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
								  </div>
								  <div class="form-group">
									  <label for="name" class="sr-only">Name:</label>
									  <input class="form-control" type="text" name="name" id="name" placeholder="name" maxlength="30">
								  </div>
								  								  <div class="form-group">
									  <label for="email" class="sr-only">Email:</label>
									  <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">
								  </div>
								  <div class="form-group">
									  <label for="password" class="sr-only">Choose a password:</label>
									  <input class="form-control" type="password" name="password" id="password" placeholder="Choose a password" maxlength="30">
								  </div>
								  <div class="form-group">
									  <label for="password2" class="sr-only">Confirm password</label>
									  <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">
								  </div>
								  <div class="form-group">
									  <label for="phonenumber" class="sr-only">Telephone:</label>
									  <input class="form-control" type="text" name="phonenumber" id="phonenumber" placeholder="Telephone Number" maxlength="15">
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