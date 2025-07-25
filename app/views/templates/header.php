<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="app/public/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="icon" href="app/public/pics/logo.svg" type="image/svg+xml">
    <title>flickBIG - <?= ucwords(htmlspecialchars($_SESSION['current_page'] ?? 'Home')) ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark px-5" style="background-color: var(--background-color-transparent) !important; border-bottom: 0.1em solid var(--text-disabled) !important; backdrop-filter: blur(8px); transition: backdrop-filter 0.3s ease;">
  <div class="container-fluid">
    <div class="d-flex align-items-center justify-content-center">
      <div class="spotlight"></div>
      <a class="navbar-brand" href="/home"><img loading="eager" src="app/public/pics/logo.svg" alt="Logo" width="70" height="55" style="margin: auto 0; padding: 2px;"/></a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0 ms-5 gap-4 align-items-center">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/watchlist">Watchlist</a>
        </li>
      </ul>

      <div class="d-flex flex-row align-items-center gap-3">
        <div class="d-flex flex-row align-items-center">
          
          <div class="input-wrapper d-flex flex-row align-tems-center position-relative">
          <input id="SearchInput" type="text" class="form-control bg-transparent" placeholder="Search..." aria-label="Search" style="border: none; outline: none; box-shadow: none; color: var(--text-primary) !important;">
          <button class="btn" style="border: none; outline: none; box-shadow: none; cursor: pointer;">
            <i class="search bi bi-search fw-bold" style="color: var(--text-primary);"></i>
          </button>
        </div>

        <ul id="SearchResults" class="list-group position-absolute" style="z-index: 1000; display: none; background-color: var(--secondary-color); backdrop-filter: blur(8px); margin-top: 2.5rem; margin-inline: 0.4rem; width: 15%; text-align: center; padding: 1rem; max-height: 12rem; overflow-y: auto; overflow-x: hidden; align-self: flex-start; border-radius: 0.5rem"> 
        </ul>
          
        </div>
        <?php if (isset($_SESSION['username'])): ?>
          <div class="dropdown">
            <button 
              class="btn search-btn fw-semibold d-flex flex-row gap-2 align-items-center dropdown-toggle" 
              id="userDropdown" 
              data-bs-toggle="dropdown" 
              aria-expanded="false"
              style="border: none; outline: none; box-shadow: none; cursor: pointer; color: var(--text-primary);"
            >
              <i class="bi bi-person-circle fs-5"></i>
              <span class="fs-6"><?= $_SESSION['username']; ?></span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="background-color: var(--secondary-color); backdrop-filter: blur(8px);">
              <li>
                <form action="/logout" method="post" class="px-3">
                  <button type="submit" class="btn btn-sm btn-outline-danger w-100">Logout</button>
                </form>
              </li>
            </ul>
          </div>
        <?php else: ?>
          <button 
            class="btn search-btn fw-semibold d-flex flex-row gap-2 align-items-center" 
            onclick="window.location.href='/login'" 
            style="border: none; outline: none; box-shadow: none; cursor: pointer; color: var(--text-primary);"
          >
            <i class="bi bi-person-circle fs-5"></i>
            <span class="fs-6">Login</span>
          </button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<?php include 'app/views/templates/components/search_card.php'; ?>
<?php include 'app/views/templates/components/movie_view.php'; ?>
<?php include 'app/views/templates/components/alert.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
</body>
</html>


<script>
  document.getElementById('SearchInput').addEventListener('input', function(){
    const query = this.value.trim();
    const results = document.getElementById('SearchResults');
    const template = document.getElementById('search-card');
    
    if (query.length === 0){
      results.style.display = 'none';
      results.innerHTML = '';
      return;
    }
      fetch('/home/search',{
       method: 'POST',
       headers: {
         'Content-Type': 'application/json'
       },
        body: JSON.stringify({query: query}),
      })
      .then(res => res.json())
      .then(data => {
        results.innerHTML = '';
        const movies = data.results || [];
        if (movies.length === 0 || query.length === 0){
         results.style.display = 'none';
         results.innerHTML = '';
        } else{
          movies.forEach(movie =>{
            const button = document.createElement('button');
            button.className = 'bg-transparent border-0 open-movie-modal';
            button.setAttribute('data-bs-toggle', 'modal');
            button.setAttribute('data-bs-target', '#movieModal');

            button.dataset.title = movie.Title || '';
            button.dataset.rating = (movie.imdbRating && movie.imdbRating.toUpperCase() !== "N/A") ? movie.imdbRating : "0.0";
            button.dataset.year = movie.Year || '';
            const runtimeStr = movie.Runtime || '';
            if (/^\d+h\s\d+m$/.test(runtimeStr.trim())) {
              button.dataset.runtime = runtimeStr;
            } else {
              const runtimeMatch = runtimeStr.match(/\d+/);
              if (runtimeMatch) {
                const totalMinutes = parseInt(runtimeMatch[0]);
                const hours = Math.floor(totalMinutes / 60);
                const minutes = totalMinutes % 60;
                button.dataset.runtime = `${hours}h ${minutes}m`;
              } else {
                button.dataset.runtime = '';
              }
            }
            button.dataset.director = movie.Director || '';
            button.dataset.writers = movie.Writer || '';
            button.dataset.plot = movie.Plot || '';
            button.dataset.poster = movie.Poster || '';
            button.dataset.genre = movie.Genre || '';
            button.dataset.viewerrating = movie.viewerRating || '';
            button.dataset.flickscore = movie.flickScore || '0';
            button.dataset.cast = movie.Actors || '';
            button.dataset.imdbid = movie.imdbID || '';
            button.dataset.reviews = movie.Reviews || '';

            const li = template.content.cloneNode(true);
            li.querySelector('.movie-title').textContent = movie.Title;
            li.querySelector('.movie-year').textContent = movie.Year;
            li.querySelector('.movie-rating').textContent = movie.imdbRating;

            button.appendChild(li);
            results.appendChild(button);
            });
          results.style.display = 'flex';
        }
      })
      .catch(err => console.error(err));
  });
</script>

<!-- Fucntion for modal -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
      const movieModal = document.getElementById("movieModal");
      const reviewEl = movieModal.querySelector(".movie-reviews");
        
      movieModal.addEventListener("show.bs.modal", function (event) {
        reviewEl.textContent = 'Loading ...';
        
        const button = event.relatedTarget;

        fetch('/movies/getReview',{
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({title: button.dataset.title}),
        }).then(res => res.json())
          .then(data => {
            reviewEl.textContent = data.review || 'Review not found.';
          });
        const isLoggedIn = <?= isset($_SESSION['auth']) && $_SESSION['auth'] === 1 ? 'true' : 'false' ?>;
        if (isLoggedIn){
          fetch('/watchlist/exists',{
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              imdbId: button.dataset.imdbid
            }),
          }).then(res => res.json())
             .then(data => {
              const watchlistButton = movieModal.querySelector(".watchlist-btn");
               if (data.exists){
                 watchlistButton.style.display = 'none';
               }
             });
        }

        const modal = movieModal;
        modal.querySelector(".movie-title").textContent = button.dataset.title || '';
        const rating = button.dataset.rating;
        const finalRating = (rating && rating.toUpperCase() !== "N/A") ? rating : "0.0";
        modal.querySelector(".movie-rating").textContent = `${finalRating} / 10`;
        modal.querySelector(".movie-poster").src = button.dataset.poster || '';

        const runtimeStr = button.dataset.runtime || '';
        if (/^\d+h\s\d+m$/.test(runtimeStr.trim())) {
          button.dataset.runtime = runtimeStr;
        } else {
          const runtimeMatch = runtimeStr.match(/\d+/);
          if (runtimeMatch) {
            const totalMinutes = parseInt(runtimeMatch[0]);
            const hours = Math.floor(totalMinutes / 60);
            const minutes = totalMinutes % 60;
            button.dataset.runtime = `${hours}h ${minutes}m`;
          } else {
            button.dataset.runtime = 'N/A';
          }
        }
        
        modal.querySelector(".flick-score-text").textContent = button.dataset.flickscore || '0';

        const meta = modal.querySelector(".movie-meta");
        meta.innerHTML = `
          <p class="me-3">${button.dataset.year || ''}</p>
          <p class="me-3 separator">⬤</p>
          <p class="me-3">${button.dataset.genre || ''}</p>
          <p class="me-3 separator">⬤</p>
          <p>${button.dataset.runtime || ''}</p>
        `;

        modal.querySelector("p.text-white").textContent = button.dataset.plot || '';
        const ratingElem = modal.querySelectorAll('input[name="rating"]');
        ratingElem.forEach(star=>{
          star.checked = false;
        });

        const viewr = button.dataset.viewerrating || 0;

        const starElem = modal.querySelector(`#star${viewr}`);
        if (starElem) starElem.checked = true;
        
        const directorElem = modal.querySelectorAll("p.text-white")[1];
        const writerElem = modal.querySelectorAll("p.text-white")[2];
        if (directorElem) directorElem.innerHTML = `<span class="fw-bold">Director</span><br>${button.dataset.director || ''}`;
        if (writerElem) writerElem.innerHTML = `<span class="fw-bold">Writers</span><br>${button.dataset.writers || ''}`;
        
        modal.querySelector(".movie-cast").textContent = button.dataset.cast || '';

        modal.setAttribute("imdbid", button.dataset.imdbid || '');
        modal.setAttribute("title", button.dataset.title || '');
        modal.setAttribute("poster", button.dataset.poster || '');
        modal.setAttribute("year", button.dataset.year || '');
        modal.setAttribute("rating", finalRating || '');
      });
    });
</script>

<style>
  .nav-link {
    position: relative;
    color: var(--text-primary) !important;
    font-weight: 600;
    text-decoration: none;
  }

  input, .search{
    transition: color .3s ease, background-color .4s ease;
  } 

  .input-wrapper:has(input:focus) .search {
    color: var(--accent-color) !important;
  }

  input::placeholder{
    color: var(--text-secondary) !important;
  }
  
  input:focus {
    background-color: var(--secondary-color) !important;
    color: var(--text-primary) !important;
  }

  .search-btn{
    padding: 0.5em 1em;
  }

  .search-btn:hover{
    background-color: var(--secondary-color);
  }

  .nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 100%;
    height: 1px;
    background-color: var(--accent-color);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
  }
  .nav-link:hover{
    color: var(--text-secondary) !important;
  }

  .nav-link:hover::after {
    transform: scaleX(1);
  }

  .navbar-brand{
    blur: 1px;
  }

  .SearchResults{
    transition: display 0.3s ease;
  }
  
  .spotlight{
    position: absolute;
    height: 150px;
    width: 200px;
    top: -40px;
    clip-path: polygon(55% 0%, 35% 0%, 18.5% 90%, 66.50% 90%);
    background: linear-gradient(
      180deg,
      var(--text-primary) 0%,
      rgba(255, 255, 255, 0) 75%,
      rgba(255, 255, 255, 0) 100%
    );
    animation: flicker 6s infinite alternate;
    transition: all 0.5s ease;
  }

  @keyframes flicker{
    0%{
      opacity: 0;
    }18%{
      opacity: 0.4;
    }22%{
      opacity: 0;
    }25%{
      opacity: 0.1;
    }53%{
      opacity: 0;
    }57%{
      opacity: 0.45;
    }100%{
      opacity: 0.2;
    }
  }
</style>