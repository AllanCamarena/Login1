<?php

$usuario=$_POST['usuario'];
$password=$_POST['password'];


session_start();


$_SESSION['usuario'] = $usuario;

$conexion=mysqli_connect("pruebamysql1.mysql.database.azure.com","allan","SeguridadInformatica1","msyqlprueba1");

//seguridad media
$usuario = mysqli_real_escape_string($conexion, $usuario);
$password = mysqli_real_escape_string($conexion, $password);

// $consulta="SELECT*FROM usuario where usuario='$usuario' and password='$password'";
// $resultado=mysqli_query($conexion,$consulta);

$consulta = mysqli_prepare($conexion, "SELECT * FROM usuario where usuario=? and password=?");
mysqli_stmt_bind_param($consulta, "ss",$usuario,$password);
$resultado =mysqli_stmt_execute($consulta);
mysqli_stmt_execute($consulta);
$resultado = mysqli_stmt_get_result($consulta);


$filas=mysqli_num_rows($resultado);

if($filas){
    header("location:home.php");
}else{
    ?>
    <?php
    include("index.php");
    ?>
    <h1 class="bad">Error al iniciar sesion verifica tus datos</h1>
    <?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);

