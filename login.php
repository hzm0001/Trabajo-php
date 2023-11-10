<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require './bootsrap.php' ?>

    <title>Document</title>

</head>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $_servidor = 'localhost';
        $_usuario = 'root';
        $_contrasena = 'medac';
        $_base_de_datos = 'amazon';

        $conexion = new Mysqli(
            $_servidor ,
            $_usuario,
            $_contrasena,
            $_base_de_datos
        )
            or die("Error de conexión");

        //
        $usuario = $_POST["usuario"];
        $contrasenia = $_POST["contrasenia"];
        
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $resultado = $conexion -> query($sql);

        if($resultado -> num_rows === 0){
            echo "El usuario/contraseña son incorrectos";
        }else{

            while($fila = $resultado -> fetch_assoc()){ //coje una tabla y cada fila la transforma en una array
                $password_cifrada = $fila["contrasena"];
            }

            $acceso_valido = password_verify($contrasenia, $password_cifrada);

            if($acceso_valido){
                session_start();
                $_SESSION["usuario"] = $usuario;
                header('location: producto.php');
            }else{
                echo "El usuario/contraseña son incorrectos";
            }
    }}
    ?>
    <div class="mb-3 w-100" style="display: flex; justify-content:center; align-items:center;flex-direction:column;">
    <h1>Formulario para crear un nuevo Usuario</h1>
    <form action="" method="post" class="w-25 p-4" style="border: 1px solid gray; border-radius:10px">
        <label class="form-label">Usuario:</label>
        <input class="form-control" type="text" name="usuario">
        <?php if (isset($err_usuario)) echo $err_usuario ?>
        <br><br>
        <label class="form-label">Contraseña:</label>
        <input class="form-control" type="text" name="contrasenia">
        <br><br>
        <?php if (isset($err_fecha)) echo $err_fecha ?>
        <input class="btn btn-primary mb-3" type="submit" value="enviar">
    </form>
    </div>



</body>

</html>