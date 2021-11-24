<?php

require_once __DIR__ . '/Service.php';
require_once __DIR__ . '/../DB.php';

class Services
{
    protected $DB;
    protected $services = [];

    public function __construct()
    {
        $this->DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getServices = 'SELECT * FROM services';
        $queryServices = $this->DB->query($getServices, []);
        if (false !== $queryServices) {
            foreach ($queryServices as $queryService) {
                $service = new Service($queryService['id'], $queryService['name'],
                    $queryService['price'], $queryService['measure']);
                $this->services[] = $service;
            }
        } else {
            die;
        }
    }

    public function getService($id)
    {
        $getService = 'SELECT * FROM services WHERE id=:id;';
        $queryService = $this->DB->query($getService, [':id' => $id]);
        if (false !== $queryService) {
            return new Service($queryService[0]['id'], $queryService[0]['name'], $queryService[0]['price'], $queryService[0]['measure']);
        }
        return false;
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }
}