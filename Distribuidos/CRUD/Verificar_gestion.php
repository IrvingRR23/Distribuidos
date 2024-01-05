<?php
    include("Conexion.php");
    $con=conectar();
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $query = mysqli_query($con,"SELECT * FROM gestion WHERE correo = '$correo' AND contrasena = '$pass'");
    
    // Verifica si la consulta se ejecutó correctamente y si se encontraron resultados
    if (mysqli_num_rows($query) > 0) {
        // Inicio de sesión exitoso
        header("Location: ./Admin.php");
    }else {
        // Redirecciona a la página de inicio si se intenta acceder directamente a este script sin enviar el formulario
        echo '
            <script>
                alert("El correo o la contraseña son incorrectos");
                window.location = "../formulario_gestion.html";
            </script>
            ';
            exit();
        }
?>