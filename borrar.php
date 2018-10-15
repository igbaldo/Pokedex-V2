	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
	</head>
	<body>

		<?php
		if (isset($_GET["Id"]))
		{

			$codigoPokemon = $_GET["Id"];

			$host_db = "localhost:3306";
			$user_db = "root";
			$pass_db = "admin";
			$db_name = "pokemonsBaldoIgnacio";
			$tbl_name = "pokemon";

			$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

			if ($conexion->connect_error) {
				die("La conexion falló: " . $conexion->connect_error);
			} 

			$sql = "DELETE FROM pokemon where Id = ".$codigoPokemon."";

			$result = mysqli_query($conexion, $sql);

			$rows = mysqli_fetch_assoc($result);

			echo "Pokemon Eliminado";

			header('location:busquedaPokemon.php');
		
		} 
		?>
	</body>
	</html>