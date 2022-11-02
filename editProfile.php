<?php
require_once("helpers.php");
include_once('templates/header.php');
// $userDao came from header
$userDao->verifyToken(true);
?>

<div class="container mt-3">
  <div class="row">
    <div class="col-md-4 m-auto bg-blue">
      <h1 class="text-center">Editar Perfil</h1>
      <!-- <form method="POST" action="auth.php">
        <input type="hidden" name="type" value="register">
        <div class="mb-3">
          <label for="nameInput" class="form-label">Nome Completo</label>
          <input type="text" class="form-control" id="nameInput" name="nameInput" />
        </div>
        <div class="mb-3">
          <label for="emailInput" class="form-label">Email</label>
          <input type="email" class="form-control" id="emailInput" name="emailInput" />
        </div>
        <div class="mb-3">
          <label for="passwordInput" class="form-label">Senha</label>
          <input type="password" class="form-control" id="passwordInput" name="passwordInput" />
        </div>
        <div class="mb-3">
          <label for="confirmPasswordInput" class="form-label">Confirmar Senha</label>
          <input type="password" class="form-control" id="confirmPasswordInput" name="confirmPasswordInput" />
        </div>
        <button type="submit" class="btn btn-dark w-100">Registrar</button>
      </form> -->
    </div>

  </div>
</div>

<?php include_once('templates/footer.php'); ?>