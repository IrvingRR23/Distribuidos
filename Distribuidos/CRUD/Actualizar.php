<?php
    include("Conexion.php");
    $conexion = conectar();
    $boleta = $_GET['boleta'];
    $sql = "SELECT * FROM alumnos WHERE boleta = '$boleta'";
    $query = mysqli_query($conexion,$sql);
    $row=mysqli_fetch_array($query);

    // Verificar si $row es un array y tiene las claves esperadas
    if (is_array($row) && !empty($row['boleta'])) {
        // El array tiene la clave 'boleta', puedes acceder a otras claves de manera segura

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sarpa</title>
    <link rel="stylesheet" href="./CSS/Estilos.css">
    <link rel="icon" href="../assets/img/Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Agregando los estilos proporcionados -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('../assets/img/fondo.avif');
            margin: 0;
            padding: 0;
        }

        .principal {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .titulo {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }

        .form-update {
            display: flex;
            flex-direction: column;
        }

        .controls,
        .botons {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .botons {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .botons:hover {
            background-color: #45a049;
        }

        label {
            margin-top: 10px;
            margin-bottom: 5px;
            text-align: center;
            color: #555;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }
    </style>
</head>
    <body>
    <div class="principal">
            <div class="contenedor">
                <h3 class="titulo">Actualizacion de Datos</h3>
                <section class="form-update">
                    <h4>Actualiza tus datos</h4>
                    <form action="./Update.php" method="POST" enctype="multipart/form-data">
                        <input class="controls" required="" type="number" placeholder="Boleta" name="txtboleta" value="<?php echo $row['boleta']?>"><br><br>
                        <input class="controls" required="" type="text" placeholder="Nombre" name="txtnombre" value="<?php echo $row['nombre']?>"><br><br>
                        <input class="controls" required="" type="text" placeholder="ApellidoP" name="txtapellidp" value="<?php echo $row['firstls']?>"><br><br>
                        <input class="controls" required="" type="text" placeholder="ApellidoM" name="txtapellidm" value="<?php echo $row['secondls']?>"><br><br>
                        <input class="controls" required="" type="text" placeholder="Email" name="txtemail" value="<?php echo $row['email']?>"><br><br>
                        <input class="controls" required="" type="text" placeholder="Contraseña" name="txtclave" value="<?php echo $row['pass']?>"><br><br>

                        <!-- Agregar campo para actualizar la imagen -->
                        <label for="img">Actualizar Imagen:</label>
                        <input type="file" name="img" accept="image/*"><br><br>

                        <input class="botons" type="submit" name="button" value="Actualizar">
</form>
                </section>
            </div>
        </div>
    </body>
</html>

<?php
    } else {
        // Manejar el caso en el que la consulta no devolvió resultados
        echo "No se encontraron datos para la boleta proporcionada.";
    }
?>