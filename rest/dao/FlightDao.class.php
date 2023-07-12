<?php
require_once __DIR__ . '/BaseDao.class.php';

class FlightDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("flights");
    }

    public function searchFlights($departure_city, $departure_date, $destination_city, $arrival_date)
    {
        $stmt = $this->conn->prepare("
            SELECT c1.city_name as departure_city, f.departure_date, c2.city_name as destination_city, f.arrival_date, f.departure_time, f.arrival_time, f.id 
            FROM flights f
            JOIN routes r ON f.route_id = r.id
            JOIN airports dep ON r.departure_airport = dep.airport_code
            JOIN airports dest ON r.destination_airport = dest.airport_code
            JOIN cities c1 ON dep.city_id = c1.id
            JOIN cities c2 ON dest.city_id = c2.id
            WHERE f.departure_date LIKE ? AND c1.city_name LIKE ? AND c2.city_name LIKE ? AND f.arrival_date LIKE ?");

        $stmt->execute([
            '%' . $departure_date . '%',
            '%' . $departure_city . '%',
            '%' . $destination_city . '%',
            '%' . $arrival_date . '%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
