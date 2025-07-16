<?php

class Home extends Controller {

    public function index() {
      $user = $this->model('User');
      $data = $user->test();
       
      $_SESSION['current_page'] = 'home';
	    $this->view('home/index');
	    die;
    }

}
