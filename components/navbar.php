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
<?php echo "<h1>Bienvenid@: " . $_SESSION["usuario"] . "</h1>" ?>