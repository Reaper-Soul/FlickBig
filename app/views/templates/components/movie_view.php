<?php
  $activeTab = 'cast';
?>


<div class="modal fade" id="movieModal" tabindex="-1" aria-labelledby="movieModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-xl">
  <div class="modal-content movie-modal-content text-white">
    <div class="modal-header border-0">
      <button type="button" class="btn-close white-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="d-flex flex-row">
          <img alt="" class="img-fluid movie-poster" src="">

          <div class="d-flex flex-column" style="flex: 8">
            <div class="d-flex align-items-center mb-2">
              <h2 class="movie-title me-4">Avengers</h2>
              <i class="bi bi-star-fill me-2" style="color: var(--highlight-color)"></i>
              <span class="movie-rating">9.9 / 10</span>
            </div>

            <div class="d-flex align-items-center movie-meta text-white">
              <p class="me-3">2012</p>
              <p class="me-3 separator">⬤</p>
              <p class="me-3">A</p>
              <p class="me-3 separator">⬤</p>
              <p>2h 23m</p>
            </div>

            <p class="fs-5 mt-2 d-flex" style="color: var(--text-primary)">
              <span class="fw-bold" style="margin-right:0.8rem; ">Flick Score:</span>
              <span class="flick-score-text" style="letter-spacing: 0.1rem; word-spacing: 0.1rem">4</span>
              <span style="color: var(--highlight-color); letter-spacing: 0.1rem; word-spacing: 0.1rem">/5</span>
            </p>

            <h5 class="mt-4 fw-bold text-white">Synopsis</h5>
            <p class="text-white">Something just happened.</p>

            <div class="d-flex mt-3">
              <p class="me-5 text-white">
                <span class="fw-bold">Director</span><br>Josh Wahlen
              </p>
              <p class="text-white">
                <span class="fw-bold">Writers</span><br>Zark Penn
              </p>
            </div>
            <div class="d-flex mt-4 flex-row gap-3 fs-5">
              <button
                class="btn btn-highlight"
                style="width: fit-content"
                onclick="<?= isset($_SESSION['username']) 
                    ? "alert('Feature not yet implemented.')" 
                    : "window.location.href='/login'" ?>"
              >
                <i class="bi bi-file-plus-fill me-1"></i>
                Add to Watchlist
              </button>
              <?php if (isset($_SESSION['username'])): ?>
              <div class="user-rating">
                <p class="text-white fw-bold fs-6">Rate It</p>
                <br>
                <input value="5" name="rating" id="star5" type="radio">
                <label for="star5"></label>
                <input value="4" name="rating" id="star4" type="radio">
                <label for="star4"></label>
                <input value="3" name="rating" id="star3" type="radio">
                <label for="star3"></label>
                <input value="2" name="rating" id="star2" type="radio">
                <label for="star2"></label>
                <input value="1" name="rating" id="star1" type="radio">
                <label for="star1"></label>
              </div>
              <?php endif;?>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <nav class="tab-wrapper position-relative pb-3">
          <button class="btn tab-btn active-tab me-4 text-white fw-bold" data-tab-target="movie-cast">Cast</button>
          <button class="btn tab-btn text-white fw-bold" data-tab-target="movie-reviews">AI Review</button>
          <div class="tab-underline"></div> 
        </nav>
        <div class="tab-content mt-3">
          <div class="tab-pane movie-cast fade show active" id="movie-cast">
            Someone
          </div>
          <div class="tab-pane movie-reviews fade show" id="movie-reviews">
            No commento!
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  const movieModal = document.getElementById("movieModal");
  
  movieModal.addEventListener("shown.bs.modal", function () {
    const active = document.querySelector('.active-tab');
    if (active) moveUnderline(active);
  });
  
  const tabButtons = document.querySelectorAll('.tab-btn');
  const underline = document.querySelector('.tab-underline');
  const tabContents = document.querySelectorAll('.tab-pane');

  function moveUnderline(el) {
    const rect = el.getBoundingClientRect();
    const containerRect = el.parentElement.getBoundingClientRect();
    underline.style.width = `${rect.width}px`;
    underline.style.left = `${rect.left - containerRect.left}px`;
  }

  tabButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelector('.active-tab').classList.remove('active-tab');
      this.classList.add('active-tab');

      const target = this.getAttribute('data-tab-target');
      tabContents.forEach(content => {
        content.style.display = content.id === target ? 'block' : 'none';
      });
      
      moveUnderline(this);
    });
  });

  window.addEventListener('DOMContentLoaded', () => {
    const active = document.querySelector('.active-tab');
    if (active) moveUnderline(active);
  });
  document.querySelectorAll('input[name="rating"]').forEach(radio => {
    radio.addEventListener('change', function () {
      const rating = this.value;
      const imdbId = movieModal.getAttribute('imdbid');

      fetch('/movies/addRating', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          imdbId: imdbId,
          rating: rating
        })
      })
      .then(response => {
        if (!response.ok) throw new Error('Failed to submit rating');
        return response.json();
      })
      .catch(err => {
        console.error(err);
        alert('There was an error submitting your rating.');
      });
    });
  });
</script>

<style>
  .btn-close.white-close {
    filter: invert(1);
  }

  .btn.active-tab{
    color: var(--highlight-color) !important;
  }

  .tab-btn {
    position: relative;
    background: none;
    border: none;
    border-radius: 0;
    padding-bottom: 6px;
    font-size: 1rem;
  }

  .tab-underline {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 2px;
    width: 60px; 
    background-color: var(--highlight-color);
    transition: left 0.3s ease, width 0.3s ease;
  }

  .modal-body{
    overflow-y: auto;
    overflow-x: hidden;
    max-height: 100%;
  }
  
  .movie-modal-content {
    height: 90vh;
    background-color: var(--secondary-color);
    padding: 2rem;
  }

  .movie-poster {
    flex: 2;
    margin-right: 2rem;
    aspect-ratio: 1/1.2;
    border: none;
    outline: none;
  }

  .movie-title {
    color: var(--text-primary);
    font-weight: bolder;
  }

  .movie-rating {
    font-size: large;
    color: var(--text-primary);
  }

  .movie-meta p {
    margin-bottom: 0;
  }

  .separator {
    font-size: xx-small;
  }

  .btn-highlight {
    background-color: var(--highlight-color);
    color: var(--secondary-color);
    font-weight: bold;
    border-radius: 20px;
    padding: 0.5rem 0.7rem;
    border: none;
  }

  .user-rating {
    display: inline-block;
    margin-left: 1rem;
    line-height: .6rem;
    text-align: center;
  }

  .user-rating p{
    margin: 0;
  }

  .user-rating input {
    display: none;
  }

  .user-rating label {
    scale: 1.2;
    float: right;
    margin: 0 0.2rem;
    cursor: pointer;
    color: #ccc;
    transition: color 0.3s;
  }

  .user-rating label:before {
    content: '\2605';
  }

  .user-rating input:checked ~ label,
  .user-rating label:hover,
  .user-rating label:hover ~ label {
    color: var(--highlight-color);
    transition: color 0.3s;
  }
</style>