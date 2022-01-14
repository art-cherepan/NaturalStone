<?php

//require_once __DIR__ . '/../DB.php';
namespace App\Models;
use \App\DB as DB;

class Product
{
    protected $id;
    protected $name;
    protected $price;
    protected $description;
    protected $path;
    protected $DB;

    public function __construct($id, $name, $price, $description, $path)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->path = $path;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    public function insert()
    {
        $insert = 'INSERT products(name, price, description, path) VALUES ('
            . '\'' . $this->name . '\'' . ',' . $this->price . ',' . '\''
            . $this->description . '\'' . ',' . '\'' . $this->path . '\'' . ')';
        return $this->DB->execute($insert);
    }

    public function update($withImg)
    {
        if (true == $withImg) {
            $update = 'UPDATE products SET name = ' . '\'' . $this->name
                . '\'' . ', description = ' . '\'' . $this->description
                . '\'' . ', price = ' . '\'' . $this->price . '\''
                . ', path = ' . '\'' . $this->path . '\'' . 'WHERE id = '
                . $this->id;
            return $this->DB->execute($update);
        } else {
            $update = 'UPDATE products SET name = ' . '\'' . $this->name
                . '\'' . ', description = ' . '\'' . $this->description
                . '\'' . ', price = ' . '\'' . $this->price . '\''
                . 'WHERE id = ' . $this->id;
            return $this->DB->execute($update);
        }
    }

    public function delete()
    {
        $delete = 'DELETE FROM products WHERE id = ' . $this->id;
        return $this->DB->execute($delete);
    }

    public static function getProducts()
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getProducts = 'SELECT * FROM products';
        $queryProducts = $DB->query($getProducts, []);
        $products = [];
        if (false !== $queryProducts) {
            foreach ($queryProducts as $queryProduct) {
                $product = new Product($queryProduct['id'], $queryProduct['name'],
                    $queryProduct['price'], $queryProduct['description'],
                    $queryProduct['path']);
                $products[] = $product;
            }
        } else {
            die;
        }
        return $products;
    }

    public static function getProduct($id)
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getProduct = 'SELECT * FROM products WHERE id=:id;';
        $queryProduct = $DB->query($getProduct, [':id' => $id]);
        if (false !== $queryProduct) {
            return new Product($queryProduct[0]['id'], $queryProduct[0]['name'], $queryProduct[0]['price'], $queryProduct[0]['description'], $queryProduct[0]['path']);
        }
        return false;
    }
}