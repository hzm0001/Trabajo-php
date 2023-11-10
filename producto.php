<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $_servidor = 'localhost';
        $_usuario = 'root';
        $_contrasena = 'medac';
        $_base_de_datos = 'amazon';

        $conexion = new Mysqli(
            $_servidor ,
            $_usuario,
            $_contrasena,
            $_base_de_datos
        )
            or die("Error de conexión");
            

        //
        $idProducto = $_POST["idProducto"];
        $nombreProducto = $_POST["nombreProducto"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $cantidad = $_POST["cantidad"];


    
        if (
            isset($idProducto) && isset($nombreProducto)
            && isset($precio) && isset($descripcion) && isset($cantidad)
        ) {

            //introduce datos en la base de datos
            $sql = "INSERT INTO productos (idProducto,nombreProducto,precio,descripcion,cantidad)
                VALUES ('$idProducto', '$nombreProducto', '$precio', '$descripcion', '$cantidad')";

            $conexion->query($sql);
        }
    }
    ?>


    <h1>Formulario para crear un nuevo producto</h1>
    <form action="" method="post">
        <label >Nombre del producto:</label>
        <input type="text" name="producto">
        <?php if(isset($err_usuario)) echo $err_usuario?>
        <br><br>
        <label >Precio:</label>
        <input type="number" name="precio">
        <?php if(isset($err_nombre)) echo $err_nombre?>
        <br><br>
        <label >Descripción:</label>
        <input type="text" name="descripcion">
        <?php if(isset($err_apellido)) echo $err_apellido?>
        <br><br>
        <label for="">Cantidad</label>
        <input type="text" name="cantidad" ><br>
        <input type="submit" value="enviar">
    </form>
</body>
</html>