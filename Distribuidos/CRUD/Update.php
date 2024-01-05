<?php 
include("Conexion.php");
$con=conectar();

$boleta = $_POST['txtboleta'];
$nombre = $_POST['txtnombre'];
$apellidoP = $_POST['txtapellidp'];
$apellidoM = $_POST['txtapellidm'];
$email = $_POST['txtemail'];
$clave = $_POST['txtclave'];

$sql="UPDATE `alumnos` SET `boleta` = '$boleta', `nombre` = '$nombre', `firstls` = '$apellidoP', `secondls` = '$apellidoM',`email` = '$email', `pass` = '$clave' WHERE `boleta` = '$boleta'";
$query = mysqli_query($con,$sql);
if($query){
    header("Location: ./Admin.php");
}else{
    header("Location: ./Actualizar.php");
}
?>