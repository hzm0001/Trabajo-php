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
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "medac";
$dbname = "amazon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];

// Insertar los datos en la tabla "Productos"
$sql = "INSERT INTO Productos (nombreProducto, precio, descripcion, cantidad) VALUES ('$nombre', $precio, '$descripcion', $cantidad)";

if ($conn->query($sql) === TRUE) {
    echo "Producto guardado exitosamente";
} else {
    echo "Error al guardar el producto: " . $conn->error;
}

$conn->close();
?>

    <div class="mb-3">
    <h1>Formulario para crear un nuevo producto</h1>
    <form action="" method="post">
        <label class="form-label" >Nombre del producto:</label>
        <input class="form-control" type="text" name="producto">
        <?php if(isset($err_usuario)) echo $err_usuario?>
        <br><br>
        <label class="form-label" >Precio:</label>
        <input class="form-control" type="number" name="precio">
        <?php if(isset($err_nombre)) echo $err_nombre?>
        <br><br>
        <label class="form-label" >Descripción:</label>
        <input class="form-control" type="text" name="descripcion">
        <?php if(isset($err_apellido)) echo $err_apellido?>
        <br><br>
        <label class="form-label" for="">Cantidad</label>
        <input class="form-control" type="number" name="cantidad" ><br>
        <input class="btn btn-primary mb-3" type="submit" value="enviar">
    </form>
    </div>
</body>
</html>