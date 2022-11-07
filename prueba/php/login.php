<?php
require_once 'databaseConnection.php';
$conn = openCon();
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = test_input($_POST["username"]);
  $pass = test_input($_POST["pass"]);
    require_once 'databaseConnection.php';
    try {
        $sql = "SELECT count(*) from usuarios where usuario='$user' and pass='$pass';";
        $res = $conn->query($sql);
        $count = $res->fetchColumn();
        
		
        if ($count==1){
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
			echo "<script>location.href='setupServer.php'; </script>";
            exit;
        }else{
			echo "No Se ha iniciado sesión correctamente";
        }
    } catch (PDOException $pe) {
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