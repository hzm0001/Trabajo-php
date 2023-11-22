<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cesta</title>
  <link rel="stylesheet" href="../views/styles/cesta.css">
<?php require './bootsrap.php' ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid divaeditar">
    <a class="navbar-brand" href="#"><img src="../views/img/amazom.jpg" alt=""></a>
    <button class="navbar-toggler butoncito" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">

            <?php session_start();
             if (isset($_SESSION["usuario"])) {
                echo '<a href="./logout.php">Logout</a>';
            } else {
              echo '<a style= color: white; href="./login.php">Login</a>';
            }?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="listado_productos.php">Productos</a>
        </li>
      </ul>
    </div>
  </div>
</nav>            
<?php


require './bd.php';


$usuario = $_SESSION["usuario"];
$sql = "SELECT * FROM cestas WHERE usuario = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idCesta = $row["idCesta"];

    
    $sqlProducts = "SELECT p.idProducto, p.nombreProducto, p.imagen, pc.cantidad, p.precio
                    FROM productoscestas pc
                    INNER JOIN productos p ON pc.idProducto = p.idProducto
                    WHERE pc.idCesta = '$idCesta'";
    $resultProducts = $conn->query($sqlProducts);
    if ($resultProducts->num_rows > 0) {
         echo "<h2>Cesta de  " . $_SESSION["usuario"] . "</h2>"; 
        echo "<table class='tabla' border='1'>";
        echo "<tr>";
        echo "<th class='a'>Producto</th>";
        echo "<th class='a'>Imagen</th>";
        echo "<th class='a'>Cantidad</th>";
        echo "<th class='a'>Precio Unitario</th>";
        echo "<th class='a'>Precio Total</th>";
        echo"</tr>";

        $totalCesta = 0;

        while ($rowProduct = $resultProducts->fetch_assoc()) {
            $producto = $rowProduct["nombreProducto"];
            $imagen = $rowProduct["imagen"];
            $cantidad = $rowProduct["cantidad"];
            $precioUnitario = $rowProduct["precio"];
            $precioTotal = $cantidad * $precioUnitario;

            echo "<tr>";
            echo "<td>$producto</td><td><img src='$imagen' alt='$producto' width='100' height='100'></td><td>$cantidad</td><td>$precioUnitario €</td><td>$precioTotal €</td>";
            echo "</tr>";

            $totalCesta += $precioTotal;
        }

        echo "</table>";

     
        echo "<h4>Total de la Cesta: $totalCesta €</h4>";
    } else {
        echo "<p>No hay productos en la cesta.</p>";
    }
} else {
    echo "<p>No se encontró la cesta del usuario.</p>";
}

$conn->close();
?>
</body>
</html>