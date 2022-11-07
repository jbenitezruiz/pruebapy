<?php

// Getting uploaded file
session_start();
$var = $_SESSION["username"];
$file = $_FILES["file"];
$name = $file["name"];
$loc="../uploads/$var/$name";

/*$increment = 0;
if (file_exists($loc)) {
    list($name, $ext) = explode('.', $loc);
    while(file_exists($loc)) {
        $increment++;
        $loc = $name. $increment . '.' . $ext;
        $filename = $name. $increment . '.' . $ext;
    }
	echo "EXISTE " . $filename;
    move_uploaded_file($file["tmp_name"], "../uploads/$var/" . $filename);
}else{
    
}*/
move_uploaded_file($file["tmp_name"], "$loc" . $file["name"]);
// Redirecting back
header("Location: " . $_SERVER["HTTP_REFERER"]);

?>