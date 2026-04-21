<?php
namespace App\Core;

class Controller {
    public function view($viewPath, $data = [], $layout = 'main') {
        extract($data);
        $viewFile = __DIR__ . '/../../views/' . $viewPath . '.php';

        if (!file_exists($viewFile)) {
            die("View not Foind: " . $viewPath);
        }

        ob_start();

        require_once $viewFile;

        $content = ob_get_clean();

        $layoutFile = __DIR__ . '/../../views/layouts/' . $layout . '.php';

        if (file_exists($layoutFile)) {
            require_once $layoutFile;
        } else {
            echo $content;
        }
    }
}