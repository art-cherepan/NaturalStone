<?php

//require_once __DIR__ . '/../DB.php';
namespace App\Models;
use \App\DB as DB;

class OrderProduct
{
    protected $id;
    protected $idOrder;
    protected $idProduct;
    protected $count;
    protected $DB;

    public function __construct($id, $idOrder, $idProduct, $count)
    {
        $this->id = $id;
        $this->idOrder = $idOrder;
        $this->idProduct = $idProduct;
        $this->count = $count;
        $this->DB = new DB('localhost', 'natural_stone', 'root', 'root');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdOrder()
    {
        return $this->idOrder;
    }

    /**
     * @param mixed $idOrder
     */
    public function setIdOrder($idOrder)
    {
        $this->idOrder = $idOrder;
    }

    /**
     * @return mixed
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * @param mixed $idProduct
     */
    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    public function insert()
    {
        $insert = 'INSERT INTO order_product (id_order, id_product, count) VALUES ' . '(\'' . $this->idOrder . '\',\''. $this->idProduct . '\',\''. $this->count . '\')';
        $executeInsert = $this->DB->execute($insert);
        if (false !== $executeInsert) {
            return true;
        }
        return false;
    }

}