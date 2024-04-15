<?php

namespace app\core\db;

use app\core\Application;
use app\core\middlewares;

class Database
{

    public \PDO $pdo;
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations(): void
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR.'/migrations/');

        $appliedMigrations = array_diff($files, $appliedMigrations);

        foreach ($appliedMigrations as $migration){
            if($migration === '.' || $migration === '..'){
                continue;
            }
            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration".PHP_EOL);
            $instance->up();
            $this->log("Applied migration $migration".PHP_EOL);
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }

    public function createMigrationsTable(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migration(
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    private function getAppliedMigrations(): false|array
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migration");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    private function saveMigrations(array $newMigrations): void
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $newMigrations));
        $statement = $this->pdo->prepare("INSERT INTO migration (migration) VALUES 
        $str
        ");
        $statement->execute();
    }

    protected function log($message): void
    {
        echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;
    }

    public function prepare($sql): false|\PDOStatement
    {
        return $this->pdo->prepare($sql);
    }

}