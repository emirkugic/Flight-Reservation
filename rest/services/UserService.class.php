<?php
require_once __DIR__ . '/BaseService.class.php';
require_once __DIR__ . '/../dao/UserDao.class.php';


class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new UserDao);
    }


    function getUserByFirstNameAndLastName($firstName, $lastName)
    {
        return $this->dao->getUserByFirstNameAndLastName($firstName, $lastName);
    }

    public function get_by_email_and_password($email, $password)
    {
        return $this->dao->get_by_email_and_password($email, $password);
    }
}
