<?php

include('db-connection.php');

class Querys
{
    private $connection;

    function __construct()
    {
        $this->connection = new Conexion('localhost', 'root', '', 'systemjb');
    }

    public function obtenerFactura($numeroFactura)
    {
        $FACTURA = "SELECT PR.PRODUCTID AS PRODUCTID, PR.PRODUCTO AS PRODUCTO, 
                    SUM(ODT.CANTIDAD) AS CANTIDAD, PR.PRECIO AS PRECIO, SUM(ODT.CANTIDAD*PR.PRECIO) AS SUBTOTAL
                    FROM PRODUCTS AS PR 
                    INNER JOIN ORDERDETAILS AS ODT ON ODT.PRODUCTID = PR.PRODUCTID
                    WHERE ODT.ORDERID = ";
        if (!$this->connection->getConnection()->connect_error) {
            return $this->connection->getConnection()->query("$FACTURA $numeroFactura GROUP BY PR.PRODUCTID");
        } else {
            return die('Ocurrio un error al consultar la base de datos ' . $this->connection->getConnection()->connect_error);
        }
    }
    public function obtenerListaProductos()
    {

        if (!$this->connection->getConnection()->connect_error) {
            return $this->connection->getConnection()->query("SELECT PRODUCTID, PRODUCTO, CANTIDAD, PRECIO FROM PRODUCTS");
        } else {
            return die('Ocurrio un error al consultar la base de datos ' . $this->connection->getConnection()->connect_error);
        }
    }

    public function realizarOrden($nombreCliente, $direccionCliente, $fecha)
    {
        $INSERT = "INSERT INTO ORDERS(NOMBRECLIENTE, DIRECCION, FECHA) VALUES('$nombreCliente', '$direccionCliente', '$fecha')";

        if (!$this->connection->getConnection()->connect_error) {
            $result = mysqli_query($this->connection->getConnection(), $INSERT);
            if (!$result) {
                return die('No se pudo guardar la nueva factura');
            } else {
                return $result;
            }
        } else {
            return die('Ocurrio un error al consultar la base de datos ' . $this->connection->getConnection()->connect_error);
        }
    }

    public function obtenerNumeroUltimaFactura()
    {
        if (!$this->connection->getConnection()->connect_error) {
            $result = mysqli_query($this->connection->getConnection(), "SELECT MAX(ORDERID) AS NUMEROFACTURA FROM ORDERS");
            if (!$result) {
                return die('No se pudo obtener el numero de factura');
            } else {
                return $result;
            }
        } else {
            return die('Ocurrio un error al consultar la base de datos ' . $this->connection->getConnection()->connect_error);
        }
    }

    public function agregarProductoFactura($orderId, $idProducto, $cantidadProductoComprado)
    {
        if (!$this->connection->getConnection()->connect_error) {
            $result = mysqli_query($this->connection->getConnection(), "INSERT INTO ORDERDETAILS(ORDERID, PRODUCTID, CANTIDAD) VALUES('$orderId', '$idProducto', '$cantidadProductoComprado')");
            if (!$result) {
                return die('No se pudo agregar a la factura');
            } else {
                return $result;
            }
        } else {
            return die('Ocurrio un error al consultar la base de datos ' . $this->connection->getConnection()->connect_error);
        }
    }

    public function quitarProductoFactura($idProducto, $numeroFactura)
    {
        if (!$this->connection->getConnection()->connect_error) {
            $result = mysqli_query($this->connection->getConnection(), "DELETE FROM ORDERDETAILS WHERE ORDERID = $numeroFactura AND PRODUCTID = $idProducto");
            if (!$result) {
                return die('No se pudo quitar de la factura');
            } else {
                return $result;
            }
        } else {
            return die('Ocurrio un error al consultar la base de datos ' . $this->connection->getConnection()->connect_error);
        }
    }

    public function datosClienteFactura($numeroFactura)
    {
        if (!$this->connection->getConnection()->connect_error) {
            $result = mysqli_query($this->connection->getConnection(), "SELECT NOMBRECLIENTE, DIRECCION FROM ORDERS WHERE ORDERID = $numeroFactura");
            if (!$result) {
                return die('No se pudo obtener los datos');
            } else {
                return $result;
            }
        } else {
            return die('Ocurrio un error al consultar la base de datos ' . $this->connection->getConnection()->connect_error);
        }
    }
}