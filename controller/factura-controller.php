<?php


$nombreCliente = isset($_POST['nombreCliente']) ? $_POST['nombreCliente'] : '';
$direccionCliente = isset($_POST['direccionCliente']) ? $_POST['direccionCliente'] : '';
$estadoFactura = isset($_POST['estadoFactura']) ? $_POST['estadoFactura'] : '';

$idProducto = $_POST['idProducto'];
$cantidadProductoComprado = $_POST['cantidadProductoComprado'];
$stockProducto = $_POST['stockProducto'];

if ($nombreCliente === '' && $direccionCliente === '') {
    if ($idProducto > 10) {
?>
<p class="texto-exitoso texto-centrado">Se agrego a la factura</p>
<?php
    } else {
?>
<p class="texto-error texto-centrado">Ocurrio un error de conexion</p>
<?php
    }
}

?>