<?php
    include("Conexion.php");
    $conexion = conectar();
    $boleta = $_GET['boleta_alumno'];
    $sql = "DELETE FROM calificaciones WHERE boleta_alumno = '$boleta'";
    $query = mysqli_query($conexion,$sql);
    if($query){
        header("Location: ../CRUD/Admin.php");
    }
?>