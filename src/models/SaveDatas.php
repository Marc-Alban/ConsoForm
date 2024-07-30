<?php
declare(strict_types=1);

namespace Models;

use App\Model;
use PDO;
use PDOException;

class SaveDatas extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generateUuid(): string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    public function getLeadByUuid(string $uuid): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM savedatas WHERE uuid = :uuid");
        $stmt->execute(['uuid' => $uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function insert(string $uuid, string $formData): bool
    {
        $sql = "INSERT INTO savedatas (uuid, formData) VALUES (:uuid, :formData)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':uuid', $uuid);
        $stmt->bindValue(':formData', $formData);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function update(string $uuid, string $formData): bool
    {
        $sql = "UPDATE savedatas SET formData = :formData WHERE uuid = :uuid";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':uuid', $uuid);
        $stmt->bindValue(':formData', $formData);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
