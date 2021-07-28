<?php
	$user = 'vijay12';
	$link = @mysqli_connect("localhost","root","enormousviju1770","merge") or die ("Error: Unable to connect: ".mysqli_connect_error()) ;
    
	$name = $_POST["name"];
	$email = $_POST["email"];
	$message = $_POST["message"];
	

	$name = mysqli_real_escape_string($link, $name);
	$email = mysqli_real_escape_string($link, $email);
	$message = mysqli_real_escape_string($link, $message);
	$query = "INSERT into feedback (name,email,message) VALUES('" . $name . "','" . $email . "','" . $message . "')";
		
	$success = $link->query($query);
	if (!$success){
		die("Couldnt enter data: ".$link->error);
	}

	$link->close();
	header("Location:http://www.localhost/merge/index.php"); 
?>