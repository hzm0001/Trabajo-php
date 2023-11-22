<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php require './bootsrap.php' ?>
  <link rel="stylesheet" href="../views/styles/producto.css">
</head>

<body>

  <?php
  require './bd.php';
  session_start();
  $success = '';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $precio = floatval($_POST['precio']);
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    if (strlen($nombre) > 40) {
      die("Error: El nombre del producto debe tener como máximo 40 caracteres.");
    }

    if ($precio < 0 || $precio > 99999.99) {
      $error = '<div class="alert alert-primary" role="alert">
         El precio no esta entre 0 y 99999.99.
         </div>';
    }


    if (strlen($descripcion) > 255) {
      die("Error: La descripción debe tener como máximo 255 caracteres.");
    }

    if ($cantidad < 0 || $cantidad > 99999) {
      die("Error: La cantidad debe estar entre 0 y 99999.");
    }


    $nombre_fichero = $_FILES["imagen"];
    $nombre_fichero = $nombre_fichero['name'];
    $ruta_termporal = $_FILES["imagen"]["tmp_name"];
    $formato = $_FILES["imagen"]["type"];
    $ruta_final = "../views/img" . $nombre_fichero;

    move_uploaded_file(
      $ruta_termporal,
      $ruta_final
    );

    // Insertar los datos en la tabla "Productos"

    $sql = "INSERT INTO Productos (nombreProducto, precio, descripcion, cantidad, imagen) VALUES ('$nombre', '$precio', '$descripcion', '$cantidad', '$ruta_final')";

    if ($conn->query($sql) == TRUE) {
      $success =  '<div class="alert alert-success" role="alert">
            Producto añadido con éxito
          </div>';
    } else {
      echo "Error al añadir producto";
    }
  }

  $conn->close();
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid divaeditar">
      <a class="navbar-brand" href="#"><img src="../views/img/amazom.jpg" alt=""></a>
      <button class="navbar-toggler butoncito" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">Logueate</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="listado_productos.php">Productos</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="mb-3 d-flex" style="flex-direction:column; justify-content:center; align-items:center;">
    <h1 class="h1-producto">Formulario para crear un nuevo producto</h1>
    <form action="" method="post" enctype="multipart/form-data" style="border: 1px solid black;width:33%;border-radius:15px;padding:3em">
      <label class="form-label">Nombre del producto:</label>
      <input class="form-control" type="text" name="nombre">
      <?php if (isset($err_usuario)) echo $err_usuario ?>
      <br><br>
      <label class="form-label">Precio:</label>
      <input class="form-control" type="number" name="precio">
      <?php if (isset($err_nombre)) echo $err_nombre ?>
      <br><br>
      <label class="form-label">Descripción:</label>
      <input class="form-control" type="text" name="descripcion">
      <?php if (isset($err_apellido)) echo $err_apellido ?>
      <br><br>
      <label class="form-label" for="">Cantidad</label>
      <input class="form-control" type="number" name="cantidad"><br>
      <label class="form-label">Imagen</label>
      <input class="form-control" type="file" accept=".jpg, .jpeg, .png" maxlength="5000000" name="imagen">
      <input class="btn btn-primary mb-3" type="submit" value="enviar">
    </form>
  </div>
  <?php if (isset($success)) echo $success ?>
</body>

</html>