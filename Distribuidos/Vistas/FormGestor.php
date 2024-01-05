<?php
// Autenticarse en la BD
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sarpa";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Alumnos</title>
    <link rel="icon" href="../assets/img/Logo.png">
    <link rel="stylesheet" href="../css/formularios.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container{
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            color: black;
            margin-bottom: 20px; /* Agregado para separar el título del formulario */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            margin-bottom: 5px;
            text-align: center;
            color: #555;
        }

        input,
        select {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p.message,
        p.error {
            margin-top: 10px;
            color: #333;
            font-weight: bold;
        }

        .select-container {
            display: flex;
            flex-direction: column; /* Cambiado de 'space-between' a 'column' */
        }

        .select-container div {
            margin-bottom: 10px; /* Agregado para separar las dos listas desplegables */
        }
    </style>
</head>

<body>

    <div class="container">
     

        <!-- Formulario para actualizar calificaciones -->
        <form action="../php/actualizar_calificacion.php" method="POST" enctype="multipart/form-data" class="form">

        <h2>Gestionar Calificaciones y Asignar Materias a Alumnos</h2>

            <div class="select-container">
                
            <label for="boleta_calificar">Boleta del Alumno:</label>
            <select name="boleta_calificar" id="boleta_calificar">
                <?php
                // Consulta SQL para obtener la lista de boletas desde la tabla alumnos
                $query_boletas = mysqli_query($conn, "SELECT boleta FROM alumnos");

                // Iterar sobre los resultados y generar opciones del menú desplegable
                while ($row_boleta = mysqli_fetch_array($query_boletas)) {
                    echo "<option value='" . $row_boleta['boleta'] . "'>" . $row_boleta['boleta'] . "</option>";
                }
                ?>
            </select>
        

        
            <label for="id_materia_calificar">Nombre de la Materia:</label>
            <select name="id_materia_calificar" id="id_materia_calificar">
                <?php
                // Consulta SQL para obtener la lista de materias desde la base de datos
                $query_materias = mysqli_query($conn, "SELECT id_materia, nombre FROM materias");

                // Iterar sobre los resultados y generar opciones del menú desplegable
                while ($row_materia = mysqli_fetch_array($query_materias)) {
                    echo "<option value='" . $row_materia['id_materia'] . "'>" . $row_materia['nombre'] . "</option>";
                }
                ?>
            </select>
        
            </div>

            <label for="calificacion_parcial1">Calificación Parcial 1:</label>
            <input type="text" name="calificacion_parcial1" id="calificacion_parcial1" placeholder="Ingrese la calificación del parcial 1">

            <label for="calificacion_parcial2">Calificación Parcial 2:</label>
            <input type="text" name="calificacion_parcial2" id="calificacion_parcial2" placeholder="Ingrese la calificación del parcial 2">

            <label for="calificacion_parcial3">Calificación Parcial 3:</label>
            <input type="text" name="calificacion_parcial3" id="calificacion_parcial3" placeholder="Ingrese la calificación del parcial 3">

            <button type="submit" name="btn_actualizar_calificacion">Actualizar Calificación</button>
            <p class="message"><?php if (isset($_GET['asignacion_result'])) {
                                    echo $_GET['asignacion_result'];
                                } ?></p>
        </form>
    </div>

</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>
