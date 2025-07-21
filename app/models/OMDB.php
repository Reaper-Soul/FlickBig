<?php

  class OMDB{

     private $baseUrl = 'https://www.omdbapi.com/';
     private $apiKey = OMDB_API_KEY_3;
    
    public function __construct() {

    }

    public function getMovies($data, $check_upcoming = false, $_limit = 7){
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

                        $details = $this->getMovieDetails($imdbID);
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

    public function getMovieDetails($imdbID){
      $resp = file_get_contents($this->baseUrl . "?apikey=" . htmlspecialchars($this->apiKey) . "&i=" . urlencode($imdbID));

      if ($resp !== false){
        $data =  json_decode($resp, true);
        if (isset($data['Title'])){
          $poster_url = "https://img.omdbapi.com/?i=". urlencode($imdbID) . "&apikey=" . OMDB_API_KEY_2;

          $data['Poster'] = $poster_url;
          return $data;
        }
      }
      return null;
    }
    
  }