<!DOCTYPE html>
<html>

<?php 
 include('session_client.php');
if(!isset($_SESSION['login_client'])){
    session_destroy();
    header("location: adminlogin.php");
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

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="viewtrip.php">
                   View Trips </a>
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
				  <li> <a href="viewfeedback.php"> View Feedbacks</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
    <div class="container">
    <div class="container" style="margin-top: 65px;" >
		<div class="col-md-7" style="float: none; margin: 0 auto;">
			<div class="form-area">
                    
					<h4> ENTER DATE TO VIEW TRIPS OF THAT DAY </h4>
					</br>
					</br>
					
					<form role="form" action="found.php" method="POST">
					  <div class="modal-body">
						 <!--Sign up message from PHP file-->
						 <div id="signupmessage"></div>
													
								
								<center>
								<div class="form-group" >
									  <?php $today = date("d-m-Y") ?>
									  <label><h5>Date:</h5></label>&nbsp;&nbsp;&nbsp;
										<input type="date" name="date" min="<?php echo($today);?>" required="">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									  
								</div>
								</center>
														  
							 </div>
									
							 <div class="modal-footer">
									<input class="btn green" name="create" type="submit" value="View Trips">
									<button type="button" class="btn btn-default" data-dismiss="modal">
										  Cancel
									</button>
								  </div>
							  </div>
							 </div>
						 </form>	  
		
		
		
		
		
        
      </div>
		   
		   
			
				
				
	</div>		
				<?php }?>
		
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