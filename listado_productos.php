<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require './bootsrap.php' ?>
    <link rel="stylesheet" href="css/listado_productos.css">

    <title>Listado productos</title>

    <?php 
        session_start();
    
        //comprobar si ha iniciado sesion y si no pues le pondremos la sesion con valor a invitado y un boton de login y si ha iniciado le pondremos un boton de logout
        if(isset($_SESSION["usuario"])){
            echo '<a href="./logout.php">Logout</a>';
            echo '<a href="./producto.php">Añadir producto</a>';
        }else{
            echo '<a href="./login.php">Login</a>';
        }
        require './bd.php';

        // Consulta para obtener los nombres de los productos y sus imágenes
        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);
        echo "<table class='table table-borderless'>";
        echo "<thead class='table-danger'>";
        echo "<tr>";
        echo "<th class='a' scope='col' >id</th>";
        echo "<th class='a' scope='col' >nombre</th>";
        echo "<th class='a' scope='col' >precio</th>";
        echo "<th class='a' scope='col' >descripcion</th>";
        echo "<th class='a' scope='col' >cantidad</th>";
        echo "<th class='a' scope='col' >imagen</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["idProducto"] . '</td>';
                echo '<td>' . $row["nombreProducto"] . '</td>';
                echo '<td>' . $row["precio"] . '</td>';
                echo '<td>' . $row["descripcion"] . '</td>';
                echo '<td>' . $row["cantidad"] . '</td>';
                echo '<td><img src="' . $row["imagen"] . '" alt="' . $row["nombre_producto"] . '" width="100" height="100"></td>';
                echo '</tr>';
            }
        } else {
            echo "<li>No hay productos disponibles</li>";
        }

        $conn->close();



    ?>
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
          <a class="nav-link active" aria-current="page" href="login.php">Logueate</a>
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
</body>
</html>