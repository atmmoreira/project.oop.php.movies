<?php
require_once("helpers.php");
include_once('templates/header.php');
// $userDao came from header
$userDao->verifyToken(true);
?>

<div class="container mt-3">
  <div class="row">
    <div class="col-md-6 m-auto bg-blue">
      <form method="POST" action="auth.php" enctype="multipart/form-data">
        <input type="hidden" name="type" value="profile">
        <h1 class="text-center text-uppercase">Edição de Perfil </h1>
        <hr class="mb-5">
        <div class="row">
          <div class="col-md-3 text-center">
            <img src="assets/images/<?= $userData->avatar; ?>" class="img-thumbnail img-fluid" alt="...">
            <div class="mb-3 mt-2">
              <input class="form-control form-control-sm file w-100" data-preview-file-type="text" type="file" id="avatarInput" name="avatarInput" placeholder="">
              <small class="text-danger text-uppercase">Somente PNG.</small>
            </div>
          </div>
          <div class="col">
            <h3> <?= $userData->name; ?> </h3>
            <small><?= $userData->email; ?></small>
            <p><?= $userData->biography; ?></p>
          </div>
        </div>
        <div class="row mt-4">
          <div class="mb-3 col">
            <label for="nameInput" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nameInput" name="nameInput" value="<?= $userData->name; ?>" />
          </div>
          <div class="mb-3 col">
            <label for="emailInput" class="form-label">Email</label>
            <input type="email" readonly class="form-control readonly" id="emailInput" name="emailInput" value="<?= $userData->email; ?>" />
          </div>
        </div>
        <div class="row">
          <div class="mb-3">
            <label for="biographyInput" class="form-label">Biografia</label>
            <textarea class="form-control" id="biographyInput" name="biographyInput" rows="3"><?= $userData->biography; ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-dark w-100 mt-3">Atualizar Dados</button>
          </div>
          <div class="col-md-6">
            <a href="editPassword.php" class="btn btn-danger w-100 mt-3">Atualizar senha</a>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>

<?php include_once('templates/footer.php'); ?>