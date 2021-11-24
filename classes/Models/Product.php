<?php

require_once __DIR__ . '/../DB.php';

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
}