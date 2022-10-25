<?php
include_once('templates/header.php');
$messages = [];
?>

<div class="container mt-3">
  <div class="messages">
    <?php if (!empty($messages["message"])) : ?>
      <div class="alert alert-<?php $messages["type"]; ?> text-center" role="alert">
        <?php $messages["message"]; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="row">
    <div class="col-md-4 m-auto bg-blue">
      <h1 class="text-center">Acessar Sistema</h1>
      <form method="POST">
      <input type="hidden" name="type" value="login">
        <div class="mb-3">
          <label for="emailInput" class="form-label">Email</label>
          <input type="email" class="form-control" id="emailInput" name="emailInput">
        </div>
        <div class="mb-3">
          <label for="passwordInput" class="form-label">Senha</label>
          <input type="password" class="form-control" id="passwordInput" name="passwordInput">
        </div>
        <button type="submit" class="btn btn-dark w-100">Logar</button>
      </form>
    </div>

  </div>
</div>

<?php include_once('templates/footer.php'); ?>