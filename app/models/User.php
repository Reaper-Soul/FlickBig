<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        
    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function authenticate($username, $password) {
  		$username = strtolower($username);
  		$db = db_connect();
      
      if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] >= 3) {
        $stmt = $db->prepare("SELECT time FROM attempts WHERE username = :username AND attempt = 'BAD' ORDER BY time DESC LIMIT 1");
        $stmt->execute(['username' => $username]);
        $last_attempt_time = $stmt->fetch(PDO::FETCH_ASSOC);
  
        if ($last_attempt_time){
          $last_attempt_time = strtotime($last_attempt_time['time']);
          $time_diff = time() - $last_attempt_time;
          if ($time_diff < 60) {
            header('Location: /login');
            die;
          } else{
            unset($_SESSION['failedAuth']);
          }
        }
      }
      
      $statement = $db->prepare("select * from users WHERE username = :name;");
      $statement->bindValue(':name', $username);
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);

      $attempt_type = 'BAD';
		
		if (password_verify($password, $rows['pass'])) {
			$_SESSION['auth'] = 1;
			$_SESSION['username'] = ucwords($username);
      $_SESSION['alert'] = [
          'type' => 'success',
          'message' => 'You have successfully Logged-in!'
      ];
			unset($_SESSION['failedAuth']);
      $attempt_type = 'GOOD';
		} else {
      $_SESSION['alert'] = [
          'type' => 'danger',
          'message' => 'Incorrect Credentials!'
      ];
			if(isset($_SESSION['failedAuth'])) {
				  $_SESSION['failedAuth'] ++;
        } else{
          $_SESSION['failedAuth'] = 1;
        }
		}
      $query = $db->prepare("INSERT INTO attempts (username, attempt, time) VALUES (:username, :attempt, NOW());");
      $query->execute([
                      'username' => $username,
                      'attempt' => $attempt_type
                      ]);
      if ($attempt_type == 'GOOD'){
        header('Location: /home');
        die;
      }else{
        header('Location: /login');
        die;
      }
  }

  public function create($username, $password, $confirm_password){
      $db = db_connect();
      if ($password != $confirm_password) {
        $_SESSION['alert'] = [
            'type' => 'warning',
            'message' => 'The Passwords doesn\'t match!'
        ];
        header('Location: /create');
        die;
      }
    if (strlen($password) < 10 || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[A-Z]/', $password)) {
        $_SESSION['alert'] = [
            'type' => 'warning',
            'message' => 'Use a more secure password!'
        ];
        header('Location: /create');
        die;
    }
    $query = $db->prepare("SELECT * FROM users WHERE username = :username;");
      $query->execute(['username' => $username]);
      if ($query->rowCount() > 0){
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'This username already exists!'
        ];
        header('Location: /create');
        die; 
      }else{
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = $db->prepare("INSERT INTO users (username, pass) VALUES (:username, :password);");
        $query->execute(['username' => $username, 'password' => $hashed_password]);
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Account created successfully!'
        ];
        header('Location: /login');
        die;
      }
  }

}
