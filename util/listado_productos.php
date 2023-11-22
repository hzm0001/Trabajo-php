<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require './bootsrap.php' ?>
    <link rel="stylesheet" href="../views/styles/listado_productos.css">

    <title>Listado productos</title>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid divaeditar">
    <a class="navbar-brand" href="#"><img src="../views/img/amazom.jpg" alt=""></a>
    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
      </ul>
    </div>
  </div>
</nav>            
    <?php
    require './bd.php';
    $usuario = $_SESSION["usuario"];
    echo "<h3>Bienvenid@: " . $usuario . "</h3>";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $sql = "SELECT idCesta FROM cestas WHERE usuario = '$usuario'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                $idCesta = $row["idCesta"];
            }

            $cantidad = $_POST['cantidad'];
            $idProducto = $_POST["idProducto"];

            // Comprobar si el producto ya está en la cesta
            $sqlCheck = "SELECT EXISTS(SELECT 1 FROM productoscestas WHERE idProducto = '$idProducto' AND idCesta = '$idCesta')";
            $resultCheck = $conn->query($sqlCheck);
            $productoExistente = mysqli_fetch_row($resultCheck)[0];
            

            if ($productoExistente) {
                // El producto ya está en la cesta, actualiza la cantidad
                $sqlUpdate = "UPDATE productoscestas SET cantidad = cantidad + $cantidad WHERE idProducto = '$idProducto' AND idCesta = '$idCesta'";
                $conn->query($sqlUpdate);

                // Después de insertar el producto en la cesta, actualiza la cantidad en el inventario
                $sqlUpdateInventario = "UPDATE productos SET cantidad = cantidad - $cantidad WHERE idProducto = '$idProducto'";
                $conn->query($sqlUpdateInventario);
            } else {
                // El producto no está en la cesta, inserta un nuevo registro
                $sqlCest = "INSERT INTO productoscestas (idProducto, idCesta, cantidad) VALUES ('$idProducto', $idCesta, '$cantidad')";
                $conn->query($sqlCest);
            }
        } else {

            echo "Error: No se encontró la cesta del usuario.";
        }
    }


    if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
        // Muestra el botón de "Añadir Producto"
        
        echo "<a href='producto.php'><button class='btn btn-dark' >Subir producto</button></a>";
    }
   
    echo     "<a href='cesta.php'><button  class='btn btn-secondary cesta'>Cesta</button></a>";




    
    // Consulta para obtener los nombres de los productos y sus imágenes
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table table-borderless'>";
        echo "<thead class='table-danger'>";
        echo "<tr>";
        echo "<th class='a' scope='col' >id</th>";
        echo "<th class='a' scope='col' >nombre</th>";
        echo "<th class='a' scope='col' >precio</th>";
        echo "<th class='a' scope='col' >descripcion</th>";
        echo "<th class='a' scope='col' >cantidad</th>";
        echo "<th class='a' scope='col' >imagen</th>";
        echo "<th class='a' scope='col' >Añadir Cesta</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td class="b">' . $row["idProducto"] . '</td>';
            echo '<td class="b">' . $row["nombreProducto"] . '</td>';
            echo '<td class="b">' . $row["precio"] . '</td>';
            echo '<td class="b">' . $row["descripcion"] . '</td>';
            echo '<td class="b">' . $row["cantidad"] . '</td>';
            echo '<td class="b"><img src="' . $row["imagen"] . '" alt="' . $row["nombreProducto"] . '" width="100" height="100"></td>';
            ?>
            <td class="b">
                <form action="" method="post">
                    <input type="hidden" name="idProducto" value="<?php echo $row["idProducto"] ?>">
                    <input type="number" name="cantidad" id="" min="1" max="5">
                    <input class="btn btn-dark" type="submit" value="Añadir a la cesta">
                </form>
            </td>
            <?php
            echo '</tr>';
        }
    } else {
        echo "<li>Producto agotado</li>";
    }
    $conn->close();



    ?>
  
</body>

</html>