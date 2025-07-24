<?php require_once 'app/views/templates/header.php'; ?>

<div class="container" style="margin-top: 7rem; margin-bottom: 4rem;">
  <div class="page-header" id="banner">
    <div class="row">
      <div class="col-lg-12">
          <h1 class="text-white">Watchlist</h1>
        <div class="d-flex flex-row align-items-center gap-4">
              <?php if (!empty($watchlist)): ?>
                <?php foreach ($watchlist as $movie): ?>
                  <div class="mb-4">
                    <?php require 'app/views/templates/components/movie_card.php'; ?>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="col-12">
                  <p class="text-muted">Your watchlist is empty.</p>
                </div>
              <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>