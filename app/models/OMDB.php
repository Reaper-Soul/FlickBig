<?php

  class OMDB{

     private $baseUrl = 'https://www.omdbapi.com/';
    
    public function __construct() {

    }

    public function getMovies($data){
        $results = [];
        $keywords = $data ?? [];
        $addedIDs = [];
        $addedTitles = [];

        $limit = 7;

        foreach ($keywords as $keyword){
            if (count($results) >= $limit){
                break;
            }

            $resp = file_get_contents($this->baseUrl . "?apikey=" .OMDB_API_KEY . "&s=" . urlencode($keyword));

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
                            $results[] = $details;
                            $addedIDs[] = $imdbID;

                            foreach ($normalizedWords as $word) {
                                if (!in_array($word, $addedTitles)) {
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
      $resp = file_get_contents($this->baseUrl . "?apikey=" .OMDB_API_KEY . "&i=" . urlencode($imdbID));

      if ($resp !== false){
        $data =  json_decode($resp, true);
        if (isset($data['Title'])){
          $poster_url = "https://img.omdbapi.com/?i=". urlencode($imdbID) . "&apikey=" . OMDB_API_KEY;

          $data['Poster'] = $poster_url;
          return $data;
        }
      }
      return null;
    }
    
  }