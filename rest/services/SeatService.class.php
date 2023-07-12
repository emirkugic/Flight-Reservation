<?php
require_once __DIR__ . '/BaseService.class.php';
require_once __DIR__ . '/../dao/SeatDao.class.php';


class SeatService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new SeatDao());
    }

    public function reserveSeat($row, $column)
    {
        $this->dao->reserveSeat($row, $column);
    }
}
