<?php

class FlightReservationDao
{
    private $conn;

    //constructor to establish the connection
    public function __construct()
    {
        try {
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $schema = "flight_reservation";
            $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    //method for getting all users from database
    public function get_all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //method for getting user by id from the database
    public function get_by_id($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }

    //method for adding user to the database
    public function add($user)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number) VALUES (:first_name, :last_name, :email, :phone_number)");
        $stmt->execute($user);
        $student['id'] = $this->conn->lastInsertId();
        return $user;
    }

    //method for updating user in the database
    public function update($user, $id)
    {
        $user['id'] = $id;
        $stmt = $this->conn->prepare("UPDATE users SET first_name = :first_name, last_name=:last_name, email = :email, phone_number = :phone_number WHERE id=:id");
        $stmt->execute($user);
        return $user;
    }

    //method for deleting user from the database
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id); #prevent SQL injection
        $stmt->execute();
    }
}
