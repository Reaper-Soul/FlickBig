<?php

class Home extends Controller {

    public function index() {
      $user = $this->model('User');
      $omdb = $this->model('OMDB');
      $ai = $this->model('Gemini');
      
      $data_viral = $ai->generateTrendingMovies();
      $data_upcoming = $ai->generateUpcomingMovies();

      while ($data_viral == null || $data_upcoming == null){
        $data_viral = $ai->generateTrendingMovies();
        $data_upcoming = $ai->generateUpcomingMovies();
      }
      
      $viral_movies = $omdb->getMovies($data_viral);
      $upcoming_movies = $omdb->getMovies($data_upcoming, true);
      
	    $this->view('home/index', [
                  'viral_movies' => $viral_movies,
                  'upcoming_movies' => $upcoming_movies
        ]);
        die;
    }

  public function search() {
      header('Content-Type: application/json; charset=utf-8');

      $response = ['results' => []];
      $query = null;

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false){
          $json = json_decode(file_get_contents('php://input'), true);

          if (isset($json['query'])){
              $query = $json['query'];
          }
      } elseif (isset($_GET['q'])) {
          $query = $_GET['q'];
      }
          $omdb = $this->model('OMDB');
          $search_results = $omdb->getMovies([$query], false, 3);
          if ($search_results) {
              $response['results'] = $search_results;
          }
          die(json_encode($response));
      }
  }