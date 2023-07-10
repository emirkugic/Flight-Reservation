<?php
require_once __DIR__ . '/BaseDao.class.php';

class FlightDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("flight");
    }

    public function searchFlights($departure_airport, $departure_date, $destination_airport, $arrival_date)
    {
        $stmt = $this->conn->prepare("
            SELECT departure_airport, departure_date, destination_airport, arrival_date 
            FROM flights f
            JOIN routes r ON f.route_id = r.id
            JOIN airports dep ON r.departure_airport = dep.airport_code
            JOIN airports dest ON r.destination_airport = dest.airport_code
            WHERE departure_date LIKE ? AND departure_airport LIKE ? AND destination_airport LIKE ? AND arrival_date LIKE ?");
        
        $stmt->execute([
            '%' . $departure_date . '%', 
            '%' . $departure_airport . '%', 
            '%' . $destination_airport . '%', 
            '%' . $arrival_date . '%'
        ]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
