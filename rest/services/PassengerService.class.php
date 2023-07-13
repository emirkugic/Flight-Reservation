<?php
require_once __DIR__ . '/BaseService.class.php';
require_once __DIR__ . '/../dao/PassengerDao.class.php';


class PassengerService extends BaseService
{
  public function __construct()
  {
    parent::__construct(new PassengerDao());
  }

  public function add($passenger)
  {
    return $this->dao->add($passenger);
  }

}

?>
