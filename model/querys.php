<?php

include('db-connection.php');

class Querys
{
    private $connection;

    function __construct()
    {
        $this->connection = new Conexion('bloumx0wqos3tll48ikk-mysql.services.clever-cloud.com', 'utnid7k9blsfxjqi', 'Rg1TiVsjzmNacaNgv5H2', 'bloumx0wqos3tll48ikk');
    }
    public $FACTURA = "SELECT `ORDERS`.`ORDERID` AS NOFACTURA,
                    `PRODUCTS`.`NOMBRE` AS PRODUCTO,
                    `ORDERDETAILS`.`CANTIDAD` AS CANTIDAD,
                    `PRODUCTS`.`PRECIO` AS PRECIO
                FROM ORDERDETAILS
                INNER JOIN PRODUCTS ON `PRODUCTS`.PRODUCTID = `ORDERDETAILS`.`PRODUCTID`
                INNER JOIN ORDERS ON `ORDERS`.`ORDERID` = `ORDERDETAILS`.`ORDERID`";
    public $PRODUCTOS = "SELECT PRODUCTID, NOMBRE, CANTIDAD, PRECIO FROM PRODUCTS";

    public function getFactura()
    {
        if (!$this->connection->getConnection()->connect_error) {
            return $this->connection->getConnection()->query($this->FACTURA);
        } else {
            return die('Ocurrio un error al consultar la base de datos ' . $this->connection->getConnection()->connect_error);
        }
    }
    public function getListaProductos()
    {

        if (!$this->connection->getConnection()->connect_error) {
            return $this->connection->getConnection()->query($this->PRODUCTOS);
        } else {
            return die('Ocurrio un error al consultar la base de datos ' . $this->connection->getConnection()->connect_error);
        }
    }
}
