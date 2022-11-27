<?php

include('model/querys.php');

$totalNeto = 0.00;
$querys = new Querys();
$numeroFactura = '';
$detalleFactura = '';
$productos = $querys->getListaProductos();

$row_nums = $productos->num_rows;

if(isset($_POST['submit'])){
    
}
    require 'views/index-view.php';
?>