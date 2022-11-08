<?php
include_once('helpers.php');
include_once('connection.php');
require_once('dao/UserDAO.php');
require_once("models/Messages.php");

$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken(false);

$messages = new Messages($BASE_URL);
$getMessage = $messages->getMessage();

if (!empty($getMessage['textMessage'])) {
  $messages->clearMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Project - Movies Object Oriented Programming with PHP</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
  <!-- the fileinput plugin styling CSS file -->
  <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">MOVIE PHP (oop)</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="login.php">Logar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
            <?php if ($userData) : ?>
              <li class="nav-item">
                <a class="nav-link" href="editProfile.php">Edit Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            <?php endif; ?>
          </ul>
          <form class="d-flex" role="search" method="GET">
            <input class="form-control me-2" type="search" placeholder="Buscar Filme" aria-label="Pesquisar">
            <button class="btn btn-outline-light" type="submit">Pesquisar</button>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <div class="messages mt-2 col-md-4 mx-auto">
    <?php if (!empty($getMessage['textMessage'])) : ?>
      <div class="alert alert-<?= $getMessage['typeMessage']; ?> text-center" role="alert">
        <?= $getMessage['textMessage']; ?>
      </div>
    <?php endif; ?>
  </div>