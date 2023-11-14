<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require './bootsrap.php' ?>
    <link rel="stylesheet" href="./css/producto.css">
</head>

<body>

    <?php
    require './bd.php';
    $success = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $precio = floatval($_POST['precio']);
        $descripcion = $_POST['descripcion'];
        $cantidad = $_POST['cantidad'];
        $sql = "INSERT INTO Productos (nombreProducto, precio, descripcion, cantidad) VALUES ('$nombre', $precio, '$descripcion', $cantidad)";

        if ($conn->query($sql) == TRUE) {
            $success =  '<div class="alert alert-success" role="alert">
            Producto añadido con éxito
          </div>';
        } else {
            echo "Error al añadir producto";
        }
    }


    // Insertar los datos en la tabla "Productos"


    $conn->close();
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid divaeditar">
    <a class="navbar-brand" href="#"><img src="/img/amazom.jpg" alt=""></a>
    <button class="navbar-toggler butoncito" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">Logueate</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="mb-3">
        <h1>Formulario para crear un nuevo producto</h1>
        <form action="" method="post">
            <label class="form-label">Nombre del producto:</label>
            <input class="form-control" type="text" name="nombre">
            <?php if (isset($err_usuario)) echo $err_usuario ?>
            <br><br>
            <label class="form-label">Precio:</label>
            <input class="form-control" name="precio">
            <?php if (isset($err_nombre)) echo $err_nombre ?>
            <br><br>
            <label class="form-label">Descripción:</label>
            <input class="form-control" type="text" name="descripcion">
            <?php if (isset($err_apellido)) echo $err_apellido ?>
            <br><br>
            <label class="form-label" for="">Cantidad</label>
            <input class="form-control" type="number" name="cantidad"><br>
            <input class="btn btn-primary mb-3" type="submit" value="enviar">
        </form>
    </div>
    <?php if (isset($success)) echo $success ?>
</body>

</html>