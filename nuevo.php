<?php
$host_db = "localhost:3306";
$user_db = "root";
$pass_db = "admin";
$db_name = "pokemonsBaldoIgnacio";
$tbl_name = "usuario";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
    die("La conexion falló: " . $conexion->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="recursos/css/style.css">
    <title>Nuevo</title>
</head>
<body>
    <main>
        <section>
         <article>
             <form name="form" method="post">

                <label class="labelform" for="nombre">Nombre:</label>
                <input class="inputform" type="text" id="nombre" name="nombre" value="">

                <label class="labelform" for="ataque">Ataque:</label>
                <input class="inputform" type="text" id="ataque" name="ataque" value="">

                <label class="labelform" for="imagen">Imagen:</label>
                <input class="inputform" type="text" id="imagen" name="imagen" value="">

                <select class="selectform" name="tipo" id="tipo">
                    <option value="1">Fuego</option>
                    <option value="2">Electrico</option>
                    <option value="3">Agua</option>
                </select>
                
                <select class="selectform" name="sexo" id="sexo">
                    <option value="2">Female</option>
                    <option value="1">Male</option>
                </select>

                <input class="nvoboton" src="busquedaPokemon.php" name="cerrar" type="submit" value="Cerrar">
                <input class="nvoboton" type="submit" name="enviar" value="Guardar">
                <div class="clear"></div>
            </div>
        </form>
    </article>
</section>
</main>
<?php
if(isset($_POST["enviar"])){

    $nombre=$_POST['nombre'];
    $nombre=ucfirst($nombre);
    $imagen=$_POST['imagen'];
    $tipo=$_POST['tipo'];
    $genero=$_POST['sexo'];
    $ataque=$_POST['ataque'];

    if(empty($nombre) ||empty($imagen) ||empty($tipo) ){
        
       echo "<p class='labelform editado'>Complete todos los datos para guardar</p>";

   }else{
    $sqlSelect="SELECT * FROM pokemon WHERE Descripcion = '$nombre'";
    
    $results = mysqli_query($conexion, $sqlSelect);
    $row = mysqli_fetch_assoc($results);

    if(!($row['Descripcion'] == $nombre)){
        
        $sqlInsert="INSERT INTO Pokemon (Descripcion, Ataque, Imagen, IdTipo, IdGenero) 
        VALUES('".$nombre."','".$ataque."','".$imagen."',".$tipo.",".$genero.");";         
        
        $result=mysqli_query($conexion,$sqlInsert);

        echo "<p class='labelform editado'>Guardado Correctamente</p>";
        
    }
    else{
        echo "<p class='labelform editado'>El Pókemon Ingresado ya Existe</p>";
    }
}            
}
if(isset($_POST["cerrar"])){
    header('location:busquedaPokemon.php');
}

?>
</body>
</html>
