<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $sql - "SELECT * FROM Productos";
    $resultado = $conexion -> query($sql);
    $productos = [];

    while($fila = $resultado -> fetch_assoc()){
        
    }
    ?>
</body>
</html>l