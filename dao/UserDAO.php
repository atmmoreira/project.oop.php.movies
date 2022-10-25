<?php

require_once('models/User.php');

class UserDAO implements IUserDAO
{
  private $conn;
  private $url;

  public function __construct(PDO $conn, $url)
  {
    $this->conn = $conn;
    $this->url = $url;
  }
  public function buildUser($data)
  {
    $user = new User();
    $user->id = $data['id'];
    $user->name = $data['nameInput'];
    $user->email = $data['emailInput'];
    $user->password = $data['passwordInput'];
    $user->image = $data['image'];
    $user->biography = $data['biography'];
    $user->token = $data['token'];
    return $user;
  }
  public function create(User $user, $authUser = false)
  {
  }
  public function update(User $user)
  {
  }
  public function verifyToken($protected = false)
  {
  }
  public function setTokenToSession($token, $redirect = true)
  {
  }
  public function authenticateUser($email, $password)
  {
  }
  public function findByEmail($emal)
  {
  }
  public function findById($id)
  {
  }
  public function findByToken($token)
  {
  }
  public function changePassword(User $user)
  {
  }
}
