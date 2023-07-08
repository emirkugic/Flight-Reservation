<?php
require_once __DIR__ . '/BaseDao.class.php';


class UserDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("users");
    }

    public function login($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $email]);
        return $stmt->fetchAll();
    }
}
