<html>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
<div>
	<form method="POST" action="upload.php" enctype="multipart/form-data">
		<!--<label class="custom-file-upload"></label> class="custom-file-upload"  Seleccionar-->
		<label>
			<input type="file" accept=".mp4, .png, .jpg, .gif, .jpeg, .mp3, .docx, .odt, .doc, .txt, .pptx, .pdf" name="file"/>
			Seleccionar
		</label>
		<label>
			<input type="submit" name="Upload"/>
			Subir
		</label>
	</form>
	
	
</div>
<nav>
        <ul>
          <li><a href="index.html">HOME</a></li>
        </ul>
        <img src="./moon.png" id="icon" /> </nav>


<a href="../profile.html">
  <button type="button" class="btn btn-primary">Perfil</button>
</a>


<?php
session_start();
$var = $_SESSION["username"];

if (!file_exists("../uploads/$var")) {
    mkdir("../uploads/$var", 0777, true);
}

$files = scandir("../uploads/$var");
for ($a = 2; $a < count($files); $a++)
{
?>
<p>
    <a href="../video.php?id=<?php echo $files[$a];?>"><?php echo $files[$a];?></a>
    <a href="../uploads/<?php echo($var)?>/<?php echo $files[$a]; ?>" download="<?php echo $files[$a]; ?>">
        <button type="button" class="btn btn-primary">Descargar</button>
    </a>
    
    <a href="delete.php?name=../uploads/<?php echo($var)?>/<?php echo $files[$a]; ?>" style="color: red;">
        <button type="button" class="btn btn-danger">Borrar</button>
    </a>
</p>
<?php
}

?>


<script>
			var icon = document.getElementById("icon");
			
			if(localStorage.getItem("theme")==null){
				localStorage.setItem("theme", "light");
			}
			
			let localData = localStorage.getItem("theme");
			
			if(localData == "light"){
				icon.src = "images/moon.png";
				document.body.classList.remove("dark-theme");
			}else if(localData == "dark"){
				icon.src = "images/sun.png";
				document.body.classList.add("dark-theme");
			}
			icon.onclick = function(){
				document.body.classList.toggle("dark-theme");
				if(document.body.classList.contains("dark-theme")){
					icon.src = "images/sun.png";
					localStorage.setItem("theme", "dark");
				}else{
					icon.src = "images/moon.png";
					localStorage.setItem("theme", "light");
				}
			}
		</script>
</body>
</html>