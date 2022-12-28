<?php

include('db-connection.php');

class Querys
{
    private $connection;

    function __construct()
    {
        $this->connection = new Conexion('localhost', 'root', '', 'systemjb');
    }
    public $FACTURA = "";
    public $NEWORDER = 'INSERT INTO ORDERS(NOMBRECLIENTE, DIRECCION) VALUES(';
    public $PRODUCTOS = "SELECT PRODUCTID, PRODUCTO, CANTIDAD, PRECIO FROM PRODUCTS";

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

    public function newOrder($nombreCliente, $direccionCliente){
        $this->NEWORDER .= $nombreCliente . ', ' . $direccionCliente . ')';


        if (!$this->connection->getConnection()->connect_error) {
            $result = mysqli_query($this->connection->getConnection(), $this->NEWORDER);
            if(!$result){
                return die('No se pudo guardar la nueva factura');
            }else{
                return $result;
            }
        } else {
            return die('Ocurrio un error al consultar la base de datos ' . $this->connection->getConnection()->connect_error);
        }
    }
}
