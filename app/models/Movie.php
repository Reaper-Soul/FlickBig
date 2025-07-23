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
    
  }