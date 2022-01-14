<?php

//require_once __DIR__ . '/../DB.php';
namespace App\Models;
use \App\DB as DB;

class Service
{
    protected $id;
    protected $name;
    protected $price;
    protected $measure;
    protected $check;
    protected $DB;

    public function __construct($id, $name, $price, $measure)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->measure = $measure;
        $this->check = false;
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getMeasure()
    {
        return $this->measure;
    }

    /**
     * @return mixed
     */
    public function getCheck()
    {
        return $this->check;
    }

    /**
     * @param bool $check
     */
    public function setCheck($check)
    {
        $this->check = $check;
    }

    public function insert()
    {
        $insert = 'INSERT services(name, price, description, duration) VALUES ('
            . '\'' . $this->name . '\'' . ',' . $this->price . ',' . '\''
            . '\'' . ',' . '\'' . '\'' . ',' . '\'' . $this->measure . '\'' . ')';
        return $this->DB->execute($insert);
    }

    public function update()
    {
        $update = 'UPDATE services SET name = ' . '\'' . $this->name
            . '\'' . ', price = ' . '\'' . $this->price . '\''
            . ', duration = ' . '\'' . $this->measure . '\'' . 'WHERE id = '
            . $this->id;
        return $this->DB->execute($update);
    }

    public function delete()
    {
        $delete = 'DELETE FROM services WHERE id = ' . $this->id;
        return $this->DB->execute($delete);
    }

    public static function getServices()
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getServices = 'SELECT * FROM services';
        $queryServices = $DB->query($getServices, []);
        $services = [];
        if (false !== $queryServices) {
            foreach ($queryServices as $queryService) {
                $service = new Service($queryService['id'], $queryService['name'],
                    $queryService['price'], $queryService['measure']);
                $services[] = $service;
            }
        } else {
            die;
        }
        return $services;
    }

    public static function getService($id)
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getService = 'SELECT * FROM services WHERE id=:id;';
        $queryService = $DB->query($getService, [':id' => $id]);
        if (false !== $queryService) {
            return new Service($queryService[0]['id'], $queryService[0]['name'], $queryService[0]['price'], $queryService[0]['measure']);
        }
        return false;
    }
}