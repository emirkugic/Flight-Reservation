<?php
require_once __DIR__ . '/BaseDao.class.php';

class BookedTicketDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("booked_tickets");
    }
}