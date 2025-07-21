<?php

class Gemini{

    private $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";

    private $headers = [
        "Content-Type: application/json",
        "X-goog-api-key: " .GEMINI_API_KEY_2,
    ];

  public function generateTrendingMovies(){

    $data = [
        "contents" => [[
            "parts" => [[
                "text" => "Note: Remember just list the titles without saying anything else in the response. There should not be any spaces at the start of the movie title. No formatting, no indexing or anything else. It should be real movies not made up names.Give me a list of 10 currently trending movies with their exact official titles."
            ]]
        ]]
    ];

    $ch = curl_init($this->url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

    $resp = curl_exec($ch);
    curl_close($ch);

    if (!$resp){
      return null;
    }

    $json = json_decode($resp, true);

    if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
        $text = $json['candidates'][0]['content']['parts'][0]['text'];
        $result = array_filter(array_map('trim', explode("\n", $text)));
        return $result;
    }

    return null;
  }

    public function generateUpcomingMovies(){
        $data = [
            "contents" => [[
                "parts" => [[
                    "text" => "Note: Remember just list the titles without saying anything else in the response. There should not be any spaces at the start of the movie title. No formatting, no indexing or anything else. It should be real movies not made up names. Make sure that none of these movies are released as of the year 2025 which means these movies should be of year 2026 or after. Give me a list of 10 upcoming movies which means the ones which are not yet released in the theatres, along with their exact official titles."
                ]]
            ]]
        ];

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $resp = curl_exec($ch);
        curl_close($ch);

        if (!$resp){
          return null;
        }

        $json = json_decode($resp, true);

        if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
            $text = $json['candidates'][0]['content']['parts'][0]['text'];
            $result = array_filter(array_map('trim', explode("\n", $text)));
            return $result;
        }

        return null;  
    }
  
}
