<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <?php require "conexion.php" ?>
</head>
<body>
    <h1>Formulario de Productos</h1>
    
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nombreProducto">Nombre del Producto:</label>
        <input type="text" id="nombreProducto" name="nombreProducto" maxlength="40" required><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" min="0" max="99999.99" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" maxlength="255" required></textarea><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" min="0" max="99999" required><br><br>
        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input class="form-control" type="file" name="imagen">
        </div>
        <input type="submit" value="Registrar Producto">
    </form>

    <?php
    $nombre_fichero= $_FILES["imagen"]["name"];
    $ruta_termporal =$_FILES["imagen"]["tmp_name"];
    $formato = $_FILES["imagen"]["type"];
    $ruta_final = "imagenes/" . $nombre_fichero;

    move_uploaded_file($ruta_termporal, $ruta_final);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreProducto = $_POST["nombreProducto"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $cantidad = $_POST["cantidad"];

    
    if (strlen($nombreProducto) > 40) {
        die("Error: El nombre del producto debe tener como máximo 40 caracteres.");
    }

    if ($precio < 0 || $precio > 99999.99) {
        die("Error: El precio debe estar entre 0 y 99999.99.");
    }

    if (strlen($descripcion) > 255) {
        die("Error: La descripción debe tener como máximo 255 caracteres.");
    }

    if ($cantidad < 0 || $cantidad > 99999) {
        die("Error: La cantidad debe estar entre 0 y 99999.");
    }

    $consulta = "INSERT INTO Productos (nombreProducto,precio,descripcion,cantidad, imagen) VALUES ('$nombreProducto','$precio','$descripcion','$cantidad', '$ruta_final')";
    $conexion->query($consulta);
}
?>

</body>
</html>
