<?php

namespace app\migrations;
class m002_add_roles
{
    public function up(): void
    {
        $db = \app\core\Application::$app->db;
        $SQL = "INSERT INTO roles (id, name) VALUES (1, 'ROLE_USER');
                INSERT INTO roles (id, name) VALUES (2, 'ROLE_ADMIN');
                INSERT INTO roles (id, name) VALUES (3, 'ROLE_DOCTOR');
                INSERT INTO roles (id, name) VALUES (4, 'ROLE_PRE_MOTHER');
                INSERT INTO roles (id, name) VALUES (5, 'ROLE_POST_MOTHER');
                INSERT INTO roles (id, name) VALUES (6, 'ROLE_MIDWIFE');
            ";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \app\core\Application::$app->db;
        $SQL = "ALTER TABLE users DROP COLUMN password";
        $db->pdo->exec($SQL);
    }
}