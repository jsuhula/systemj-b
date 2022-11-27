<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web App01</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <header class="cabecero">
        <div class="encabezado-pagina texto-centrado">
            <h1>LIBRERIA J&H</h1>
            <div class="mensaje-encabezado">
                <p>Direccion: 3a. Calle 2-11 Zona 0 XXXX</p>
                <p>Libreria, impresiones y fotocopias</p>
            </div>
        </div>
    </header>
    <main class="contenedor">
        <div class="objetos-contenedor">
            <div class="factura">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="encabezado-factura">
                        <h2 class="texto-centrado"><?php if (!empty($numeroFactura)) {
                                                        echo 'FACTURA No. ' . $numeroFactura;
                                                    } else {
                                                        echo 'FACTURA No. --';
                                                    } ?></h2>
                        <div class="datos-cliente">
                            <label for="nombre">NOMBRE:</label>
                            <input type="text" class="entrada-cliente" id="nombre" name="nombre_cliente" required="true" placeholder="Nombre" value="">

                            <label for="direccion">DIRECCION:</label>
                            <input type="text" class="entrada-cliente" id="direccion" name="direccion_cliente" required="true" placeholder="Direccion" value="">
                        </div>
                    </div>
                    <div class="detallado">
                        <table>
                            <thead class="nombre-columna">
                                <th>PRODUCTO</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO</th>
                                <th>TOTAL Q.</th>
                            </thead>
                            <tbody class="cuerpo-tabla">
                                <?php if (!empty($detalleFactura)) {
                                    while ($row = $detalleFactura->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row['PRODUCTO']; ?></td>
                                            <td><?php echo $row['CANTIDAD']; ?></td>
                                            <td><?php echo $row['PRECIO']; ?></td>
                                            <td><?php echo $row['CANTIDAD'] * $row["PRECIO"]; ?></td>
                                        </tr>
                                    <?php $totalNeto += $row['CANTIDAD'] * $row['PRECIO'];
                                    }
                                } else { ?>
                                    <td>SIN</td>
                                    <td>DATOS</td>
                                    <td>ENCONTRADOS</td>
                                    <td>!</td>
                                <?php } ?>
                            </tbody>
                            <tfoot class="pie-tabla">
                                <th>TOTAL</th>
                                <th></th>
                                <th></th>
                                <th><?php echo $totalNeto; ?></th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="realizar">
                        <div class="boton-realizar">
                            <input type="submit" name="submit" value="REALIZAR FACTURA">
                        </div>

                    </div>
                </form>
            </div>
            <div class="productos texto-centrado">
                <div class="buscar">
                    <label for="campo">BUSCAR </label>
                    <input type="text" name="campo" id="campo" onkeyup="getData()">
                </div>
                <div class="detallado">
                    <table>
                        <thead class="nombre-columna">
                            <th>PRODUCTO</th>
                            <th>EXISTENCIA (U)</th>
                            <th>PRECIO Q.</th>
                        </thead>
                        <tbody id="content" class="cuerpo-tabla">
                            <?php if ($row_nums > 0) {
                                while ($row = $productos->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['NOMBRE']; ?></td>
                                        <td><?php echo $row['CANTIDAD']; ?></td>
                                        <td><?php echo $row['PRECIO']; ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td>SIN</td>
                                    <td>DATOS</td>
                                    <td>ENCONTRADOS</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

</body>

</html>
