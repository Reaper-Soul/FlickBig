<?php

class Home extends Controller {

    public function index() {
      $user = $this->model('User');
      $omdb = $this->model('OMDB');
      $ai = $this->model('Gemini');
      
      $data_viral = $ai->generateTrendingMovies();
      $data_upcoming = $ai->generateUpcomingMovies();
      echo "<script>console.log(" . json_encode($data_viral) . ");</script>";
      echo "\n<script>console.log(" . json_encode($data_upcoming) . ");</script>";
      
      $viral_movies = $omdb->getMovies($data_viral);
      $upcoming_movies = $omdb->getMovies($data_upcoming);
      
	    $this->view('home/index', [
                  'viral_movies' => $viral_movies,
                  'upcoming_movies' => $upcoming_movies
      ]);
	    die;
    }

}
