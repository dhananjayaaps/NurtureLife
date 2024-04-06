<?php

use app\core\Application;

class m0001_initial
{
    public function up(): void
    {
        $db = Application::$app->db;

        $SQL1 = "CREATE TABLE roles (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
        ) ENGINE=INNODB;";

        $db->pdo->exec($SQL1);

        $SQL2 = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            nic VARCHAR(15) NOT NULL,
            status TINYINT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            password VARCHAR(512) NOT NULL,
            contact_no varchar(255),
            DOB date,
            gender varchar(255),
            role_id INT,
            home_number VARCHAR(255),
            lane VARCHAR(255),
            city VARCHAR(255),
            postal_code VARCHAR(255),
            FOREIGN KEY (role_id) REFERENCES roles(id)
        ) ENGINE=INNODB;";

        $db->pdo->exec($SQL2);


        $SQL3 = "INSERT INTO roles (id, name) VALUES (1, 'ROLE_USER');
                INSERT INTO roles (id, name) VALUES (2, 'ROLE_ADMIN');
                INSERT INTO roles (id, name) VALUES (3, 'ROLE_DOCTOR');
                INSERT INTO roles (id, name) VALUES (4, 'ROLE_PRE_MOTHER');
                INSERT INTO roles (id, name) VALUES (5, 'ROLE_POST_MOTHER');
                INSERT INTO roles (id, name) VALUES (6, 'ROLE_MIDWIFE');
            ";
        $db->pdo->exec($SQL3);

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
            MotherStatus varchar(255),
            MaritalStatus VARCHAR(255),
            MarriageDate DATE,
            BloodGroup VARCHAR(10),
            DeliveryDate DATE,
            Occupation VARCHAR(255),
            Allergies varchar(255),
            Consanguinity VARCHAR(255),
            history_subfertility varchar(255),
            Hypertension TINYINT(1),
            diabetes_mellitus TINYINT(1),
            rubella_immunization TINYINT(1),
            emergencyNumber VARCHAR(20),
            status INT,
            FOREIGN KEY (PHM_ID) REFERENCES midwife(PHM_id),
            FOREIGN KEY (clinic_id) REFERENCES clinics(id),
            FOREIGN KEY (user_id) REFERENCES users(id)
        ) ENGINE=INNODB;
        ";

        $db->pdo->exec($SQL9);

        $Trigger1 = "
            CREATE TRIGGER after_insert_user
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                INSERT INTO user_roles (user_id, role_id)
                VALUES (NEW.id, 1);
            END;
            ";

        $db->pdo->exec($Trigger1);

        $AppointmentsTable = "CREATE TABLE Appointments (
            AppointmentId INT PRIMARY KEY AUTO_INCREMENT,
            MotherId INT,
            AppointType INT,
            AppointDate DATE,
            AppointStatus VARCHAR(50),
            AppointRemarks TEXT,
            FOREIGN KEY (MotherId) REFERENCES Mothers(MotherId)
        ) ENGINE=INNODB;
        ";

        $db->pdo->exec($AppointmentsTable);

        $SQL10 = "CREATE TABLE IF NOT EXISTS child (
                    user_id INT AUTO_INCREMENT PRIMARY KEY,
                    PHM_ID VARCHAR(255),
                    Clinic_ID VARCHAR(255),
                    nic VARCHAR(255),
                    Child_Name VARCHAR(255),
                    Register_NO VARCHAR(255),
                    Birth_Date DATE,
                    Birth_Place VARCHAR(255),
                    Mother_Name VARCHAR(255),
                    Age VARCHAR(255),
                    Address VARCHAR(255),
                    Gender VARCHAR(255)
                );
            ";

        $db->pdo->exec($SQL10);

        $SQL10 = "create table fetalkick (
            RecordId  int auto_increment primary key,
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