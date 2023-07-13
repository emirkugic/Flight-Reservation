<?php
require_once __DIR__ . '/BaseDao.class.php';

class PassengerDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("passengers");
    }

    
}
