<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])){
	if (empty($_POST['client_username']) ||empty($_POST['id']) || empty($_POST['pwd'])) {
		$error = "ADMIN_ID or Password is invalid";
	}
	else
    {
		// Define $username and $password
		$client_username=$_POST['client_username'];
		$id=$_POST['id'];
		$password=$_POST['pwd'];

		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		require 'connection.php';
		$conn = Connect();

		// SQL query to fetch information of registerd users and finds user match.
		$query = "SELECT id, pwd FROM admin WHERE id=? AND pwd=? LIMIT 1";

		// To protect MySQL injection for Security purpose
		$stmt = $conn->prepare($query);
		$stmt -> bind_param("ss", $id, $password);
		$stmt -> execute();
		$stmt -> bind_result($id, $password);
		$stmt -> store_result();

		if ($stmt->fetch())  //fetching the contents of the row
		{
			
			$_SESSION['login_client']=$client_username;; // Initializing Session
			header("location: index.php"); // Redirecting To Other Page
		}
		else {
			$error = "Username or Password is invalid";
		}
		mysqli_close($conn); // Closing Connection
	
	}
}
?>