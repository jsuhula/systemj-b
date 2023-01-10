<?php

include('model/querys.php');
date_default_timezone_set('America/Guatemala');

$querys = new Querys();
$productos = $querys->obtenerListaProductos();
$productosArray = json_encode($querys->obtenerListaProductos()->fetch_all());
$numeroFactura = $querys->obtenerNumeroUltimaFactura()->fetch_assoc();
$fecha = date('Y-m-d');


require 'views/index-view.php';
?>