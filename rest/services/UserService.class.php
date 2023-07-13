<?php
require_once __DIR__ . '/BaseService.class.php';
require_once __DIR__ . '/../dao/UserDao.class.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserService extends BaseService
{
  public function __construct()
  {
    parent::__construct(new UserDao());
  }

  public function login($data)
{
  $user = $this->dao->login($data['email']);

  if (count($user) > 0) {
    $user = $user[0];
  }

  if (isset($user['id'])) {
    if (md5($data['password']) == $user['password']) { 
      unset($user['password']);
      $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
      return ["status" => true, "message" => "Login successful", "token" => $jwt];
    } else {
      return ["status" => false, "message" => "Wrong password"];
    }
  } else {
    return ["status" => false, "message" => "User doesn't exist"];
  }
}


  public function addUser($user)
{
  if (!$this->dao->isEmailUnique($user['email'])) {
    return ['status' => 'error', 'message' => 'Email address already exists'];
  }
  $user['password'] = md5($user['password']);

  return $this->dao->addUser($user);
}

  public function getUser($id)
  {
    return $this->dao->get_by_id($id);
  }

  public function updateUser($id, $user)
{
    if (!$this->dao->isEmailUnique($user['email'], $id)) {
        return ['status' => 'error', 'message' => 'Email address already exists'];
    }
    return $this->dao->update($user, $id);
}


}
