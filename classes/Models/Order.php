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

    public static function getOrders()
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getOrders = 'SELECT * FROM orders';
        $queryOrders = $DB->query($getOrders, []);
        $orders = [];
        if (false !== $queryOrders) {
            foreach ($queryOrders as $queryOrder) {
                $order = new Order($queryOrder['id'], $queryOrder['id_user'],
                    $queryOrder['totalPrice'], $queryOrder['date']);
                $orders[] = $order;
            }
        } else {
            die;
        }
        return $orders;
    }

    public static function getOrder($id)
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getOrder = 'SELECT * FROM orders WHERE id=:id;';
        $queryOrder = $DB->query($getOrder, [':id' => $id]);
        if (false !== $queryOrder) {
            return new Order($queryOrder[0]['id'], $queryOrder[0]['id_user'], $queryOrder[0]['totalPrice'], $queryOrder[0]['date']);
        }
        return false;
    }
}