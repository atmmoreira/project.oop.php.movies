<?php
require_once("helpers.php");
include_once('templates/header.php');
require_once("models/Messages.php");

$messages = new Messages($BASE_URL);
$getMessage = $messages->getMessage();

var_dump($messages);
var_dump($getMessage);

if (!empty($getMessage["textMessage"])) {
  // Clear message
}

?>

<div class="container mt-3">
  <div class="messages">
    <?php if (!empty($getMessage["textMessage"])) : ?>
      <div class="alert alert-<?php $getMessage["typeMessage"]; ?> text-center" role="alert">
        <?php $getMessage["textMessage"]; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="row">
    <div class="col-md-4 m-auto bg-blue">
      <h1 class="text-center">Criar Conta</h1>
      <form method="POST" action="auth.php">
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
      </form>
    </div>

  </div>
</div>

<?php include_once('templates/footer.php'); ?>