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
    <div class="box">
        <div class="encabezado center-text">
            <h1 class="titulo">LIBRERIA J&H</h1>
            <div class="mensaje">
                <p>Direccion: 3a. Calle 2-11 Zona 0 XXXX</p>
                <p>Libreria, impresiones y fotocopias</p>
            </div>
            <hr>
        </div>
        <div class="orden">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <h2 class="center-text">Factura No. 001</h2>
                <div class="datos-cliente">

                    <p>Nombre:</p>
                    <input type="text" class="input-client" id="nombre" name="nombre_cliente" placeholder="Nombre" value="">
                    <p>Direccion: </p>
                    <input type="text" class="input-client" id="direccion" name="direccion_cliente" placeholder="Direccion" value="Ciudad">
                </div>
                <div class="detallado">
                    <table class="lista-productos">
                        <thead class="head-table">
                            <tr>
                                <th>PRODUCTO</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody class="body-table">
                            <tr>
                                <td>Lapicero</td>
                                <td>4</td>
                                <td>5.00</td>
                                <td>20.00</td>
                            </tr>
                            <tr>
                                <td>Libro Sembrador</td>
                                <td>2</td>
                                <td>30.00</td>
                                <td>60.00</td>
                            </tr>
                        </tbody>
                        <tfoot class="foot-table">
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
                            <div class="alert error">
                                <?php echo $errores; ?>
                            </div>
                        <?php elseif (empty($errores)) : ?>
                            <div class="alert success">
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
    </div>

</body>

</html>