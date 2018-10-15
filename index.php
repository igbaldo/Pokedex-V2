<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<?php

	if(isset($_COOKIE["usuario"]))
	{
		$nombre = $_COOKIE["usuario"];
	}
	else
	{
		$nombre = "";
	}
	?>

	<form action="index.php" method="POST">
		Nombre:<br>
		<input type="text" name="nombre" value="<?php echo $nombre ?>"><br><br>
		Contraseña<br>
		<input type="password" name="contraseña" id="contraseña"><br><br>

		<input type="checkbox" name="recordar" value="recordar">Recordarme</input>
		<input type="submit" name="olvidar" value="olvidar"/>

		<br><br>
		<input type="submit" value="Enviar" name="enviar">
		<br><br>
	</form>

	<?php

	if(isset($_POST["enviar"]) && $_SERVER["REQUEST_METHOD"] == "POST")
	{

		if(isset($_POST["nombre"]) && isset($_POST["contraseña"]))
		{
			$host_db = "localhost:3306";
			$user_db = "root";
			$pass_db = "admin";
			$db_name = "pokemonsBaldoIgnacio";
			$tbl_name = "usuario";

			$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

			if ($conexion->connect_error) {
				die("La conexion falló: " . $conexion->connect_error);
			}

			$username = $_POST['nombre'];
			$password = $_POST['contraseña'];

			$sql = "SELECT * FROM $tbl_name WHERE Usuario = '$username' AND Clave = '$password'";

			$result = mysqli_query($conexion, $sql);

			$rows = mysqli_fetch_assoc($result);

			if(isset($rows))
			{
				$usuario = $rows['Usuario'];
				$clave = $rows['Clave'];

				if ($username == $usuario && $password == $clave) { 
					$_SESSION["login"] = 1;

					if(isset($_POST["recordar"]))
		  			{
		  				setcookie("usuario", $username,0,"/");	
		  			}

					//MANDAR AL LISTADO DE POKEMONS
					header("Location: busquedaPokemon.php");

				} else { 
					echo "Username o Password estan incorrectos.";
				}
			}
		}
	}

	if(isset($_POST["olvidar"]))
	{
		setcookie("usuario", $nombre,Time()-3600,"/");	
	}

	?>
</body>
</html>