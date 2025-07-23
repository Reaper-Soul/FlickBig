<?php
  $image = $celeb['image'];
  $name = $celeb['name'];
?>
<div class="celeb-card d-flex flex-column align-items-center" style="cursor: pointer;">
  <img loading="lazy" alt="Celeb" class="celeb-img ratio ratio-1x1 card-img-top mb-0 img-fluid" src="<?= htmlspecialchars($image) ?>" style="height: 6rem; width: 6rem; object-fit: cover; border-radius: 50%;"/>
  <div class="card-body mt-0 p-1 text-center">
    <p class="name"><?= htmlspecialchars($name) ?></p>
  </div>
</div>


  <style>
    .name{
      color: var(--text-primary);
    }
    .celeb-img{
      border: inset 0.2em var(--text-primary);
      transition: border 0.2s ease-in;
    }
    .celeb-card:hover .celeb-img{
      border: inset 0.1em var(--accent-color);
    }
  </style>