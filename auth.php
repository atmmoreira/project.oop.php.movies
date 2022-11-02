<?php

require_once("helpers.php");
require_once("connection.php");
require_once("models/User.php");
require_once("models/Messages.php");
require_once("dao/UserDAO.php");

$message = new Messages($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

// get type of forms
$type = filter_input(INPUT_POST, "type");

// verify type of form
if ($type === "register") {
  $name  = filter_input(INPUT_POST, "nameInput");
  $email  = filter_input(INPUT_POST, "emailInput");
  $password  = filter_input(INPUT_POST, "passwordInput");
  $confirmPassword  = filter_input(INPUT_POST, "confirmPasswordInput");

  if ($name && $email && $password) {
    // Check password
    if ($password === $confirmPassword) {
      // Check email registered
      if ($userDao->findByEmail($email) === false) {
        $user = new User();
        // Create token
        $userToken = $user->generateToken();
        $finalPassword = $user->generatePassword($password);
        // Create Object
        $user->name = $name;
        $user->email = $email;
        $user->password = $finalPassword;
        $user->token = $userToken;

        $auth = true;
        $userDao->create($user, $auth);
      } else {
        $message->setMessage("Usuário já cadastrado.", "danger", "back");
      }
    } else {
      $message->setMessage("As senhas devem ser iguais.", "danger", "back");
    }
  } else {
    $message->setMessage("Todos os campos são obrigatórios.", "danger", "back");
  }
} else if ($type === "login") {
  $email  = filter_input(INPUT_POST, "emailInput");
  $password  = filter_input(INPUT_POST, "passwordInput");
  // Autentication
  if ($userDao->authenticateUser($email, $password)) {
  } else {
    $message->setMessage("Usuário e/ou senha incorretos!", "danger", "back");
  }
}else {
  $message->setMessage("Informações inválidas!", "danger", "index.php");
}
