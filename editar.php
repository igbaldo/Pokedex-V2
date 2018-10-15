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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="recursos/css/style.css">
    <title>Editar</title>
</head>
<body>
<main>
        <?php
        if (isset($_GET["id"]))
        {

            $codigoPokemon = $_GET["id"];

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
                WHERE p.Id ='".$codigoPokemon."'";

            $result = mysqli_query($conexion, $sql);

            $rows = mysqli_fetch_assoc($result);

            if(isset($rows))
            {
                $nombre = $rows['Descripcion'];
                $imagen = $rows['Imagen'];
                $ataque = $rows['Ataque'];
            }
        } 
        ?>

        <section>
           <article>
               <form name="form" method="post">

                    <label  class="labelform" for="nombre">Nombre:</label>
                    <input type="text"  class="inputform" id="nombre" name="nombre" value='<?php echo $nombre; ?>'>

                    <label class="labelform"  for="imagen">Imagen:</label>
                    <input type="text" class="inputform"  id="imagen" name="imagen" value='<?php echo $imagen; ?>'>

                    <label class="labelform" for="ataque">Ataque:</label>
                    <input class="inputform" type="text" id="ataque" name="ataque" value='<?php echo $ataque; ?>'>>

                   <select class="selectform" name="tipo" id="tipo">
                        <option value="1">Fire</option>
                        <option value="2">Grass</option>
                        <option value="3">Water</option>
                    </select>
                    
                    <select class="selectform" name="sexo" id="sexo">
                    <option value="2">Female</option>
                    <option value="1">Male</option>
                    </select>

                    <input class="nvoboton" src="adminindex.php" name="cerrar" type="submit" value="Cerrar">
                    <input class="nvoboton" type="submit" name="modificar" value="Guardar">
                    <div class="clear"></div>
                </form>
           </article>
        </section>
    </main>
    
    <?php
        if(isset($_POST["modificar"])){
            $nombre=$_POST['nombre'];
            $nombre=ucfirst($nombre);
            $imagen=$_POST['imagen'];
            $imagen=$_POST['ataque'];
            $tipo=$_POST['tipo'];
            $sexo=$_POST['sexo'];

            $sql2 = "UPDATE Pokemon SET Descripcion = '".$nombre."',Imagen ='".$imagen."',IdTipo=".$tipo.",IdGenero=".$sexo." WHERE id =".$codigoPokemon."";
            echo $sql2;

            $result=mysqli_query($conexion,$sql2);
            echo "<p class='labelform editado'>Editado Correctamente</p>";

        }
        if(isset($_POST["cerrar"])){
            header('location:pokedex.php');
        }
    ?>
</body>
</html>
