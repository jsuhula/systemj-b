<?php

date_default_timezone_set('America/Guatemala');

include('../model/querys.php');
$querys = new Querys();

$nombreCliente = isset($_POST['nombreCliente']) ? $_POST['nombreCliente'] : '';
$direccionCliente = isset($_POST['direccionCliente']) ? $_POST['direccionCliente'] : '';
$estadoFactura = isset($_POST['estadoFactura']) ? $_POST['estadoFactura'] : '';

$idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : '';
$nombreProducto = isset($_POST['nombreProducto']) ? $_POST['nombreProducto'] : '';
$precioProducto = isset($_POST['precioProducto']) ? $_POST['precioProducto'] : '';
$cantidadProductoComprado = isset($_POST['cantidadProductoComprado']) ? $_POST['cantidadProductoComprado'] : '';
$stockProducto = isset($_POST['stockProduct']) ? $_POST['stockProduct'] : '';

$opcion = isset($_POST['opcion']) ? $_POST['opcion'] : '';
$nuevaFactura = isset($_POST['nuevaFactura']) ? $_POST['nuevaFactura'] : false;
$totalNeto = 0.00;
$fecha = date('Y-m-d');


switch ($opcion) {
    case 'NFAC':
        //GENERA UNA NUEVA FACTURA EN LA BASE DE DATOS
        if ($nombreCliente !== '' && $direccionCliente !== '') {
            $RESULT = $querys->realizarOrden($nombreCliente, $direccionCliente, $fecha);
            echo $RESULT == 1;
        }
        break;
    case 'ADPRTO':
        if (empty($cantidadProductoComprado || $stockProducto || $idProducto)) {
            ?>
            <div class="ventana-agregar">
                <div class="contenedor-agregar">
                    <h2>AGREGAR PRODUCTOS</h2>
                    <div id="producto-agregado">
                        <p><b>PRODUCTO: </b>
                            <?php echo $nombreProducto; ?> <b> Q</b><?php echo $precioProducto; ?>
                        </p>
                    </div>
                    <hr>
                    <div class="cantidad-comprada"> <label for="cantidad-comprada">CANTIDAD: </label>
                        <input type="number" id="cantidad-comprada" placeholder="--">
                    </div>
                    <script>

                    </script>
                    <hr>
                    <div class="estado-agregar-producto"></div>
                    <div class="btn-agregar">
                        <a id="listo" href="#">LISTO</a>
                    </div>
                </div>
            </div>
            <?php
        } else {
            $numeroFactura = $querys->obtenerNumeroUltimaFactura()->fetch_assoc();
            $RESULT = $querys->agregarProductoFactura($numeroFactura['NUMEROFACTURA'], $idProducto, $cantidadProductoComprado);
            if ($RESULT == 1) {
                ?>
                <p class="texto-exitoso texto-centrado">Se agrego el producto</p> <?php
            } else {
                ?> <p class="texto-error texto-centrado">Ocurrio un error interno</p>
                <?php
            }
        }
        break;
    case 'ACTFAC':
        if ($nuevaFactura == true) {
            $numeroFacturaActual = $querys->obtenerNumeroUltimaFactura()->fetch_assoc();
            $detalleFactura = $querys->obtenerFactura($numeroFacturaActual['NUMEROFACTURA']);
        }
        ?>
        <table>
            <thead class="nombre-columna">
                <th>ACCION</th>
                <th>PRODUCTO</th>
                <th>CANTIDAD</th>
                <th>PRECIO</th>
                <th>TOTAL Q.</th>
            </thead>
            <tbody class="cuerpo-tabla">
                <?php if (!empty($detalleFactura)) {
                    while ($row = $detalleFactura->fetch_assoc()) { ?>
                        <tr>
                            <td>
                                <div class="btn-agregar">
                                    <a id="quitar-producto"
                                        href="javascript:quitarProducto('<?php echo $row['PRODUCTID'] ?>');">quitar</a>
                                </div>
                            </td>
                            <td>
                                <?php echo $row['PRODUCTO']; ?>
                            </td>
                            <td>
                                <?php echo $row['CANTIDAD']; ?>
                            </td>
                            <td>
                                <?php echo sprintf('%.2f', $row['PRECIO']); ?>
                            </td>
                            <td class="texto-derecho">
                                <?php echo sprintf('%.2f', $row['SUBTOTAL']); ?>
                            </td>
                        </tr>
                        <?php $totalNeto += sprintf('%.2f', $row['SUBTOTAL']);
                    }
                } else { ?>
                    <td>SIN</td>
                    <td>DATOS</td>
                    <td>PARA</td>
                    <td>MOSTRAR</td>
                    <td>!</td>
                <?php } ?>
            </tbody>
            <tfoot class="pie-tabla">
                <th></th>
                <th></th>
                <th></th>
                <th>SUB TOTAL</th>
                <th class="texto-derecho">
                    <?php echo sprintf('%.2f', $totalNeto); ?>
                </th>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>TOTAL</b></td>
                    <td class="texto-derecho"><b>
                            <?php echo sprintf('%.2f', $totalNeto); ?>
                        </b></td>
                </tr>
            </tfoot>
        </table>
        <?php
        break;
    case 'QUIT':
        $numeroFactura = $querys->obtenerNumeroUltimaFactura()->fetch_assoc();
        $RESULT = $querys->quitarProductoFactura($idProducto, $numeroFactura['NUMEROFACTURA']);
        echo $RESULT == 1;
        break;
    default:
        echo 'No existe la opcion';
        break;
}
?>