<?php

class Create extends Controller {

    public function index() {		
	    $this->view('create/index');
    }

    public function verify(){
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];
      $confirm_password = $_REQUEST['confirm-password'];

      $user = $this->model('User');
      $user->create($username, $password, $confirm_password);
    }
}
