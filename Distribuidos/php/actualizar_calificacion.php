<!DOCTYPE HTML>  
<html>
<head>
<style>
  body {
    font-family: Arial, sans-serif;
  }
  .error {
    color: #FF0000;
  }
  .message {
    color: #008000;
  }
  .container {
    max-width: 600px;
    margin: 0 auto;
  }
  .neon{
      position: relative;
      display: inline-block;
      padding: 15px 30px;
      color: black;
      letter-spacing: 4px;
      font-size: 15px;
      text-align: none;
      overflow: hidden;
      transition: 0.2s;
    }

    .neon:hover{
      background: red;
      box-shadow: 0 0 10px red, 0 0 40px red, 0 0 80px red;
      transition-delay: 0.3s;
    } 

    .neon span{
      position: absolute;
      display: block;
    }

</style>
</head>
<body> 

<div class="container">
  <h2>Formulario de Calificaciones</h2>
  

  <?php
  // Definir las variables con cadenas vacías
  $boleta_calificar = $materia_calificar = $calificacion_parcial1 = $calificacion_parcial2 = $calificacion_parcial3 = "";
  $boleta_calificarErr = $materia_calificarErr = $calificacionErr = "";

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

  // Procesar el formulario de calificaciones si se ha enviado
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
      // Validar y recoger datos del formulario
      if (empty($_POST["boleta_calificar"])) {
          $boleta_calificarErr = "La boleta del alumno es requerida";
      } else {
          $boleta_calificar = test_input($_POST["boleta_calificar"]);
      }

      if (empty($_POST["id_materia_calificar"])) {
          $materia_calificarErr = "La materia es requerida";
      } else {
          $materia_calificar = test_input($_POST["id_materia_calificar"]);
      }

      if (empty($_POST["calificacion_parcial1"]) || empty($_POST["calificacion_parcial2"]) || empty($_POST["calificacion_parcial3"])) {
          $calificacionErr = "Todas las calificaciones son requeridas";
      } else {
          $calificacion_parcial1 = test_input($_POST["calificacion_parcial1"]);
          $calificacion_parcial2 = test_input($_POST["calificacion_parcial2"]);
          $calificacion_parcial3 = test_input($_POST["calificacion_parcial3"]);
      }

      // Verificar si ya existen calificaciones para este alumno y materia
      $verificar_calificacion = "SELECT * FROM calificaciones WHERE boleta_alumno = $boleta_calificar AND id_materia = $materia_calificar";
      $resultado_verificacion = $conn->query($verificar_calificacion);

      if ($resultado_verificacion->num_rows == 0) {
          // No hay calificaciones, realizar la inserción
          $sql_insert_calificacion = "INSERT INTO calificaciones (boleta_alumno, id_materia, calificacion_parcial1, calificacion_parcial2, calificacion_parcial3) VALUES ($boleta_calificar, $materia_calificar, $calificacion_parcial1, $calificacion_parcial2, $calificacion_parcial3)";

          if ($conn->query($sql_insert_calificacion) === TRUE) {
              echo '<p class="message">Calificaciones insertadas correctamente</p>';
          } else {
              echo '<p class="error">Error al insertar las calificaciones: ' . $conn->error . '</p>';
          }
      } else {
          // Ya hay calificaciones, realizar la actualización
          $sql_update_calificacion = "UPDATE calificaciones SET calificacion_parcial1 = $calificacion_parcial1, calificacion_parcial2 = $calificacion_parcial2, calificacion_parcial3 = $calificacion_parcial3 WHERE boleta_alumno = $boleta_calificar AND id_materia = $materia_calificar";

          if ($conn->query($sql_update_calificacion) === TRUE) {
              echo '<p class="message">Calificaciones actualizadas correctamente</p>';
          } else {
              echo '<p class="error">Error al actualizar las calificaciones: ' . $conn->error . '</p>';
          }
      }
  }

  // Cerrar la conexión
  $conn->close();
      
  function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
  ?>

</div>
<br><br><br>
<a  class = "neon" href="../CRUD/Admin_materias.php">Volver</a>
</body>
</html>
