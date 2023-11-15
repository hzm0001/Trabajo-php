<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require './bootsrap.php' ?>
    <link rel="stylesheet" href="./css/login.css">

    <title>Login</title>

</head>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $_servidor = 'localhost';
        $_usuario = 'root';
        $_contrasena = 'medac';
        $_base_de_datos = 'amazon';

        $conexion = new Mysqli(
            $_servidor,
            $_usuario,
            $_contrasena,
            $_base_de_datos
        )
            or die("Error de conexión");

        //
        $usuario = $_POST["usuario"];
        $contrasenia = $_POST["contrasenia"];

        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows === 0) {
            $error =  '<div class="alert alert-danger" role="alert">
            El usuario/contraseña son incorrectos
          </div>';
        } else {

            while ($fila = $resultado->fetch_assoc()) { //coje una tabla y cada fila la transforma en una array
                $password_cifrada = $fila["contrasena"];
            }

            $acceso_valido = password_verify($contrasenia, $password_cifrada);

            if ($acceso_valido) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                header('location: producto.php');
            } else {
                $error =  '<div class="alert alert-danger" role="alert">
            El usuario/contraseña son incorrectos
          </div>';
            }
        }
    }
    ?>
    <div class="intro">
        <div style="padding-right: 3em;">

            <img src="./img/amazom.jpg" alt="" width="400px">
        </div>
        <form action="" method="post" style="border-left: 2px solid rgb(238, 237, 237); padding-left:3em">
            <div class="caja">
                <h3 class="h3_login">Ingrese su cuenta</h3>
                <?php if (isset($error)) echo $error ?>
                <div class="cajaInterna">
                <label class="label_nombre">Usuario:</label>
                <input class="form-control" type="text" name="usuario">
                <?php if (isset($err_usuario)) echo $err_usuario ?>
                <br><br>
                <label class="label_nombre">Contraseña:</label>
                <input class="form-control" type="password" name="contrasenia">
                </div>
            </div>
            <div class="registro">
                <p class="texto-registrar">Si no tienes cuenta registrate</p>
                <a class="enlace_registrar" href="registro.php">  aquí</a>
            </div>
            <div class="enviar">
            <?php if (isset($err_fecha)) echo $err_fecha ?>
            <input class="btn btn-primary mb-3 boton" type="submit" value="Login">
            
            </div>
        </form>
    </div>



</body>

</html>