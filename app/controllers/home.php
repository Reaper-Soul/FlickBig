<?php

class Home extends Controller {

    public function index() {
      $user = $this->model('User');
      $omdb = $this->model('OMDB');
      $ai = $this->model('Gemini');
      $movie = $this->model('Movie');  
      
      $data_viral = $ai->generateTrendingMovies();
      $data_upcoming = $ai->generateUpcomingMovies();
      
      $viral_movies = $omdb->getMovies(data: $data_viral, movie_model: $movie);
      $upcoming_movies = $omdb->getMovies(data: $data_upcoming, check_upcoming: true, movie_model: $movie);
      
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
          $movie = $this->model('Movie');  

          $search_results = $omdb->getMovies([$query], false, 3, $movie);
          if ($search_results) {
              $response['results'] = $search_results;
          }
          die(json_encode($response));
      }
  }