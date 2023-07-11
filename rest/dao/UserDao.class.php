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

    public function isEmailUnique($email, $id = null)
{
    $query = "SELECT COUNT(*) FROM users WHERE email = :email";
    if($id) {
        $query .= " AND id != :id";
    }

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':email', $email);
    if($id) {
        $stmt->bindParam(':id', $id);
    }
    $stmt->execute();

    // if the count is 0, then the email is unique
    return $stmt->fetchColumn() == 0;
}



    public function updateUser($user, $id)
    {
    try {
        $sql = "UPDATE users SET ";
        foreach ($user as $key => $value) {
            $sql .= $key . " = :" . $key . ", ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $user['id'] = $id;
        $stmt->execute($user);
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "Error updating user: " . $e->getMessage();
        return null;
    }
}

}
