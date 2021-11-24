<?php

require_once __DIR__ . '/User.php';
require_once __DIR__ . '/../DB.php';

class Users
{
    protected $DB;
    protected $users = [];

    public function __construct()
    {
        $this->DB = new DB('localhost', 'natural_stone', 'root', 'root');
        $getUsers = 'SELECT * FROM users';
        $queryUsers = $this->DB->query($getUsers, []);
        if (false !== $queryUsers) {
            foreach ($queryUsers as $queryUser) {
                $user = new User($queryUser['id'], $queryUser['userName'],
                    $queryUser['passwordHash'], $queryUser['firstName'],
                    $queryUser['secondName'], $queryUser['patronymic'], $queryUser['email'], $queryUser['phone'], $queryUser['amountOfPurchases']);
                $this->users[] = $user;
            }
        } else {
            die;
        }
    }

    public function getUser($id)
    {
        $getUser = 'SELECT * FROM users WHERE id=:id;';
        $queryUser = $this->DB->query($getUser, [':id' => $id]);
        if (false !== $queryUser) {
            return new User($queryUser[0]['id'], $queryUser[0]['userName'], $queryUser[0]['passwordHash'], $queryUser[0]['firstName'], $queryUser[0]['secondName'], $queryUser[0]['patronymic'], $queryUser[0]['email'], $queryUser[0]['phone'], $queryUser[0]['amountOfPurchases']);
        }
        return false;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function deleteUser($id)
    {
        $delete = 'DELETE FROM users WHERE id=' . $id;
        if (true == $this->DB->execute($delete)) {
            return true;
        } else {
            return false;
        }
    }

    public function getIdByUserName($userName)
    {
        $getId = 'SELECT id FROM users WHERE userName=:userName;';
        $queryId = $this->DB->query($getId, [':userName' => $userName]);
        if ($queryId !== false) {
            return $queryId[0]['id'];
        }
        return false;
    }

    public function checkUserName($userName)
    {
        $getUserName = 'SELECT * FROM users WHERE userName=:userName;';
        $queryUserName = $this->DB->query($getUserName, [':userName' => $userName]);
        if ($queryUserName !== false) {
            if (count($queryUserName) > 0) {
                return true;
            }
        }
        return false;
    }

    public function checkPhone($phone)
    {
        $getUserPhone = 'SELECT * FROM users WHERE phone=:phone;';
        $queryUserPhone = $this->DB->query($getUserPhone, [':phone' => $phone]);
        if ($queryUserPhone !== false) {
            if (count($queryUserPhone) > 0) {
                return true;
            }
        }
        return false;
    }

    public function checkPassword($userName, $password)
    {
        $getPasswordHash = 'SELECT passwordHash FROM users WHERE userName=:userName';
        $queryPasswordHash = $this->DB->query($getPasswordHash, [':userName' => $userName]);
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