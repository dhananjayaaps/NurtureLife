<?php

use app\core\Application;

class m0001_initial
{
    public function up(): void
    {
        $db = Application::$app->db;

        $SQL1 = "CREATE TABLE IF NOT EXISTS roles (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
        ) ENGINE=INNODB;";

        $db->pdo->exec($SQL1);

        $SQL2 = "CREATE TABLE IF NOT EXISTS users (
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


        $SQL3 = "INSERT IGNORE INTO roles (id, name) VALUES (1, 'ROLE_USER');
                INSERT IGNORE  INTO roles (id, name) VALUES (2, 'ROLE_ADMIN');
                INSERT IGNORE  INTO roles (id, name) VALUES (3, 'ROLE_DOCTOR');
                INSERT IGNORE  INTO roles (id, name) VALUES (4, 'ROLE_PRE_MOTHER');
                INSERT IGNORE  INTO roles (id, name) VALUES (5, 'ROLE_POST_MOTHER');
                INSERT IGNORE  INTO roles (id, name) VALUES (6, 'ROLE_MIDWIFE');
            ";
        $db->pdo->exec($SQL3);

        $SQL5 = "CREATE TABLE IF NOT EXISTS user_roles (
                    user_id INT,
                    role_id INT,
                    PRIMARY KEY (user_id, role_id),
                    FOREIGN KEY (user_id) REFERENCES users(id),
                    FOREIGN KEY (role_id) REFERENCES roles(id));
                    ";

        $db->pdo->exec($SQL5);


        $SQL6 = "CREATE TABLE IF NOT EXISTS clinics (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            district VARCHAR(255) NOT NULL,
            address VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";

        $db->pdo->exec($SQL6);

        $SQL7 = "CREATE TABLE IF NOT EXISTS doctors (
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

        $SQL8 = "CREATE TABLE IF NOT EXISTS midwife (
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

        $SQL9 = "CREATE TABLE IF NOT EXISTS Mothers (
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
            CREATE TRIGGER IF NOT EXISTS after_insert_user
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                INSERT INTO user_roles (user_id, role_id)
                VALUES (NEW.id, 1);
            END;
            ";

        $db->pdo->exec($Trigger1);

        $AppointmentsTable = "CREATE TABLE IF NOT EXISTS Appointments (
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

        $SQL10 = "create table IF NOT EXISTS fetalkick (
            RecordId  int auto_increment primary key,
            MotherId  int                                  not null,
            Time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ,
            KickCount int(3)                               not null
        );";

        $db->pdo->exec($SQL10);

        $SQL10 = "create table IF NOT EXISTS motherWeights (
            RecordId  int auto_increment primary key,
            MotherId  int                                  not null,
            Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP not null ,
            Weight int(3)                               not null
        );";

        $db->pdo->exec($SQL10);

        $SQL13 = "CREATE TABLE IF NOT EXISTS `nurturelife`.`MotherSymptoms` ( `symptomRecNo` INT NOT NULL AUTO_INCREMENT , 
        `MotherId` INT NOT NULL , `clinicId` INT NOT NULL , `symptomDescription` TEXT NOT NULL , 
        `priorityLvl` VARCHAR(8) NOT NULL , `recTime` DATETIME NOT NULL , `midwifeId` INT NOT NULL , 
        `midwifeCheck` VARCHAR(4) NOT NULL DEFAULT 'No' , `replyDocId` INT NOT NULL , `doctorReply` TEXT NULL , 
        `replyTime` DATETIME NULL , PRIMARY KEY (`symptomRecNo`)) ENGINE = InnoDB;";

        $db->pdo->exec($SQL13);


        $sql = "CREATE TABLE IF NOT EXISTS post (
                id INT NOT NULL AUTO_INCREMENT,
                user_id INT,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                status TINYINT(1) DEFAULT 1,
                PRIMARY KEY (id),
                FOREIGN KEY (user_id) REFERENCES users(id)
            ) ENGINE=INNODB;
            ";
        $db->pdo->exec($sql);

//        $sql = "ALTER TABLE post ADD topic TEXT AFTER user_id;";
//        $db->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS post_request (
                id INT NOT NULL AUTO_INCREMENT,
                post_id INT,
                provider_id INT,
                seeker_id INT,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                status TINYINT(1) DEFAULT 0,
                PRIMARY KEY (id),
                FOREIGN KEY (provider_id) REFERENCES users(id),
                FOREIGN KEY (seeker_id) REFERENCES users(id),
                FOREIGN KEY (post_id) REFERENCES post(id)
            ) ENGINE=INNODB;
            ";
        $db->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS feedback (
                id INT NOT NULL AUTO_INCREMENT,
                email VARCHAR(255),
                feedback TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=INNODB;
            ";
        $db->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS emailVerifications (
                id INT NOT NULL AUTO_INCREMENT,
                email VARCHAR(255),
                token VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS passwordResets (
                id INT NOT NULL AUTO_INCREMENT,
                email VARCHAR(255),
                token VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS admins (
                admin_id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT,
                FOREIGN KEY (user_id) REFERENCES users(id)
            ) ENGINE=INNODB;
            ";
        $db->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS roleRequest (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT,
                FOREIGN KEY (user_id) REFERENCES users(id),
                name VARCHAR(255),
                nic VARCHAR(255),
                SLMC_no VARCHAR(255),
                requested_role VARCHAR(255)
            ) ENGINE=INNODB;
            ";
        $db->pdo->exec($sql);

//        $sql = "ALTER TABLE roleRequest ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER requested_role;";
//        $db->pdo->exec($sql);
//        $sql = "ALTER TABLE roleRequest ADD status TINYINT default 0 AFTER requested_role;";
//        $db->pdo->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS emergency (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT,
                FOREIGN KEY (user_id) REFERENCES users(id),
                name VARCHAR(255),
                role_id INT,
                pressed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
            ";
        $db->pdo->exec($sql);

        $sql = "CREATE TABLE Immunization ( 
                recordId INT AUTO_INCREMENT PRIMARY KEY, 
                child_id INT NOT NULL, vac_id VARCHAR(255), 
                BatchNo VARCHAR(255) NOT NULL, 
                timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
                FOREIGN KEY (child_id) REFERENCES child(child_id) ON DELETE CASCADE )";
        $db->pdo->exec($sql);

    }

    public function down()
    {
        $db = Application::$app->db;

        $SQL = "DROP TABLE users;";

        $db->pdo->exec($SQL);
    }
}