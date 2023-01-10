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
<div class="factura">
    <div>
        <h2 class="texto-centrado">NUEVA FACTURA</h2>
        <div class="datos-cliente">
            <label for="nombre">NOMBRE:</label>
            <p> <?php echo 'JUAN TASEJO' ?><p>

            <label for="direccion">DIRECCION:</label>
            <P> <?php echo 'Ciudad' ?></P>
        </div>
    </div>
    <div class="detallado-factura">
    </div>
    <div class="realizar">
        <div id="nueva-factura" class="btn-realizar-factura">
            <a href="#">NUEVA FACTURA</a>
        </div>
        <div class=""></div>
    </div>
</div>
</body>
</html>

