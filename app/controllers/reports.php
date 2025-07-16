<?php

class Reports extends Controller {

  public function index(){
    $_SESSION['current_page'] = 'reports';
    $this->view('reports/index');
    die;
  }

   public function reminders(){
      $_SESSION['current_page'] = 'reports';
      $reports = $this->model('Report');
      $activity = $reports->getRecentActivity(5);
      $user = $reports->getUserWithMostReminders();
      $count = $reports->getRemindersCount();
      $reminders = $reports->getAllReminders();
      $this->view('reports/reminders', ['activity' => $activity, 'user' => $user, 'count' => $count, 'reminders' => $reminders]);
      die;
    }

   public function user_info(){
      $_SESSION['current_page'] = 'reports';
      $reports = $this->model('Report');
      $count = $reports->getUserCount();
      $activity = $reports->getUserActivity(5);
      $user = $reports->getMostActiveUser();
      $attempts = $reports->getAllLoginAttempts();
      $this->view('reports/user-info', ['activity' => $activity, 'user' => $user, 'count' => $count, 'attempts' => $attempts]);
      die;
   }
}