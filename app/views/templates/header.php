<?php
$current_page = $_SESSION['current_page'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="app/public/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="/favicon.png">
    <title>flickBIG</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark px-5" style="background-color: var(--secondary-color) !important;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/home"><img src="app/public/pics/logo.svg" alt="Logo" width="70" height="55" style="margin: auto 0; padding: 2px;"/></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="me-auto">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'home') ? 'active' : '' ?>" aria-current="page" href="/home">Home</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</body>

<style>
  .nav-link{
    color: var(--text-primary) !important;
    font-weight: 600;
  }
  .navbar-brand::before{
    
  }
</style>