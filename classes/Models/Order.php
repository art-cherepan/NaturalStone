<?php

require_once __DIR__ . '/../DB.php';

class Order
{
    protected $id;
    protected $userId;
    protected $totalPrice;
    protected $date;
    protected $DB;

    public function __construct($id, $userId, $date, $totalPrice = 0)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->totalPrice = $totalPrice;
        $this->date = $date;
        $this->DB = new DB('localhost', 'natural_stone', 'root', 'root');
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return int
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function insert()
    {
        $insert = 'INSERT INTO orders (id_user, totalPrice, date) VALUES ' . '(\'' . $this->userId . '\',\''. $this->totalPrice . '\',\'' . $this->date . '\')';
        $executeInsert = $this->DB->execute($insert);
        if (false !== $executeInsert) {
            return true;
        }
        return false;
    }

    public function getIdAfterInsert()
    {
        return $this->DB->getLastInsertId();
    }
}