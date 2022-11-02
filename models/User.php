<?php

class User
{
  public $id;
  public $name;
  public $email;
  public $password;
  public $image;
  public $biography;
  public $token;

  public function generateToken()
  {
    return bin2hex(random_bytes(50));
  }

  public function generatePassword($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }
}

interface IUserDAO
{
  public function authenticateUser($email, $password);
  public function buildUser($data);
  public function changePassword(User $user);
  public function create(User $user, $authUser = false);
  public function destroyToken();
  public function findByEmail($email);
  public function findById($id);
  public function findByToken($token);
  public function setTokenToSession($token, $redirect = true);
  public function update(User $user);
  public function verifyToken($protected = false);
}
