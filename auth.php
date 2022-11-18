<?php

require_once("helpers.php");
require_once("connection.php");
require_once("models/User.php");
require_once("models/Messages.php");
require_once("dao/UserDAO.php");

$message = new Messages($BASE_URL);
$user = new User();
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
    $message->setMessage("Seja bem vindo!", "success", "editProfile.php");
  } else {
    $message->setMessage("Usuário e/ou senha incorretos!", "danger", "back");
  }
} else if ($type === "profile") {
  $userData = $userDao->verifyToken();
  // Get data from POST
  $name = filter_input(INPUT_POST, "nameInput");
  $email = filter_input(INPUT_POST, "emailInput");
  $biography = filter_input(INPUT_POST, "biographyInput");

  // Filled data user
  $userData->name = $name;
  $userData->email = $email;
  $userData->biography = $biography;

  // Image
  if (isset($_FILES["avatarInput"]) && !empty($_FILES["avatarInput"]["tmp_name"])) {
    $avatar = $_FILES["avatarInput"];
    $avatarTypes = ["image/jpeg", "image/jpg", "image/png"];
    $avatarJpegTypes = ["image/jpeg", "image/jpg"];

    // Verificar porque não salva jpeg-jpg
    if (in_array($avatar["type"], $avatarTypes)) {
      if (in_array($avatar, $avatarJpegTypes)) {
        $imageFile = imagecreatefromjpeg($avatar["tmp_name"]);
      } else {
        $imageFile = imagecreatefrompng($avatar["tmp_name"]);
      }

      $imageName = $user->generateImageName();
      imagejpeg($imageFile, "./assets/images/" . $imageName, 100);
      $userData->avatar = $imageName;
    } else {
      $message->setMessage("Tipo inválido de imagem!", "danger", "index.php");
    }
  }
  // Update User
  $userDao->update($userData);
} else if ($type === "changePassword") {
  $password = filter_input(INPUT_POST, "passwordInput");
  $confirmPassword = filter_input(INPUT_POST, "confirmPasswordInput");
  $userData = $userDao->verifyToken();
  $id = $userData->id;

  if ($password == $confirmPassword) {
    $user = new User();
    $finalPassword = $user->generatePassword($password);
    $user->password = $finalPassword;
    $user->id = $id;
    $userDao->changePassword($user);
  } else {
    $message->setMessage("Senhas devem ser iguais!", "warning", "back");
  }
} else {
  $message->setMessage("Informações inválidas!", "danger", "back");
}
