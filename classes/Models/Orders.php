<?php

require_once __DIR__ . '/Order.php';
require_once __DIR__ . '/../DB.php';
class Orders
{
    protected $DB;
    protected $orders = [];

    public function __construct()
    {
        $this->DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getOrders = 'SELECT * FROM orders';
        $queryOrders = $this->DB->query($getOrders, []);
        if (false !== $queryOrders) {
            foreach ($queryOrders as $queryOrder) {
                $order = new Order($queryOrder['id'], $queryOrder['id_user'],
                    $queryOrder['totalPrice'], $queryOrder['date']);
                $this->orders[] = $order;
            }
        } else {
            die;
        }
    }

    public function getOrder($id)
    {
        $getOrder = 'SELECT * FROM orders WHERE id=:id;';
        $queryOrder = $this->DB->query($getOrder, [':id' => $id]);
        if (false !== $queryOrder) {
            return new Order($queryOrder[0]['id'], $queryOrder[0]['id_user'], $queryOrder[0]['totalPrice'], $queryOrder[0]['date']);
        }
        return false;
    }

}