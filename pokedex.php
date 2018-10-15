<?php
$host_db = "localhost:3306";
$user_db = "root";
$pass_db = "admin";
$db_name = "pokemonsBaldoIgnacio";
$tbl_name = "pokemon";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
	die("La conexion falló: " . $conexion->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="recursos/css/style.css">
	<title>Pokedex</title>
</head>
<body>
	<main class="main">
		<?php

		if (isset($_POST["nombreBuscado"])) 
		{
			$buscado= $_POST["nombreBuscado"];
			$buscado= strtolower($buscado);
			$buscado= ucfirst($buscado);

			if( $buscado != ""){

				$sql = "SELECT 
				p.Id Id,
				p.Descripcion,
				p.Ataque,
				p.Imagen Imagen,
				t.Imagen imgTipo,
				g.Imagen imgGenero
				FROM pokemon p
				LEFT JOIN tipo t ON t.Id = p.IdTipo
				LEFT JOIN genero g ON g.Id = p.IdGenero
				WHERE p.Descripcion ='".$buscado."'";

				$result=mysqli_query($conexion, $sql);
				$cantResultados = mysqli_num_rows($result);

				if($rows = mysqli_fetch_assoc($result))
				{
					echo 
					"<h2>".$rows['Descripcion']."<a class='editarbtn' href='editar.php?id=". $rows['Id'] ."'> Editar</a><a class='editarbtn' href='borrar.php?Id=". $rows['Id'] ."'> Borrar</a><br>"."</h2>".

					"<div class='texto-contendor '>"."<img class='imagenes' src=".$rows['Imagen'].">"."</div>".

					"<div class='texto-contendor '>"."<img class='imagtipo' src=".$rows['imgTipo'].">"."</div>".

					"<div class='texto-contendor '>"."<img class='genero' src=".$rows['imgGenero'].">"."</div>".

					"<div class='texto-contendor attack'>".$rows['Ataque']."</div>";
				}

				if($cantResultados == 0){
					echo "EL Pokemon Ingresado No fue Encontrado";
					echo "<br>";

					echo ListarTodos();
				}

			}else{

				echo ListarTodos();
			}

		}else{
			echo ListarTodos();
		}

		Function ListarTodos(){

			$host_db = "localhost:3306";
			$user_db = "root";
			$pass_db = "admin";
			$db_name = "pokemonsBaldoIgnacio";
			$tbl_name = "pokemon";

			$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

			if ($conexion->connect_error) {
				die("La conexion falló: " . $conexion->connect_error);
			}

			$sql = "SELECT 
			p.Id Id,
			p.Descripcion,
			p.Ataque,
			p.Imagen Imagen,
			t.Imagen imgTipo,
			g.Imagen imgGenero
			FROM pokemon p
			LEFT JOIN tipo t ON t.Id = p.IdTipo
			LEFT JOIN genero g ON g.Id = p.IdGenero";

			echo "<br>";
			
			$result=mysqli_query($conexion, $sql);

			while($rows=mysqli_fetch_assoc($result))
			{
				echo 
				"<h2>".$rows['Descripcion']."<a class='editarbtn' href='editar.php?id=". $rows['Id'] ."'> Editar</a><a class='editarbtn' href='borrar.php?Id=". $rows['Id'] ."'> Borrar</a><br>"."</h2>".

				"<div class='texto-contendor '>"."<img class='imagenes' src=".$rows['Imagen'].">"."</div>".

				"<div class='texto-contendor '>"."<img class='imagtipo' src=".$rows['imgTipo'].">"."</div>".

				"<div class='texto-contendor '>"."<img class='genero' src=".$rows['imgGenero'].">"."</div>".

				"<div class='texto-contendor attack'>".$rows['Ataque']."</div>";
			}
		}
		?>
			</main>
		</form>
	</body>
	</html>