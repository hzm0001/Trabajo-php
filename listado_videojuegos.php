<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $sql = "SELET * FROM videojuegos";
    $resultado = $conexion -> query($sql);
    $videojuegos = [];

    while($fila = $resultado -> fetch_assoc()){
        $id_videojuego = $fila["id_videojuego"];
        $titulo = $fila["titulo"];
        $pegi = $fila["pegi"];
        $compania = $fila["compania"];

        //$nuevo_videojuego = new Videojuego($id_videojuego, $titulo, $pegi, $compania);
        array_push($videojuegos, $nuevo_videojuego);
    }
    // function obetenerVideojuegosObjetos("SELECT * FROM videojuegos WHERE pegi=13);
    ?>
    <div class="container">
        <h1>Listado de videojuegos</h1>
    </div>
</body>
</html>