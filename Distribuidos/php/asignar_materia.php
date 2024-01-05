<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sarpa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_asignar_materia'])) {
    $boleta_asignar = $_POST["boleta_asignar"];
    $nombre_materia_asignar = $_POST["nombre_materia_asignar"];

    $verificar_asignacion = "SELECT * FROM calificaciones 
                             INNER JOIN materias ON calificaciones.id_materia = materias.id_materia
                             WHERE calificaciones.boleta_alumno = $boleta_asignar 
                             AND materias.nombre = '$nombre_materia_asignar'";

    $resultado_verificacion = $conn->query($verificar_asignacion);

    if ($resultado_verificacion->num_rows == 0) {
        $sql_asignar_materia = "INSERT INTO calificaciones (boleta_alumno, id_materia) 
                                VALUES ($boleta_asignar, (SELECT id_materia FROM materias WHERE nombre = '$nombre_materia_asignar'))";

        if ($conn->query($sql_asignar_materia) === TRUE) {
            echo "Materia asignada correctamente";
        } else {
            echo "Error al asignar la materia: " . $conn->error;
        }
    } else {
        echo "La materia ya está asignada a este alumno";
    }
}

$conn->close();
?>
