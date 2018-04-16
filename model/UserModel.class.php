<?php
class UserModel {
    public $mysqli;
    public function __construct() {
        $this->mysqli = new mysqli('localhost', 'root', 'root', 'zt_test');
    }
    public function addUser($uname, $phone, $password) {
        $sql = "insert into zt_user (name,phone,password) value ('{$uname}', '{$phone}', '{$password}')";
        
        $query = $this->mysqli->query($sql);
        return $query;
    }

    public function formatUser($value) {
        $item = array(
            'userid' => $value['id'],
            'username' => $value['name'],
            'userimg' => $value['image'],
        );
        return $item;
    }   
    
    public function getUserInfoByPhone($phone) {
        $sql = "select * from tb_user where phone = {$phone}";
        $query = $this->mysqli->query($sql);
        return $query;
    }

    public function getInfoById($id) {
        $sql = "select * from tb_user where id = {$id}";
        $query = $this->mysqli->query($sql);
        return $query;
    }

    public function addUserInfo($phone,$password,$name) {
        $sql = "insert into tb_user (phone,password,name) value ('{$name}', '{$phone}', '{$password}')";
        $query = $this->mysqli->query($sql);
        return $query;
    }
}