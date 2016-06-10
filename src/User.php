<?php

require_once 'conn.php';

class User {

    private $id;
    private $name;
    private $surname;
    private $password;
    private $email;
    private $address;

    public function __construct() {
        $this->id = -1;
        $this->name = '';
        $this->surname = '';
        $this->password = '';
        $this->email = '';
        $this->address = '';
    }

    public function loadUserFromDb(mysqli $conn, $id) {
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $rowUser = $result->fetch_assoc();
            $this->id = $rowUser['id'];
            $this->setName($rowUser['name']);
            $this->setSurname($rowUser['surname']);
            $this->setPassword($rowUser['password']);
            $this->setEmail($rowUser['surname']);
            $this->setAddress($rowUser['surname']);
            return true;
        } else {
            return false;
        }
    }

    public function saveUserToDb(mysqli $conn) {
        if ($this->id === -1) {
            $sql = "INSERT INTO users (name, surname, password, email, address) VALUES 
                    ({$this->name},{$this->surname},{$this->password}, {$this->email},{$this->address})";
            if ($conn->quer($sql)) {
                $this->id = $conn->insert_id;
                return true;
            } else {
                return false;
            }
        }
    }

    public static function getUserByEmail(mysqli $conn, $email) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public static function login(mysqli $conn, $email, $password) {
        $sql = "SELECT * FROM User WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $rowUser = $result->fetch_assoc();
            if (password_verify($password, $rowUser['password']) && $rowUser['active'] == 1) {
                return $rowUser['id'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setAddress($address) {
        $this->address = $address;
    }

}
