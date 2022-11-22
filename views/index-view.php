<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web App01</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>

<body>
    <header class="cabecero">
        <div class="encabezado-pagina texto-centrado">
            <h1>LIBRERIA J&H</h1>
            <div class="mensaje-encabezado">
                <p>Direccion: 3a. Calle 2-11 Zona 0 XXXX</p>
                <p>Libreria, impresiones y fotocopias</p>
            </div>
            <hr>
        </div>
    </header>
    <main class="contenedor">
        <div class="objetos-contenedor">
            <div class="factura">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="encabezado-factura">
                        <h2 class="texto-centrado">Factura No. 001</h2>
                        <div class="datos-cliente">

                            <p>Nombre:</p>
                            <input type="text" class="entrada-cliente" id="nombre" name="nombre_cliente" placeholder="Nombre" value="<?php if (!$realizado & isset($nombreCliente)) : echo $nombreCliente;
                                                                                                                                    endif ?>">
                            <p>Direccion: </p>
                            <input type="text" class="entrada-cliente" id="direccion" name="direccion_cliente" placeholder="Direccion" value="<?php if (!$realizado & isset($direccionCliente)) : echo $direccionCliente;
                                                                                                                                            endif ?>">
                        </div>
                    </div>
                    <div class="detalle-factura">
                        <table class="lista-productos">
                            <thead class="cabecera-tabla">
                                <tr>
                                    <th>PRODUCTO</th>
                                    <th>CANTIDAD</th>
                                    <th>PRECIO</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody class="cuerpo-tabla">

                                <?php for ($i = 0; $i < 4;) { ?>
                                    <tr>
                                        <td>Lapicero</td>
                                        <td>4</td>
                                        <td>5.00</td>
                                        <td>20.00</td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                            <tfoot class="pie-tabla">
                                <th>TOTAL</th>
                                <th></th>
                                <th></th>
                                <th>20.00</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="realizar">
                        <div class="error">
                            <?php if (!empty($errores)) : ?>
                                <div class="error">
                                    <?php echo $errores; ?>
                                </div>
                            <?php elseif ($realizado) : ?>
                                <div class="success">
                                    <?php echo 'Exitoso'; ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="boton-realizar">
                            <input type="submit" name="submit" value="REALIZAR FACTURA">
                        </div>

                    </div>
                </form>
            </div>
            <div class="producto">
                <div>
                    <form>
                        <input type="text" name="producto" placeholder="Producto">
                        <input type="number" name="precio" placeholder="Precio">
                        <input type="number" name="cantidad" placeholder="Cantidad">
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>

    </main>

</body>

</html>