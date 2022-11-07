<?php
	function openCon(){
		$servername = "localhost";
		$dbname = "proyecto";
		$username = "root";
		$password = "";
		// Create connection
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);;
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		return $conn;
	}


	function CloseCon($conn){
		mysqli_close($conn);
	}
?>