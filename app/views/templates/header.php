<?php
$current_page = $_SESSION['current_page'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="app/public/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="app/public/pics/logo.svg" type="image/svg+xml">
    <title>flickBIG - <?= ucwords(htmlspecialchars($current_page ?? 'Home')) ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark px-5" style="background-color: var(--backgriund-color) !important; border-bottom: 0.1em solid var(--text-disabled) !important;">
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
          <a class="nav-link <?= ($current_page == 'home') ? 'active' : '' ?>" aria-current="page" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'movies') ? 'active' : '' ?>" aria-current="page" href="/movies">Movies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'watchlist') ? 'active' : '' ?>" aria-current="page" href="/watchlist">Watchlist</a>
        </li>
      </ul>

      <div class="d-flex flex-row align-items-center gap-3">
        <div class="d-flex flex-row align-items-center">
          <div class="input-wrapper d-flex flex-row align-tems-center">
          <input type="text" class="form-control bg-transparent" placeholder="Search..." aria-label="Search" style="border: none; outline: none; box-shadow: none; color: var(--text-secondary);">
          <button class="btn" style="border: none; outline: none; box-shadow: none; cursor: pointer;">
            <i class="search bi bi-search fw-bold" style="color: var(--text-primary);"></i>
          </button>
        </div>
        </div>
        <button class="btn search-btn fw-semibold d-flex flex-row gap-2 align-items-center" style="border: none; outline: none; box-shadow: none; cursor: pointer; color: var(--text-primary);">
          <i class="bi bi-person-circle fs-5"></i>
          <span class="fs-6">Login</span>
        </button> 
      </div>
    </div>
  </div>
</nav>
</body>

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