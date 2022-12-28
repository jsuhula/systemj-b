<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store J&B</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src="js/lib/jquery-3.6.1.min.js"></script>
</head>

<body>
    <main class="main-program">
        <div class="contenedor">
            <div class="objetos-contenedor">
                <div class="factura">
                    <form method="post">
                        <div>
                            <h2 class="texto-centrado">NUEVA FACTURA</h2>
                            <div class="datos-cliente">
                                <label for="nombre">NOMBRE:</label>
                                <input type="text" id="nombre-cliente" required="true" placeholder="Nombre" value="">

                                <label for="direccion">DIRECCION:</label>
                                <input type="text" id="direccion-cliente" required="true" placeholder="Direccion"
                                    value="">
                            </div>
                        </div>
                        <div class="detallado-factura">
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
                                    while ($row = $detalleFactura) { ?>
                                    <tr>
                                        <td>
                                            <div class="btn-agregar">
                                                <a id="quitar-producto"
                                                    href="javascript:quitarProducto('<?php echo $row['PRODUCTID'] ?>','<?php echo $row['PRODUCTO'] ?>','<?php echo $row['CANTIDAD'] ?>', '<?php echo $row['PRECIO'] ?>');">quitar</a>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $row['PRODUCTO']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['CANTIDAD']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['PRECIO']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['CANTIDAD'] * $row["PRECIO"]; ?>
                                        </td>
                                    </tr>
                                    <?php $totalNeto += $row['CANTIDAD'] * $row['PRECIO'];
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
                                    <th>
                                        <?php echo $totalNeto; ?>
                                    </th>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>TOTAL</b></td>
                                        <td><b>
                                                <?php echo $totalNeto; ?>
                                            </b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="realizar">
                            <div id="nueva-factura" class="btn-realizar-factura">
                                <a href="#">NUEVA FACTURA</a>
                            </div>
                            <div class=""></div>
                        </div>
                    </form>
                </div>
                <div class="productos texto-centrado">
                    <div>
                        <h2>PRODUCTOS</h2>
                    </div>
                    <div>
                        <table>
                            <thead class="nombre-columna">
                                <th>PRODUCTO</th>
                                <th>EXISTENCIA (U)</th>
                                <th>PRECIO Q.</th>
                                <th>ACCION</th>
                            </thead>
                            <tbody id="content" class="cuerpo-tabla">
                                <?php if (count($productos->fetch_assoc()) > 0) {
                                while ($row = $productos->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?php echo $row['PRODUCTO']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['CANTIDAD']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['PRECIO']; ?>
                                    </td>
                                    <td>
                                        <div class="btn-agregar">
                                            <a id="agregar-producto"
                                                href="javascript:agregar_producto('<?php echo $row['PRODUCTID']; ?>','<?php echo $row['PRODUCTO']; ?>', '<?php echo $row['CANTIDAD']; ?>', '<?php echo $row['PRECIO']; ?>');">agregar</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td>SIN</td>
                                    <td>DATOS</td>
                                    <td>ENCONTRADOS</td>
                                    <td>!</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="ventana-agregar-producto"></div>
                        <div id="close"></div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        $(document).ready(function () {
            $('.productos').hide();

            $('#nueva-factura').on('click', function (e) {
                e.preventDefault();
                var nombre_cliente = $('#nombre-cliente').val();
                var direccion_cliente = $('#direccion-cliente').val();
                if (nombre_cliente == '' || direccion_cliente == '') {
                    $(this).next().addClass('estado-nueva-factura texto-centrado');
                    $(this).next().html('<p>Ingrese nombre y direccion para la factura</p>');
                } else {
                    var url = 'controller/factura-controller.php';
                    $('#nueva-factura').addClass('finalizar-factura');

                    var finalizar_factura = $('#nueva-factura').hasClass('finalizar-factura');
                    console.log(finalizar_factura);
                    
                    $('.productos').show();
                    $(this).next().html('');
                    $(this).html('<a href="#">FINALIZAR FACTURA</a>');
                }
            });

        });

        function agregar_producto(id_producto, nombre_producto, stock_producto, precio_producto) {
            var url = 'controller/factura-controller.php';

            $('#close').addClass('cerrar');

            $('.cerrar').on('click', function(){
                console.log('hola');
                $('.ventana-agregar-producto').html('');
            });

            $('.ventana-agregar-producto').html(ventana_agregar_producto(nombre_producto, precio_producto));
            $('.producto-agregado').html('<p><b>PRODUCTO: </b>' + nombre_producto + ' <b>PRECIO: Q.</b>' + precio_producto + '</p>');

            $('#listo').on('click', function (e) {
                e.preventDefault();
                var cantidad_producto_comprado = parseInt($('#cantidad-comprada').val());

                if (cantidad_producto_comprado <= 0 || isNaN(cantidad_producto_comprado)) {
                    $('.estado-agregar-producto').html('<p class="texto-error texto-centrado">La cantidad tiene que ser mayor a 0</p>');
                    $('#cantidad-comprada').focus();
                } else if (cantidad_producto_comprado > stock_producto) {
                    $('.estado-agregar-producto').html('<p class="texto-error texto-centrado">No hay suficiente producto en stock</p>');
                    $('#cantidad-comprada').focus();
                } else {
                    $.post(url, { idProducto: id_producto, cantidadProductoComprado: cantidad_producto_comprado, stockProducto: stock_producto }, function (resp) {
                        $('#listo').replaceWith('<a id="listo" href="#">CERRAR</a>');
                        $('.estado-agregar-producto').html(resp);
                        $('#listo').on('click', function () {
                            $('.ventana-agregar-producto').html('');
                        });
                    });
                }


            });
        }

        function ventana_agregar_producto(nombre_producto, precio_producto) {
            var resp = '<div class="ventana-agregar">' +
                '<div class="contenedor-agregar">' +
                '<h2>AGREGAR PRODUCTO</h2>' +
                '<div id="producto-agregado">' +
                '<p><b>PRODUCTO: </b>' + nombre_producto + '<b> PRECIO: Q</b>' + precio_producto + '</p>' +
                '</div>' +
                '<hr>' +
                '<div class="cantidad-comprada"> <label for="cantidad-comprada">CANTIDAD: </label>' +
                '<input type="number" id="cantidad-comprada" placeholder="--"></div>' +
                '<hr>' +
                '<div class="estado-agregar-producto"></div>' +
                '<div class="btn-agregar">' +
                '<a id="listo" href="#">LISTO</a>' +
                '</div>' +
                '</div>' +
                '</div>';
            return resp;
        }

    </script>

</body>

</html>