<?php
  $poster_url = $movie['Poster'];
  $title = $movie['Title'];
  $rating = $movie['imdbRating'];
  $year = $movie['Year'];
?>

<div class="card rounded border-0 overflow-hidden" style="background-color: var(--secondary-color); cursor: pointer; border-radius: 10px !important; max-width: 10rem; flex: 1;">
<img alt="Movie Poster" class="card-img-top img-fluid" src="<?= htmlspecialchars($poster_url) ?>" style="height: 8rem; width: 10rem; object-fit: fill;"/>
<div class="card-body p-2">
<h6 class="card-title text-truncate mb-2 fw-bold" style="color: var(--text-primary);"><?= htmlspecialchars($title) ?></h6>
<div class="d-flex align-items-center small mt-1" style="color: var(--text-primary);">
<i class="bi bi-star-fill me-2" style="color: var(--highlight-color)"></i>
<span><?= htmlspecialchars($rating) ?></span>
<span class="mx-2">|</span>
<span><?= htmlspecialchars($year) ?></span>
</div>
</div>
</div>

<style>
  .card{
    transition: transform 0.3s ease;
  }
  .card:hover{
    transform: scale(1.02);
    scale-origin: top;
  }
</style>