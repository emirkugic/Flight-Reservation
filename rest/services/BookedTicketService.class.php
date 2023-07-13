<?php
require_once __DIR__ . '/BaseService.class.php';
require_once __DIR__ . '/../dao/BookedTicketDao.class.php';


class BookedTicketService extends BaseService
{
  public function __construct()
  {
    parent::__construct(new BookedTicketDao());
  }

  public function add($booked_ticket)
  {
    return $this->dao->add($booked_ticket);
  }
  
}

?>
