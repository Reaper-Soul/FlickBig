<?php

class Movies extends Controller{
  
    public function index(){
      
    }

  public function addRating() {
      header('Content-Type: application/json; charset=utf-8');

      $response = ['success' => false, 'message' => 'Invalid request'];

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
          isset($_SERVER['CONTENT_TYPE']) && 
          strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {

          $json = json_decode(file_get_contents('php://input'), true);

          if (isset($json['imdbId'], $json['rating'])) {
              $movie_id = $json['imdbId'];
              $rating = (int)$json['rating'];
              $movie = $this->model('Movie');
              $movie->putRating($movie_id, $rating);

              $response = ['success' => true];
          } else {
              $response['message'] = 'Missing imdbId or rating';
          }
      }

      echo json_encode($response);
      die;
  }

    public function getReview(){
        header('Content-Type: application/json; charset=utf-8');

          $response = ['success' => false, 'message' => 'Invalid request'];
          if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
              isset($_SERVER['CONTENT_TYPE']) &&
              strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false){
              $json = json_decode(file_get_contents('php://input'), true);
              if (isset($json['title'])){
                  $movie_title = $json['title'];
                  $ai = $this->model('Gemini');
                  $review = $ai->generateReview($movie_title);
                  $response = ['success' => true, 'review' => $review];
              } else {
                  $response['message'] = 'Missing movie title';
              }

              echo json_encode($response);
              die;
          }
    }
  
}