<?php

//require_once __DIR__ . '/../DB.php';
namespace App\Models;
use \App\DB as DB;

class OrderService
{
    protected $id;
    protected $idOrder;
    protected $idService;
    protected $DB;

    public function __construct($id, $idOrder, $idService)
    {
        $this->id = $id;
        $this->idOrder = $idOrder;
        $this->idService = $idService;
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
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * @param mixed $idService
     */
    public function setIdService($idService)
    {
        $this->idService = $idService;
    }

    public function insert()
    {
        $insert = 'INSERT INTO order_service (id_order, id_service) VALUES ' . '(\'' . $this->idOrder . '\',\''. $this->idService . '\')';
        $executeInsert = $this->DB->execute($insert);
        if (false !== $executeInsert) {
            return true;
        }
        return false;
    }
}