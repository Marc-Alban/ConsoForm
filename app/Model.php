<?php
declare(strict_types=1);

namespace App;

abstract class Model
{
    private $host;
    private $db_name;
    private $username;
    private $password;

    protected $pdo;

    public function __construct()
    {
        $this->setConnectionParams();
        $this->getConnection();
    }

    private function setConnectionParams(): void
    {
        $url = $_SERVER['HTTP_HOST'];
        
        if ($url === 'devapp.solutis.fr') {
            $this->host = $_ENV['DB_DEV_HOST'];
            $this->db_name = $_ENV['DB_DEV_NAME'];
            $this->username = $_ENV['DB_DEV_USER'];
            $this->password = $_ENV['DB_DEV_PASS'];
        } elseif ($url === 'app.solutis.fr') {
            $this->host = $_ENV['DB_PROD_HOST'];
            $this->db_name = $_ENV['DB_PROD_NAME'];
            $this->username = $_ENV['DB_PROD_USER'];
            $this->password = $_ENV['DB_PROD_PASS'];
        } else {
            $this->host = $_ENV['DB_LOCAL_HOST'];
            $this->db_name = $_ENV['DB_LOCAL_NAME'];
            $this->username = $_ENV['DB_LOCAL_USER'];
            $this->password = $_ENV['DB_LOCAL_PASS'];
        }
    }

    private function getConnection(): void
    {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8";
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ];
            $this->pdo = new \PDO($dsn, $this->username, $this->password, $options);
        } catch (\PDOException $exception) {
            error_log($exception->getMessage());
            echo "Une erreur est survenue lors de la connexion à la base de données. Veuillez réessayer plus tard.";
            exit;
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
