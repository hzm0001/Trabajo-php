<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(strlen($temp_id_videojuego)==0){
        $err_id_videojuego = "Campo obligatorio";
    }else{
        if(filter_var($temp_id_videojuego. FILTER_VALIDATE_INT)===FALSE){
            $err_id_videojuego = "Introduce un número";
        }else{
            if(strlen($temp_id_videojuego)>8){
                $err_id_videojuego = "Máximo 8 dígitos";
            }else{
                $id_videojuego = $temp_id_videojuego;
            }
        }
    }
    ?>
</body>
</html>