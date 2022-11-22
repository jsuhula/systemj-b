<?php
$errores = '';
$realizado = '';

if(isset($_POST['submit'])){
    $nombreCliente = $_POST['nombre_cliente'];
    $direccionCliente = $_POST['direccion_cliente'];

    if(!empty($nombreCliente)){
        $nombreCliente = trim($nombreCliente);
        $nombreCliente = htmlspecialchars($nombreCliente);
    }else{
        $errores .= 'Ingresa el nombre del cliente <br/>';
    }

    if(!empty($direccionCliente)){
        $direccionCliente = trim($direccionCliente);
        $direccionCliente = htmlspecialchars($direccionCliente);
    }else{
        $errores .= 'Ingresa la direccion <br/>';
    }

    if(empty($errores)){
        $realizado = true;
    }else{
        $realizado = false;
    }
}
    require 'views/index-view.php';
?>