<?php
    include("Conexion.php");
    $con=conectar();
    $boleta = $_POST['boleta'];
    $pass = $_POST['pass'];
    $query = mysqli_query($con,"SELECT * FROM alumnos WHERE boleta = '$boleta' AND pass = '$pass'");
    
    // Verifica si la consulta se ejecutó correctamente y si se encontraron resultados
    if (mysqli_num_rows($query) > 0) {
        // Inicio de sesión exitoso
        header("Location: ./Index_alumno(no_oficial).php");
    }else {
        // Redirecciona a la página de inicio si se intenta acceder directamente a este script sin enviar el formulario
        echo '
            <script>
                alert("La Boleta o la contraseña son incorrectos");
                window.location = "../formulario.html";
            </script>
            ';
            exit();
        }
?>