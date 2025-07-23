<template id="search-card">
<li class="list-group-item border-0 bg-transparent mb-2" style="padding: 0; width: 100%;">
<div class="card rounded border-0 overflow-hidden" style="background-color: transparent; cursor: pointer; border-radius: 0px !important; flex: 1; text-align: start; border-bottom: 1px solid var(--text-disabled);">
      <div class="card-body p-2">
            <h6 class="movie-title card-title text-truncate mb-2 fw-bold" style="color: var(--text-primary);"></h6>
            <div class="d-flex align-items-center small mt-1" style="color: var(--text-primary);">      
                  <i class="bi bi-star-fill me-2" style="color: var(--highlight-color)"></i>
                  <span class="movie-rating"></span>
                  <span class="mx-2">|</span>
                  <span class="movie-year"></span>
            </div>
      </div>
</div>
</li>
</template>