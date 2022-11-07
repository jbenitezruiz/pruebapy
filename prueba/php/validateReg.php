<?php
// define variables and set to empty values
require_once 'databaseConnection.php';
$conn = openCon();
$name = $email = $password = $confPass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["username"]);
	$email = test_input($_POST["email"]);
    $pass = test_input($_POST["pass"]);

    
    try {
        $sql = "SELECT count(*) as total from usuarios where usuario='$name';";
        $res = $conn->query($sql);
        $count = $res->fetchColumn();
        if ($count >0 ){

        }else{
            $sql="insert into usuarios (correo,usuario,pass) values ('$email','$name','$pass');";
			$res = $conn->query($sql);
			session_start();

			$_SESSION["username"] = $name;
			if ($res === TRUE) {
				$query = $conn->query("SELECT * FROM usuarios where usuario='$user' and pass='$pass';");
				$query->execute();

				while($row = $query->fetch(PDO::FETCH_ASSOC))
				{
					$id = $row['id'];
					$username = $row['usuario'];
					$correo = $row['correo'];
					
					$_SESSION["id"] = $id;
					$_SESSION["username"] = $username;
					$_SESSION["correo"] = $correo;
				}
			}
            echo "<script>location.href='setupServer.php'; </script>";
            exit;
        }
    }
    catch (PDOException $pe) {
        die("Could not connect to the database $dbname :" . $pe->getMessage());
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>