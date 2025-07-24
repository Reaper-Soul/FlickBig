<?php

class Gemini{

    private $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";

    private $headers = [
        "Content-Type: application/json",
        "X-goog-api-key: " .GEMINI_API_KEY,
    ];

  public function generateTrendingMovies(){

    // $data = [
    //     "contents" => [[
    //         "parts" => [[
    //             "text" => "Note: Remember just list the titles without saying anything else in the response. There should not be any spaces at the start of the movie title. No formatting, no indexing or anything else. It should be real movies not made up names.Give me a list of 10 currently trending movies with their exact official titles."
    //         ]]
    //     ]]
    // ];

    // $ch = curl_init($this->url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

    // $resp = curl_exec($ch);
    // curl_close($ch);

    // if (!$resp){
    //   return null;
    // }

    // $json = json_decode($resp, true);

    // if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
    //     $text = $json['candidates'][0]['content']['parts'][0]['text'];
    //     $result = array_filter(array_map('trim', explode("\n", $text)));
    //     return $result;
    // }

    // return null;
      return [
        "Oppenheimer",
        "Pulp Fiction",
        "The Godfather",
        "Killers of the Flower Moon",
        "Loki",
        "Lord of the Rings",
        "The Conjuring",
      ];
  }

    public function generateUpcomingMovies(){
        // $data = [
        //     "contents" => [[
        //         "parts" => [[
        //             "text" => "Note: Remember just list the titles without saying anything else in the response. There should not be any spaces at the start of the movie title. No formatting, no indexing or anything else. It should be real movies not made up names. Make sure that none of these movies are released as of the year 2025 which means these movies should be of year 2026 or after. Give me a list of 10 upcoming movies which means the ones which are not yet released in the theatres, along with their exact official titles."
        //         ]]
        //     ]]
        // ];

        // $ch = curl_init($this->url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        // $resp = curl_exec($ch);
        // curl_close($ch);

        // if (!$resp){
        //   return null;
        // }

        // $json = json_decode($resp, true);

        // if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
        //     $text = $json['candidates'][0]['content']['parts'][0]['text'];
        //     $result = array_filter(array_map('trim', explode("\n", $text)));
        //     return $result;
        // }

        // return null;
        return [
          "Tron: Ares",
          "Toy Story 5",
          "The Batman Part II",
          "Avatar: Fire and Ash",
          "Now You See Me: Now You Don't"
        ];
    }

    public function generateReview($movieTitle){
        $data = [
            "contents" => [[
                "parts" => [[
                    "text" => "Note: The review should be in a single line and there should not be any additional formatting. Also, make sure that you reply with something like \" I am excited for the movie release. \" if the movie has not released yet. Give me a review for the movie" . htmlspecialchars($movieTitle) . "Make it feel like a real human write it. You are free to use slangs, emojis and anything else that's trendy to express your emotions. Make sure that the review is not more than 50 words. Also, you are free to critize the movie, just don't use any rude or offensive language."
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
