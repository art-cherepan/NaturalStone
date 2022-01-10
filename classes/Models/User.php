<?php

require_once __DIR__ . '/../DB.php';

class User
{
    protected $id;
    protected $userName;
    protected $passwordHash;
    protected $firstName;
    protected $secondName;
    protected $patronymic;
    protected $email;
    protected $phone;
    protected $amountOfPurchases;
    protected $DB;

    public function __construct($id, $userName, $passwordHash, $firstName, $secondName, $patronymic, $email, $phone, $amountOfPurchases = 0)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->passwordHash = $passwordHash;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->patronymic = $patronymic;
        $this->email = $email;
        $this->phone = $phone;
        $this->amountOfPurchases = $amountOfPurchases;
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
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return mixed
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * @return mixed
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getAmountOfPurchases()
    {
        return $this->amountOfPurchases;
    }

    /**
     * @param mixed $amountOfPurchases
     */
    public function setAmountOfPurchases($amountOfPurchases)
    {
        $this->amountOfPurchases += $amountOfPurchases;
    }

    //скидка рассичтыватся так: 0-20К - 0%, 20К-50К - 10%, 50K-100K - 15%, 100K > - 20%
    public function calculateDiscount() {
        if ($this->amountOfPurchases < 20000) {
            return 1;
        } elseif ($this->amountOfPurchases >= 20000 && $this->amountOfPurchases < 50000) {
            return 0.9;
        } elseif ($this->amountOfPurchases >= 50000 && $this->amountOfPurchases < 100000) {
            return 0.85;
        } elseif ($this->amountOfPurchases >= 100000) {
            return 0.8;
        }
    }

    public function getDiscount()
    {
        if ($this->amountOfPurchases < 20000) {
            return 0;
        } elseif ($this->amountOfPurchases >= 20000 && $this->amountOfPurchases < 50000) {
            return 10;
        } elseif ($this->amountOfPurchases >= 50000 && $this->amountOfPurchases < 100000) {
            return 15;
        } elseif ($this->amountOfPurchases >= 100000) {
            return 20;
        }
    }

    public function insert()
    {
        $insert = 'INSERT INTO users (userName, passwordHash, firstName, secondName, patronymic, email, phone, discount) VALUES ' . '(\'' . $this->userName . '\',\'' . $this->passwordHash . '\',\'' . $this->firstName . '\',\'' . $this->secondName . '\',\'' . $this->patronymic . '\',\'' . $this->email . '\',\'' . $this->phone . '\',' . $this->discount . ')';
        $executeInsert = $this->DB->execute($insert);
        if (false !== $executeInsert) {
            return true;
        }
        return false;
    }

    public function update()
    {
        $update = 'UPDATE users SET userName = ' . '\'' . $this->userName . '\'' . ', passwordHash = ' . '\'' . $this->passwordHash . '\'' . ', firstName = ' . '\'' . $this->firstName . '\'' . ', secondName = ' . '\'' . $this->secondName . '\'' . ', patronymic = ' . '\'' . $this->patronymic . '\'' . ', email = ' . '\'' . $this->email . '\'' . ', phone = ' . '\'' . $this->phone . '\'' . 'WHERE id = ' . $this->id;
        return $this->DB->execute($update);
    }

    public function delete()
    {
        $delete = 'DELETE FROM users WHERE id = ' . $this->id;
        return $this->DB->execute($delete);
    }

    public static function getUsers()
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getUsers = 'SELECT * FROM users';
        $queryUsers = $DB->query($getUsers, []);
        $users = [];
        if (false !== $queryUsers) {
            foreach ($queryUsers as $queryUser) {
                $user = new User($queryUser['id'], $queryUser['userName'],
                    $queryUser['passwordHash'], $queryUser['firstName'],
                    $queryUser['secondName'], $queryUser['patronymic'], $queryUser['email'], $queryUser['phone'], $queryUser['amountOfPurchases']);
                $users[] = $user;
            }
        } else {
            die;
        }
        return $users;
    }

    public static function getUser($id)
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getUser = 'SELECT * FROM users WHERE id=:id;';
        $queryUser = $DB->query($getUser, [':id' => $id]);
        if (false !== $queryUser) {
            return new User($queryUser[0]['id'], $queryUser[0]['userName'], $queryUser[0]['passwordHash'], $queryUser[0]['firstName'], $queryUser[0]['secondName'], $queryUser[0]['patronymic'], $queryUser[0]['email'], $queryUser[0]['phone'], $queryUser[0]['amountOfPurchases']);
        }
        return false;
    }

    public static function getIdByUserName($userName)
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getId = 'SELECT id FROM users WHERE userName=:userName;';
        $queryId = $DB->query($getId, [':userName' => $userName]);
        if ($queryId !== false) {
            return $queryId[0]['id'];
        }
        return false;
    }

    public static function checkUserName($userName)
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getUserName = 'SELECT * FROM users WHERE userName=:userName;';
        $queryUserName = $DB->query($getUserName, [':userName' => $userName]);
        if ($queryUserName !== false) {
            if (count($queryUserName) > 0) {
                return true;
            }
        }
        return false;
    }

    public static function checkPhone($phone)
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getUserPhone = 'SELECT * FROM users WHERE phone=:phone;';
        $queryUserPhone = $DB->query($getUserPhone, [':phone' => $phone]);
        if ($queryUserPhone !== false) {
            if (count($queryUserPhone) > 0) {
                return true;
            }
        }
        return false;
    }

    public static function checkPassword($userName, $password)
    {
        $DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getPasswordHash = 'SELECT passwordHash FROM users WHERE userName=:userName';
        $queryPasswordHash = $DB->query($getPasswordHash, [':userName' => $userName]);
        if ($queryPasswordHash !== false) {
            if (password_verify($password, $queryPasswordHash[0]['passwordHash'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}