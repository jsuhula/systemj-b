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
                    <form method="post" autocomplete="off">
                        <div>
                            <div class="head-factura">
                                <h3>LIBRERIA J&B</h3>
                                <h3 id="numero-factura">FACTURA No. </h3>
                                <p>FECHA: <?php print_r($fecha); ?></p>
                            </div>

                            <div class="datos-cliente">
                                <label for="nombre">NOMBRE:</label>
                                <input type="text" id="nombre-cliente" required="true" placeholder="Nombre" value="">

                                <label for="direccion">DIRECCION:</label>
                                <input type="text" id="direccion-cliente" required="true" placeholder="Direccion"
                                    value="">
                            </div>
                        </div>
                        <div class="detallado-factura">
                        </div>
                        <div class="realizar">
                            <div class="nueva-factura btn-realizar-factura">
                                <a href="#">NUEVA FACTURA</a>
                            </div>
                            <div class=""></div>
                        </div>
                    </form>
                </div>
                <div class="productos texto-centrado">
                    <div>
                        <h3>PRODUCTOS</h3>
                    </div>
                    <div>
                        <form action="" autocomplete="off">
                            <div class="busqueda">
                                <label for="buscar">BUSCAR: </label>
                                <input type="text" id="buscar" placeholder="Nombre del producto...">
                            </div>
                        </form>

                        <table>
                            <thead class="nombre-columna">
                                <th>PRODUCTO</th>
                                <th>EXISTENCIA (U)</th>
                                <th>PRECIO Q.</th>
                                <th>ACCION</th>
                            </thead>
                            <tbody id="content" class="cuerpo-tabla">
                            </tbody>
                        </table>
                        <div class="ventana-agregar-producto"></div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        $(document).ready(function () {
            var url = 'controller/factura-controller.php';
            var realizado = 0;
            var factura = '';

            $('.productos').hide();
            $.post(url, { opcion: 'ACTFAC' }, function (respuesta) {
                $('.detallado-factura').html(respuesta);
            });

            $('#content').html(notFoundProducts());
            $('.nueva-factura').on('click', function () {
                realizado++;
                var nombre_cliente = $('#nombre-cliente').val();
                var direccion_cliente = $('#direccion-cliente').val();

                if (nombre_cliente == '' || direccion_cliente == '') {
                    $(this).next().addClass('estado-nueva-factura texto-centrado');
                    $(this).next().html('<p>Ingrese nombre y direccion para la factura</p>');
                } else {
                    $(this).next().html('');
                    $(this).addClass('finalizar-factura');
                    $(this).html('<a href="#">FINALIZAR FACTURA</a>');
                    $('.finalizar-factura').removeClass('nueva-factura');
                    if (realizado == 1) {
                        $.post(url, { opcion: 'NFAC', nombreCliente: nombre_cliente, direccionCliente: direccion_cliente }, function (respuesta) {
                            factura = respuesta;
                            if (respuesta) {
                                $('.productos').show();
                                $('#numero-factura').replaceWith('<h3 id="numero-factura">FACTURA No. <?php echo $numeroFactura['NUMEROFACTURA'] + 1 ?></h3>');
                                $('#nombre-cliente').prop('disabled', true);
                                $('#direccion-cliente').prop('disabled', true);
                            } else {
                                $(this).next().html('<p>OCURRIO UN ERROR CON LA SOLICITUD</p>');
                            }
                        });
                    } else {
                        var facUrl = 'factura/factura_plantilla.php';
                        $.post(facUrl, { nombreCliente: nombre_cliente, direccionCliente: direccion_cliente }, function (respuesta) { });
                        window.open("factura/factura_plantilla.php", "_blank");
                        window.location.reload(true);
                        location.reload();
                    }

                }
            });

            $('#buscar').keyup(function () {
                $('#content').html(notFoundProducts());
                var productos = <?php echo $productosArray; ?>;
                var busqueda = $(this).val().toString();
                var productosEncontrados = 0;

                for (var i = 0; i < productos.length; i++) {
                    if (productos[i][1].toString().includes(busqueda) && busqueda.length > 0) {
                        $('#no-encontrado').html('');
                        $('#content').append(foundProducts(productos[i][0], productos[i][1], productos[i][2], productos[i][3]));
                        productosEncontrados++;
                    } else if (productosEncontrados == 0) {
                        $('#content').html(notFoundProducts());
                    }
                }

            });

        });

        function agregar_producto(id_producto, nombre_producto, stock_producto, precio_producto) {
            var url = 'controller/factura-controller.php';
            var opcion = 'ADPRTO';

            $.post(url, { opcion: opcion, nombreProducto: nombre_producto, precioProducto: precio_producto }, function (respuesta) {
                $('.ventana-agregar-producto').html(respuesta);

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
                        $.post(url, { opcion: opcion, idProducto: id_producto, stockProducto: stock_producto, cantidadProductoComprado: cantidad_producto_comprado }, function (respuesta) {
                            $('#listo').replaceWith('<a id="listo" href="#">CERRAR</a>');
                            $('.estado-agregar-producto').html(respuesta);
                            $('#listo').on('click', function () {
                                $('.ventana-agregar-producto').html('');
                                $.post(url, { opcion: 'ACTFAC', nuevaFactura: true }, function (respuesta) {
                                    $('.detallado-factura').html(respuesta);
                                });
                            });
                        });
                    }


                });
            });

        }

        function quitarProducto(id_producto) {
            var url = 'controller/factura-controller.php';
            $.post(url, { opcion: 'QUIT', idProducto: id_producto }, function (respuesta) {

                if (respuesta) {
                    $.post(url, { opcion: 'ACTFAC', nuevaFactura: true }, function (respuesta) {
                        $('.detallado-factura').html(respuesta);
                    });
                }
            });
        }

        function foundProducts(id_producto, nombre_producto, stock_producto, precio_producto) {
            var respuesta = '<tr>' +
                '<td>' + nombre_producto + '</td>' +
                '<td>' + stock_producto + '</td>' +
                '<td>' + precio_producto + '</td>' +
                '<td>' +
                '<div class="btn-agregar">' +
                '<a href="javascript:agregar_producto(' + id_producto + ', \'' + nombre_producto + '\',' + stock_producto + ',' + precio_producto + ');" id="agregar-producto">agregar</a>' +
                '</div>' +
                '</td>' +
                '</tr>';
            return respuesta;
        }

        function notFoundProducts() {
            var respuesta = '<tr id="no-encontrado">' +
                '<td>SIN</td>' +
                '<td>DATOS</td>' +
                '<td>ENCONTRADOS</td>' +
                '<td>!</td>' +
                '</tr>';

            return respuesta;
        }

    </script>

</body>

</html>