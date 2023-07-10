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


    public function addUser($user)
    {
        try {
            return $this->add($user);
        } catch (PDOException $e) {
            echo "Error adding user: " . $e->getMessage();
            return null;
        }
    }

    public function isEmailUnique($email)
    {
        // check if email unique
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // if the count is 0, then the email is unique
        return $stmt->fetchColumn() == 0;
    }
}
