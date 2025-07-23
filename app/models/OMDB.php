<?php

  class OMDB{

     private $baseUrl = 'https://www.omdbapi.com/';
     private $apiKey = OMDB_API_KEY;
    
    public function __construct() {

    }

    public function getMovies($data, $check_upcoming = false, $_limit = 7, $movie_model = null, $gemini_model = null){
        $results = [];
        $keywords = $data ?? [];
        $addedIDs = [];
        $addedTitles = [];

        $limit = $_limit;

        foreach ($keywords as $keyword){
            if (count($results) >= $limit){
                break;
            }

            $resp = file_get_contents($this->baseUrl . "?apikey=" . htmlspecialchars($this->apiKey) . "&s=" . urlencode($keyword));

            if ($resp !== false){
                $data = json_decode($resp, true);
                if (isset($data['Search'])){
                    foreach ($data['Search'] as $movie){
                        if (count($results) >= $limit){
                            break;
                        }

                        $imdbID = $movie['imdbID'];
                        $title = $movie['Title'];

                        if (in_array($imdbID, $addedIDs)){
                            continue;
                        }

                        $titleWords = preg_split('/\s+/', strtolower($title));
                        $normalizedWords = array_map(function($word) {
                            return preg_replace('/[^\p{L}\p{N}]/u', '', $word);
                        }, $titleWords);

                        $matches = false;
                        foreach ($normalizedWords as $word) {
                            if (in_array($word, $addedTitles)) {
                                $matches = true;
                                break;
                            }
                        }
                        if ($matches) {
                            continue;
                        }

                        $details = $this->getMovieDetails($imdbID, $movie_model);
                        if ($details){
                            if ($check_upcoming && isset($details['Released'])){
                                $release = DateTime::createFromFormat('d M Y', $details['Released']);
                                $now = new DateTime();
                                if ($release === false || $release < $now){
                                    continue;
                                }
                            }

                            $results[] = $details;
                            $addedIDs[] = $imdbID;

                            $filter_words = ['the', 'a', 'an', 'and', 'of', 'in', 'on', 'at', 'to', 'with', 'for', 'by', 'from', 'up', 'down', 'out', 'off', 'over'];

                            foreach ($normalizedWords as $word) {
                                if (!in_array($word, $addedTitles) && !in_array($word, $filter_words)) {
                                    $addedTitles[] = $word;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $results;
    }

    private function getMovieDetails($imdbID, $movie_model){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
      $resp = file_get_contents($this->baseUrl . "?apikey=" . htmlspecialchars($this->apiKey) . "&i=" . urlencode($imdbID));

      if ($resp !== false){
        $data =  json_decode($resp, true);

        if (isset($data['Title'])){

                $flickScore = $movie_model->getScore($imdbID);
                $data['flickScore'] = $flickScore;

                if (isset($_SESSION['username'])){
                    $user_rating = $movie_model->getRating($imdbID, $_SESSION['username']);
                    if ($user_rating !== null){
                        $data['viewerRating'] = $user_rating;
                    }
                }
        
          return $data;
        }
      }
      return null;
    }
    
  }