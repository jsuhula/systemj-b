<?php
date_default_timezone_set('UTC');

include('../model/querys.php');
$querys = new Querys();
$numeroFactura = $querys->obtenerNumeroUltimaFactura()->fetch_assoc();
$detalleFactura = $querys->obtenerFactura($numeroFactura['NUMEROFACTURA']);
$datosCliente = $querys->datosClienteFactura($numeroFactura['NUMEROFACTURA'])->fetch_assoc();
$subtotal = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Factura</title>
	<link rel="stylesheet" href="style-fac.css">
	<script src="../js/lib/jquery-3.6.1.min.js"></script>
</head>

<body>
	<div id="page_pdf">
		<table id="factura_head">
			<tr>
				<td class="logo_factura">
					<div>
						<img src="img/libreria.png">
					</div>
				</td>
				<td class="info_empresa">
					<div>
						<span class="h2">LIBRERIA J&B</span>
						<p>3a Avenida 2-13 Zona 0, Guatemala</p>
						<p>Teléfono: +(502) 2222-3333</p>
						<p>Email: libreriajb@gmail.com</p>
					</div>
				</td>
				<td class="info_factura">
					<div class="round">
						<span class="h3">Factura</span>
						<p>No. Factura: <strong><?php echo $numeroFactura['NUMEROFACTURA']; ?></strong></p>
						<p>Fecha: <?php echo date('Y-m-d'); ?></p>
					</div>
				</td>
			</tr>
		</table>
		<table id="factura_cliente">
			<tr>
				<td class="info_cliente">
					<div class="round">
						<span class="h3">Cliente</span>
						<table class="datos_cliente">
							<tr>
								<td><label>Nombre:</label>
									<p><?php echo $datosCliente['NOMBRECLIENTE']; ?></p>
								</td>
								<td><label>Dirección:</label>
									<p><?php echo $datosCliente['DIRECCION']; ?></p>
								</td>
							</tr>
						</table>
					</div>
				</td>

			</tr>
		</table>

		<table id="factura_detalle">
			<thead>
				<tr>
					<th width="50px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px"> Precio Total</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				<?php while($row = $detalleFactura->fetch_assoc()){ ?>
				<tr>
					<td class="textcenter"><?php echo $row['CANTIDAD']; ?></td>
					<td><?php echo $row['PRODUCTO']; ?></td>
					<td class="textright"><?php echo $row['SUBTOTAL']/$row['CANTIDAD']; ?></td>
					<td class="textright"><?php echo sprintf('%.2f', $row['SUBTOTAL']); ?></td>
				</tr>
				<?php $subtotal += $row['SUBTOTAL']; } ?>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="3" class="textright"><span>SUBTOTAL Q.</span></td>
					<td class="textright"><span><?php echo sprintf('%.2f', $subtotal); ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>TOTAL Q.</span></td>
					<td class="textright"><span><?php echo sprintf('%.2f', $subtotal); ?></span></td>
				</tr>
			</tfoot>
			
		</table>

	</div>

</body>

<script>
	$(document).ready(function () {
		print();
	});
</script>

</html>