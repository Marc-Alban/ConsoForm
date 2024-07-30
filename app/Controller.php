<?php
declare(strict_types=1);

namespace App;

abstract class Controller
{
    protected function initializeSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            $sessionConfig = require_once(__DIR__ . '/../config/session.php');
            session_start($sessionConfig);
            session_regenerate_id(true);
        }
    }

    protected function renderFormView(string $viewName, array $data = [])
    {
        $this->render($viewName, $data, 'form');
    }

    public function render(string $fichier, array $datas = [], string $customFolder = null) {
        extract($datas);

        ob_start();

        $folder = $customFolder ?? strtolower(get_class($this));
        $viewPath = ROOT . 'src/views/' . $folder . '/' . $fichier . '.php';

        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: " . $viewPath);
        }

        require_once($viewPath);

        $content = ob_get_clean();

        $encoding = mb_detect_encoding($content);
        if ($encoding != 'UTF-8') {
            $content = mb_convert_encoding($content, 'UTF-8', $encoding);
        }

        require_once(ROOT . 'src/views/layout/default.php');
    }

    public function loadModel(string $model)
    {
        $className = "Models\\$model";
        return new $className();
    }
}
