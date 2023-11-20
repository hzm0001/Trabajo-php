<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require './bootsrap.php' ?>
    <link rel="stylesheet" href="./css/cesta.css">
    <title>Cesta</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid divaeditar">
    <a class="navbar-brand" href="#"><img src="/img/amazom.jpg" alt=""></a>
    <button class="navbar-toggler butoncito" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">

            <?php session_start();
             if (isset($_SESSION["usuario"])) {
                echo '<a style= color: white; href="./logout.php">Logout</a>';
            } else {
              echo '<a style= color: white; href="./login.php">Login</a>';
            }?>
  </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="listado_productos.php">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>
    </div>
  </div>
</nav> 

<?php
 
  echo "<h1>Cesta de: " . $_SESSION["usuario"] . "</h1>"; 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $precio = floatval($_POST['precio']);
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
  }
  $sql = "SELECT * FROM ProductosCestas";

  echo "<div class='tabla_listado'>";
  echo "<table class='table table-borderless tablita' style='width:80em; float:center'>";
  echo "<thead class='table-danger'>";
  echo "<tr>";
  echo "<th class='a' scope='col' >Nombre</th>";
  echo "<th class='a' scope='col' >Imagen</th>";
  echo "<th class='a' scope='col' >Precio por unidad</th>";
  echo "<th class='a' scope='col' >Cantidad</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";

?>
</body>
</html>