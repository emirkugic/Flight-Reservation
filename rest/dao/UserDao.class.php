<?php
require_once __DIR__ . '/BaseDao.class.php';


class UserDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("users");
    }


    // custom function, which is not present in BaseDao
    // query_unique -> returns only 1 result if multiple are present
    function getUserByFirstNameAndLastName($firstName, $lastName)
    {
        return $this->query_unique("SELECT * FROM users WHERE first_name = :firstName AND last_Name = :lastName", ["firstName" => $firstName, "lastName" => $lastName]);
    }
}
