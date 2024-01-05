<?php
    include("Conexion.php");
    $conexion = conectar();
    $boleta = $_GET['boleta'];
    $sql = "DELETE FROM alumnos WHERE boleta = '$boleta'";
    $query = mysqli_query($conexion,$sql);
    if($query){
        header("Location: ./Admin.php");
    }
?>