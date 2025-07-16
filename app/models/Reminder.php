<?php

class Reminder {

    public function __construct() {

    }

    public function create($subject){
        $db = db_connect();
        $query = $db->prepare("INSERT INTO notes (user, subject, created_at, is_deleted, is_completed) VALUES (:user, :subject, NOW(), 0, 0);");
        $query->execute([
                        'subject' => $subject,
                        'user' => $_SESSION['username'],
                        ]);
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'New reminder added!'
        ];
        header('Location: /reminders');
    }

    public function getAll(){
        $db = db_connect();
        $query = $db->prepare("SELECT * FROM notes WHERE user = :user AND is_deleted = 0;");
        $query->execute(['user' => $_SESSION['username']]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($uid){
        $db = db_connect();
        $query = $db->prepare("UPDATE notes SET is_deleted = 1 WHERE id = :uid;");
        $query->execute(['uid' => $uid]);
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Reminder deleted!'
        ];
        header('Location: /reminders');
    }

    public function complete($uid, $value){
        $db = db_connect();
        $query = $db->prepare("UPDATE notes SET is_completed = :value WHERE id = :uid;");
        $query->execute(['uid' => $uid, 'value' => $value]);
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Reminder status updated!'
        ];
        header('Location: /reminders');
    }
}