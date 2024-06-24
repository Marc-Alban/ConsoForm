<?php
declare(strict_types=1);

namespace App;

abstract class Controller
{
    protected function renderFormView(string $viewName, array $data = [])
    {
        $this->render($viewName, $data, 'form');
    }

    public function render(string $fichier, array $datas = [], string $customFolder = null) {
        extract($datas);

        ob_start();

        $folder = $customFolder ?? strtolower(get_class($this));

        require_once(ROOT . 'views/' . $folder . '/' . $fichier . '.php');

        $content = ob_get_clean();

        $encoding = mb_detect_encoding($content);
        if ($encoding != 'UTF-8') {
            $content = mb_convert_encoding($content, 'UTF-8', $encoding);
        }

        require_once(ROOT . 'views/layout/default.php');
    }

    public function loadModel(string $model)
    {
        $className = "Models\\$model";
        return new $className();
    }
}
