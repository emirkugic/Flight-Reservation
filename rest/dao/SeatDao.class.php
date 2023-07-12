<?php
require_once __DIR__ . '/BaseDao.class.php';

class SeatDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("seats");
    }

    public function reserveSeat($row, $column)
    {
        $stmt = $this->conn->prepare("UPDATE seats SET status = 1 WHERE `row` = ? AND `column` = ?");
        $stmt->execute([$row, $column]);
    }
}
