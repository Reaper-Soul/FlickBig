<?php

  class Movies extends Controller{

    public function index(){
      $this->view('movies/index'); 
      die;
    }
    
  }