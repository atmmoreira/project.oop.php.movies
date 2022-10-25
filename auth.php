<?php

require_once("helpers.php");
require_once("connection.php");
require_once("models/User.php");
require_once("models/Messages.php");
require_once("dao/UserDAO.php");

$message = new Messages($BASE_URL);

// get type of forms
$type = filter_input(INPUT_POST, "type");
// verify type of form
if ($type === "register") {
  $name  = filter_input(INPUT_POST, "nameInput");
  $email  = filter_input(INPUT_POST, "emailInput");
  $password  = filter_input(INPUT_POST, "passwordInput");
  $confirmPassword  = filter_input(INPUT_POST, "confirmPasswordInput");

  if ($name && $email && $password) {
  } else {
    // Send messages
    $message->setMessage("Todos os campos são obrigatórios.", "error", "back");
  }
} else if ($type === "login") {
}
