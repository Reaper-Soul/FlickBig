<?php

class App {

    protected $controller = 'home';
    protected $method = 'index';
    protected $special_url = ['apply'];
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Load controller if exists
        if (isset($url[1]) && file_exists('app/controllers/' . $url[1] . '.php')) {
            $this->controller = $url[1];
            $_SESSION['controller'] = $this->controller;
            $_SESSION['current_page'] = $this->controller;

            if (in_array($this->controller, $this->special_url)) {
                $this->method = 'index';
            }

            unset($url[1]);
        } elseif (!file_exists('app/controllers/' . $this->controller . '.php')) {
            // If nothing matches, redirect to /home
            if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                header('Location: /home');
                exit;
            } else {
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode(['error' => 'Controller not found']);
                exit;
            }
        }

        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Load method if exists
        if (isset($url[2]) && method_exists($this->controller, $url[2])) {
            $this->method = $url[2];
            $_SESSION['method'] = $this->method;
            unset($url[2]);
        }

        $this->params = $url ? array_values($url) : [];

        try {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } catch (Throwable $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }

    public function parseUrl() {
        $u = $_SERVER['REQUEST_URI'];
        $url = explode('/', filter_var(rtrim($u, '/'), FILTER_SANITIZE_URL));
        unset($url[0]);
        return $url;
    }

}