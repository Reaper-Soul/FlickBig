<?php

  class Movie{

    public function __construct() {

    }

    public function getRating($imdbId){
      $db = db_connect();
      $stmt = $db->prepare("SELECT rating FROM movie_ratings WHERE movie_id = :imdbId AND user = :user");
      $stmt->execute([
                     ':imdbId' => $imdbId,
                     ':user' => $_SESSION['username']
      ]);
      $rating = $stmt->fetch(PDO::FETCH_ASSOC);
      return $rating['rating'] ?? null;
    }

    public function putRating($imdbId, $rating){
      $db = db_connect();
      $stmt = $db->prepare("INSERT INTO movie_ratings (user, rating, movie_id) VALUES (:user, :rating, :imdbId) ON DUPLICATE KEY UPDATE rating = :rating");
      $stmt->execute([
                     ':imdbId' => $imdbId,
                     ':user' => $_SESSION['username'],
                     ':rating' => $rating
      ]);
    }

    public function getScore($imdbId){
      $db = db_connect();
      $stmt = $db->prepare("SELECT AVG(rating) AS avg_rating FROM movie_ratings WHERE movie_id = :imdbId");
      $stmt->execute([
                     ':imdbId' => $imdbId
      ]);
      $score = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($score['avg_rating'] == null){
        return 0;
      }
      return (int) round($score['avg_rating']);
    }

    public function addToWatchlist($imdbId, $rating, $title, $poster, $year){
      $db = db_connect();
      $stmt = $db->prepare("INSERT INTO watchlist (movie_id, user, movie_name, year, imdbRating, poster) VALUES (:imdbId, :user, :title, :year, :rating, :poster)");
      $stmt->execute([
                     ':imdbId' => $imdbId,
                     ':user' => $_SESSION['username'],
                     ':title' => $title,
                     ':rating' => $rating,
                     ':poster' => $poster,
                     ':year' => $year
      ]);
    }

    public function getWatchlist(){
      $db = db_connect();
      $stmt = $db->prepare("SELECT * FROM watchlist WHERE user = :user");
      $stmt->execute([
                     ':user' => $_SESSION['username']
      ]);
      $watchlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $modified = array_map(function($item) {
          return [
              'imdbId' => $item['movie_id'],
              'Title'  => $item['movie_name'],
              'Poster' => $item['poster'],
              'Year'   => $item['year'],
              'imdbRating' => $item['imdbRating'],
          ];
      }, $watchlist);

      return $modified;
    }

    public function existsInWatchlist($imdbId){
        $db = db_connect();
        $stmt = $db->prepare("SELECT COUNT(*) as count FROM watchlist WHERE movie_id = :imdbId AND user = :user");
        $stmt->execute([
            ':imdbId' => $imdbId,
            ':user' => $_SESSION['username']
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
    
  }