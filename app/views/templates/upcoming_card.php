<?php
  $poster_url = $movie['Poster'];
  $title = $movie['Title'];
  $release = $movie['Released'];
?>

<div class="card rounded border-0 w-100 d-flex flex-row py-3 px-3" style="background-color: var(--secondary-color); cursor: pointer; border-radius: 0.25em !important; max-height: 12rem;">
<img alt="Movie Poster" class="card-img-top img-fluid" src="<?= htmlspecialchars($poster_url) ?>" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('d-none');" style="height: 6rem; max-width: 3.5rem; object-fit: cover;"/>
<div class="fallback-img d-none align-items-center justify-content-center p-2" style=" height: 6rem; max-width: 3.5rem; background-color: #ccc; color: #555; font-size: 0.75rem;">
    No Image
</div>
<div class="card-body p-3 d-flex flex-column justify-content-center">
<h6 class="card-title text-truncate mb-0 fw-bold" style="color: var(--text-primary);"><?= htmlspecialchars($title) ?></h6>
<div class="d-flex align-items-center small mt-1" style="color: var(--text-primary);">
<span>Release: <?= htmlspecialchars($release) ?></span>
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