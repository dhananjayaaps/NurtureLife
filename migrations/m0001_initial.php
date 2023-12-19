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


        $SQL3 = "INSERT INTO roles (id, name) VALUES (1, 'ROLE_USER');
                INSERT INTO roles (id, name) VALUES (2, 'ROLE_ADMIN');
                INSERT INTO roles (id, name) VALUES (3, 'ROLE_DOCTOR');
                INSERT INTO roles (id, name) VALUES (4, 'ROLE_PRE_MOTHER');
                INSERT INTO roles (id, name) VALUES (5, 'ROLE_POST_MOTHER');
                INSERT INTO roles (id, name) VALUES (6, 'ROLE_MIDWIFE');
            ";
        $db->pdo->exec($SQL3);

        $SQL4 = "CREATE TABLE your_table_name (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    district VARCHAR(255),
                    address VARCHAR(255),
                    gn_units INT);
                ";
        $db->pdo->exec($SQL4);

        $SQL5 = "CREATE TABLE user_roles (
                    user_id INT,
                    role_id INT,
                    PRIMARY KEY (user_id, role_id),
                    FOREIGN KEY (user_id) REFERENCES users(id),
                    FOREIGN KEY (role_id) REFERENCES roles(id));
                    ";

        $db->pdo->exec($SQL5);


        $SQL6 = "CREATE TABLE clinics (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            district VARCHAR(255) NOT NULL,
            address VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";

        $db->pdo->exec($SQL6);

        $SQL7 = "CREATE TABLE doctors (
                MOH_id INT NOT NULL AUTO_INCREMENT,
                user_id INT,
                SLMC_no VARCHAR(255) NOT NULL,
                clinic_id INT,
                PRIMARY KEY (MOH_id),
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (clinic_id) REFERENCES clinics(id)
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL7);

        $SQL8 = "CREATE TABLE midwife (
                PHM_id INT NOT NULL AUTO_INCREMENT,
                user_id INT,
                SLMC_no VARCHAR(255) NOT NULL,
                clinic_id INT,
                PRIMARY KEY (PHM_id),
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (clinic_id) REFERENCES clinics(id)
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL8);

        $SQL9 = "CREATE TABLE Mothers (
            MotherId INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            PHM_ID INT,
            clinic_id INT,
            MartialStatus VARCHAR(255),
            MarriageDate DATE,
            BloodGroup VARCHAR(10),
            Occupation VARCHAR(255),
            Allergies TEXT,
            Consanguinity VARCHAR(255),
            history_subfertility TEXT,
            Hypertension TINYINT(1),
            diabetes_mellitus TINYINT(1),
            rubella_immunization TINYINT(1),
            emergencyNumber VARCHAR(20),
            FOREIGN KEY (PHM_ID) REFERENCES midwife(PHM_id),
            FOREIGN KEY (clinic_id) REFERENCES clinics(id),
            FOREIGN KEY (user_id) REFERENCES users(id)
        ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL9);

        $SQL10 = "create table fetalkick (
            RecordId  int auto_increment
            primary key,
            MotherId  int                                  not null,
            Time      datetime default current_timestamp() not null,
            KickCount int(3)                               not null
        );"
            ;



        $db->pdo->exec($SQL10);

    }

    public function down()
    {
        $db = Application::$app->db;

        $SQL = "DROP TABLE users;";

        $db->pdo->exec($SQL);
    }
}