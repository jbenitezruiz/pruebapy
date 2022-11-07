<?php
require_once 'databaseConnection.php';
$conn = openCon();
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_SESSION["id"];
  $user = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);
  $pass = test_input($_POST["pass"]);
    require_once 'databaseConnection.php';
    try {
		$sql = "UPDATE usuarios SET usuario='$user', correo='$email'";
		if($pass!=null){
			$sql = $sql.", pass='$pass' ";
		}
		$sql = $sql."where id='$id'";
        
        $res = $conn->query($sql);
        $count = $res->fetchColumn();
        if ($count==1){
			$query = $conn->query("SELECT * FROM usuarios where id='$id';");
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
		echo "<script>location.href='../profile.html'; </script>";
        exit;
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