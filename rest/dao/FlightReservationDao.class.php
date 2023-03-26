<?php

class FlightReservationDao{
    private $connection;

    //constructor to initialize the connection
    public function __construct(){
        try {
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbschema = "flight_reservation";

            $this->connection = new PDO("mysql:host=$servername;dbname=$dbschema", $username, $password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    //get user by the last ID
    public function users_by_id($id){
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }

    //add object to database
    public function add($first_name, $last_name, $email) {
    $stmt = $this->connection->prepare("INSERT INTO users (first_name, last_name, email) VALUES (:first_name, :last_name, :email)");
    $stmt->execute(['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email]);
}


    //get all objects from the table
    public function get_all(){
        $stmt = $this->connection->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //delete object from database
    public function delete($id){
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id); #prevent SQL injection
        $stmt->execute();
    }

    public function update($first_name, $last_name, $email, $id){
        $stmt = $this->connection->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email WHERE id = :id");
        $stmt->execute(['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'id' => $id]);
    }

}

?>