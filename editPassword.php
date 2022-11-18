<?php
require_once("helpers.php");
include_once('templates/header.php');
// $userDao came from header
$userDao->verifyToken(true);
?>

<div class="container mt-3">
  <div class="row">
    <div class="col-md-6 m-auto bg-blue">
      <form method="POST" action="auth.php">
        <input type="hidden" name="type" value="changePassword">
        <h1 class="text-center text-uppercase">Atualizar Senha </h1>
        <hr class="mb-5">
        <div class="row">
          <div class="mb-3 col">
            <label for="passwordInput" class="form-label">Senha</label>
            <input type="password" class="form-control" id="passwordInput" name="passwordInput" value="<?= $userData->password; ?>" />
          </div>
          <div class="mb-3 col">
            <label for="confirmPasswordInput" class="form-label">Confirmar Senha</label>
            <input type="password" class="form-control" id="confirmPasswordInput" name="confirmPasswordInput" value="<?= $userData->password; ?>" />
          </div>
        </div>
        <button type="submit" class="btn btn-dark w-100 mt-3">Atualizar</button>
      </form>
    </div>

  </div>
</div>

<?php include_once('templates/footer.php'); ?>