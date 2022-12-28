<?php

include('model/querys.php');

$totalNeto = 0.00;
$querys = new Querys();
$numeroFactura = '';
$detalleFactura = '';
$productos = $querys->getListaProductos();

require 'views/index-view.php';
?>