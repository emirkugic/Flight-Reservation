<?php
require_once __DIR__ . '/BaseService.class.php';
require_once __DIR__ . '/../dao/FlightDao.class.php';


class FlightService extends BaseService
{
  public function __construct()
  {
    parent::__construct(new FlightDao());
  }

  public function searchFlights($departure_airport, $departure_date, $destination_airport, $arrival_date)
  {
    return $this->dao->searchFlights($departure_airport, $departure_date, $destination_airport, $arrival_date);
  }

}

?>
