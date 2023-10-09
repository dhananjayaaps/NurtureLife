<?php

use app\core\Application;

class m0001_initial
{
    public function up()
    {
        $db = Application::$app->db;

        $SQL = "CREATE TABLE roles (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
        ) ENGINE=INNODB;";

        $db->pdo->exec($SQL);

        $SQL = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            nic VARCHAR(15) NOT NULL,
            status TINYINT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            password VARCHAR(512) NOT NULL,
            role_id INT,
            FOREIGN KEY (role_id) REFERENCES roles(id)
        ) ENGINE=INNODB;";

        $db->pdo->exec($SQL);

        $SQL = "INSERT INTO roles (id, name) VALUES (1, 'ROLE_USER');
                INSERT INTO roles (id, name) VALUES (2, 'ROLE_ADMIN');
                INSERT INTO roles (id, name) VALUES (3, 'ROLE_DOCTOR');
                INSERT INTO roles (id, name) VALUES (4, 'ROLE_PRE_MOTHER');
                INSERT INTO roles (id, name) VALUES (5, 'ROLE_POST_MOTHER');
                INSERT INTO roles (id, name) VALUES (6, 'ROLE_MIDWIFE');
            ";
        $db->pdo->exec($SQL);

    }

    public function down()
    {
        $db = Application::$app->db;

        $SQL = "DROP TABLE users;";

        $db->pdo->exec($SQL);
    }
}