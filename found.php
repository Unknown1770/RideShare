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
                   VIEW TRIPS </a>
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
				  <li> <a href="viewuser.php"> View Users</a></li>
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
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
    <div class="container">
	<?php   $day = date('d-m-Y', strtotime($_POST['date']));	?>
        <h3 class="text-center"> TRIPS ON <?php echo $day ?></h3>
           </br>
           </br>
		   	
			<?php
			    $date = $_POST["date"];
				$link = @mysqli_connect("localhost","root","enormousviju1770","merge") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;
				$sql = "select trip_id,car_no,sources,destination,dname,pno,seats,fare from trips where jdate = '$date'  ";
				if ($res = mysqli_query($link,$sql)){
				if(mysqli_num_rows($res)>0){
					echo "<table class='table table-hover table-striped table-condensed table-bordered'>
								  <tr>
								  <th>Trip Id</th>
								  <th>Name</th>
								  <th>Source</th>
								  <th>Destination</th>
								  <th>Seats Available</th>
								  <th>Fare</th>
								  <th>phone Number</th>
								  <th> Seats</th>
								  
							";
							while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
								echo "<tr>";
								echo "<td>" . $row["trip_id"] . "</td>";
								echo "<td>" . $row["dname"] . "</td>";
								echo "<td>" . $row["sources"] . "</td>";
								echo "<td>" . $row["destination"] . "</td>";
								echo "<td>" . $row["seats"] . "</td>";
								echo "<td>" . $row["fare"] . "</td>";
								echo "<td>" . $row["pno"] . "</td>";
								echo "<td>" . $row["seats"] . "</td>";
							}
							echo "</table>";
							mysqli_free_result($res);
			?>
					
			<?php }else{ ?>
				<div class="container">
				  <div class="jumbotron">
			       <center><h3 style="color:red;"> THERE ARE NO TRIPS TO SHOW  </h3> </center>
			       </div>
				  </div>
									  
			<?php }?>
			<?php }?>
			<?php }?>
			
			
					
				
				
	</div>		
	
		
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