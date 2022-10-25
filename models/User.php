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
}

interface IUserDAO
{
  public function buildUser($data);
  public function create(User $user, $authUser = false);
  public function update(User $user);
  public function verifyToken($protected = false);
  public function setTokenToSession($token, $redirect = true);
  public function authenticateUser($email, $password);
  public function findByEmail($emal);
  public function findById($id);
  public function findByToken($token);
  public function changePassword(User $user);
}
