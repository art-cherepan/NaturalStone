<?php

require_once __DIR__ . '/Product.php';
require_once __DIR__ . '/../DB.php';

class Products
{
    protected $DB;
    protected $products = [];

    public function __construct()
    {
        $this->DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getProducts = 'SELECT * FROM products';
        $queryProducts = $this->DB->query($getProducts, []);
        if (false !== $queryProducts) {
            foreach ($queryProducts as $queryProduct) {
                $product = new Product($queryProduct['id'], $queryProduct['name'],
                    $queryProduct['price'], $queryProduct['description'],
                    $queryProduct['path']);
                $this->products[] = $product;
            }
        } else {
            die;
        }
    }

    public function getProduct($id)
    {
        $getProduct = 'SELECT * FROM products WHERE id=:id;';
        $queryProduct = $this->DB->query($getProduct, [':id' => $id]);
        if (false !== $queryProduct) {
            return new Product($queryProduct[0]['id'], $queryProduct[0]['name'], $queryProduct[0]['price'], $queryProduct[0]['description'], $queryProduct[0]['path']);
        }
        return false;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }
}