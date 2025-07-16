<?php

  class Reminders extends Controller{

    public function index(){
      $_SESSION['current_page'] = 'reminders';
      $reminder = $this->model('Reminder');
      $reminder_list = $reminder->getAll();
      $this->view('reminders/index', ['reminder_list' => $reminder_list]);
      die;
    }

    public function create(){
      $subject = $_REQUEST['reminder-title'];
      $reminder = $this->model('Reminder');
      $reminder->create($subject);
    }

    public function delete(){
      $uid = $_REQUEST['id'];
      $reminder = $this->model('Reminder');
      $reminder->delete($uid);
    }

    public function complete(){
      $uid = $_REQUEST['id'];
      $value = isset($_REQUEST['completed']) ? 1 : 0;
      $reminder = $this->model('Reminder');
      $reminder->complete($uid, $value);
    }
  }