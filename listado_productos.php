<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require './bootsrap.php' ?>
  <link rel="stylesheet" href="./css/listado_productos.css">

  <title>Listado productos</title>
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
echo "<h1>Bienvenid@: " . $_SESSION["usuario"] . "</h1>"; 
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
    // Muestra el botón de "Añadir Producto"
    echo '<a class= href="producto.php"><button>Añadir Producto</button></a>';
}
  require './bd.php';
  // Consulta para obtener los nombres de los productos y sus imágenes
  $sql = "SELECT * FROM productos";
  $result = $conn->query($sql);
  echo "<div class='tabla_listado'>";
  echo "<table class='table table-borderless tablita' style='width:80em; float:center'>";
  echo "<thead class='table-danger'>";
  echo "<tr>";
  echo "<th class='a' scope='col' >Id</th>";
  echo "<th class='a' scope='col' >Nombre</th>";
  echo "<th class='a' scope='col' >Precio</th>";
  echo "<th class='a' scope='col' >Descripcion</th>";
  echo "<th class='a' scope='col' >Cantidad</th>";
  echo "<th class='a' scope='col' >Imagen</th>";
  echo "<th class='a' scope='col' >Añadir producto</th>";

  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td class="b">' . $row["idProducto"] . '</td>';
      echo '<td class="b">' . $row["nombreProducto"] . '</td>';
      echo '<td class="b">' . $row["precio"] . '</td>';
      echo '<td class="b">' . $row["descripcion"] . '</td>';
      echo '<td class="b">' . $row["cantidad"] . '</td>';
      echo '<td class="b"><img src="' . $row["imagen"] . '" alt="' . $row["nombreProducto"] . '" width="100" height="100"></td>';
      echo '<td class="b"><button type="button" class="btn btn-warning"> <a href="cesta.php">Añadir cestaa </a></button><input type="number" max="5"; min="1"; style="width:40px;"></td>';
      echo '</tr>';
    }
  } else {
    echo "<li>No hay productos disponibles</li>";
  }
  echo "</div>";
  $conn->close();



  ?>



</body>

</html>