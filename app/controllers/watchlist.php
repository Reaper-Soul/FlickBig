<?php

class Watchlist extends Controller{

  public function index(){

    if (!isset($_SESSION['username'])){
        $this->view('login/index');
        die;
    }
      
    $movie = $this->model('Movie');  
    $watchlist = $movie->getWatchlist();
    
    $this->view('watchlist/index', ['watchlist' => $watchlist]); 
    die;
  }

  public function add(){
    header('Content-Type: application/json');

    $response = ['success' => false, 'message' => 'Invalid request'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
        isset($_SERVER['CONTENT_TYPE']) && 
        strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {

        $json = json_decode(file_get_contents('php://input'), true);

        if (isset($json['imdbId'], $json['rating'], $json['title'], $json['poster'], $json['year'])) {
            $movie_id = $json['imdbId'];
            $rating = (float)$json['rating'];
            $title = $json['title'];
            $poster = $json['poster'];
            $year = $json['year'];
          
          
            $movie = $this->model('Movie');
            $movie->addToWatchlist($movie_id, $rating, $title, $poster, $year);

            $response = ['success' => true];
        } else {
            $response['message'] = 'Missing details';
        }
    }

    echo json_encode($response);
    die;
  }

  public function exists(){
    header('Content-Type: application/json');

    $response = ['exists' => false];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_SERVER['CONTENT_TYPE']) &&
        strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false)  {
        $json = json_decode(file_get_contents('php://input'), true);

        if (isset($json['imdbId'])){
            $movie_id = $json['imdbId'];
            $movie = $this->model('Movie');
            $response['exists'] = $movie->existsInWatchlist($movie_id);
        }
      }
      echo json_encode($response);
      die;
  }

}