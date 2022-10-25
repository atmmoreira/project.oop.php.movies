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

  <h1>Filmes</h1>
  <div class="row">
    <div class="col-md-3">
      <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Card title </h5>
            <small class="badge text-bg-warning rounded-pill h-25 d-flex align-items-center"><i class="ph-star-bold"></i> <span>5</span></small>
          </div>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <div class="d-flex justify-content-between">
            <a href="#" class="btn btn-primary btn-sm">Avaliar</a>
            <a href="#" class="btn btn-success btn-sm">Conhecer</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('templates/footer.php'); ?>