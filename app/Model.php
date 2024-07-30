<?php
declare(strict_types=1);

namespace App;

abstract class Model
{
    protected $pdo;

    public function __construct()
    {
        $this->initializeDatabaseConnection();
    }

    private function initializeDatabaseConnection(): void
    {
        $config = require(__DIR__ . '/../config/database.php');
       // var_dump($config); // Debug: Affiche la configuration chargée
        $environment = $this->getEnvironment();
      //  var_dump($environment); // Debug: Affiche l'environnement actuel

        if (!isset($config[$environment])) {
            throw new \Exception("Configuration for environment '{$environment}' not found.");
        }

        $this->connect($config[$environment]);
    }

    private function getEnvironment(): string
    {
        $url = $_SERVER['HTTP_HOST'];
        if ($url === 'devapp.solutis.fr') {
            return 'dev';
        } elseif ($url === 'app.solutis.fr') {
            return 'prod';
        } else {
            return 'local';
        }
    }

    private function connect(array $dbConfig): void
    {
        if (empty($dbConfig['host']) || empty($dbConfig['dbname']) || empty($dbConfig['username'])) {
            throw new \Exception("Database configuration is missing required fields.");
        }

        // Debug output to check the values
        // var_dump($dbConfig);

        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset=utf8";
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new \PDO($dsn, $dbConfig['username'], $dbConfig['password'], $options);
        } catch (\PDOException $exception) {
            error_log($exception->getMessage());
            throw new \Exception("Database connection error: " . $exception->getMessage());
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
