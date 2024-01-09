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

//        $SQL4 = "CREATE TABLE your_table_name (
//                    id INT AUTO_INCREMENT PRIMARY KEY,
//                    name VARCHAR(255) NOT NULL,
//                    district VARCHAR(255),
//                    address VARCHAR(255),
//                    gn_units INT);
//                ";
//        $db->pdo->exec($SQL4);

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
            moh_id INT,
            FOREIGN KEY (moh_id) REFERENCES doctors(`MOH_id`),
            district VARCHAR(255) NOT NULL,
            province VARCHAR(255) NOT NULL, 
            address VARCHAR(255) NOT NULL,
            created_at DATE,
            contact_no VARCHAR(255),
            capacity INT,
            gps_location VARCHAR(1000)
        ) ENGINE=INNODB;";


        $db->pdo->exec($SQL6);

        $SQL7 = "CREATE TABLE doctors (
                MOH_id INT NOT NULL AUTO_INCREMENT primary key,
                user_id INT,
                SLMC_no VARCHAR(255) NOT NULL,
                clinic_id INT,
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (clinic_id) REFERENCES clinics(id)
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL7);

        $SQL8 = "CREATE TABLE midwife (
                PHM_id INT NOT NULL AUTO_INCREMENT primary key ,
                user_id INT,
                SLMC_no VARCHAR(255) NOT NULL,
                clinic_id INT,
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (clinic_id) REFERENCES clinics(id)
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL8);

        $SQL9 = "CREATE TABLE Mothers (
            MotherId INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            PHM_ID INT,
            MOH_ID INT,
            clinic_id INT,
            status varchar(255),
            MaritalStatus VARCHAR(255),
            MarriageDate DATE,
            BloodGroup VARCHAR(10),
            Occupation VARCHAR(255),
            gps_location varchar(1000),
            Allergies TEXT,
            Consanguinity VARCHAR(255),
            history_subfertility varchar(255),
            Hypertension TINYINT(1),
            diabetes_mellitus TINYINT(1),
            rubella_immunization TINYINT(1),
            emergency_no VARCHAR(20),
            FOREIGN KEY (MOH_ID) REFERENCES doctors(MOH_id),
            FOREIGN KEY (PHM_ID) REFERENCES midwife(PHM_id),
            FOREIGN KEY (clinic_id) REFERENCES clinics(id),
            FOREIGN KEY (user_id) REFERENCES users(id)
        ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL9);

        $SQL10 = "CREATE TABLE pregnancy_record (
            id INT AUTO_INCREMENT PRIMARY KEY,
            mother_id int not null,
            phm_id int not null,
            FOREIGN KEY (mother_id) REFERENCES Mothers(MotherID),
            FOREIGN KEY (phm_id) REFERENCES midwife(PHM_id),
            risk_level varchar(255),
            status varchar(255) default 'prenatal',
            gradivity INT,
            initial_bim float,
            no_living_children INT,
            age_of_youngest INT,
            last_menstrual_date date,
            expected_due date,
            DO_pregnancy_confirm date,
            POA_at_registration INT,
            folic_acid tinyint,
            medial_surgical_conditions varchar(1000),
            edu_materials INT,
            outcome varchar(255),
            birth_weight float,
            weeks_of_pregnancy int,
            apgar_score float,
            date_delivery date,
            time_delivery timestamp,
            mode_delivery varchar(255),
            vitaminA_megadose tinyint,
            antiD tinyint,
            postnatal_mother_screening tinyint,
            postnatal_baby_screening tinyint,
            discharge_date date,
            remarks varchar(1000)
        ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL10);

        $SQL11 = "CREATE TABLE child (
                child_id INT NOT NULL AUTO_INCREMENT primary key,
                mother_id int,
                FOREIGN KEY (mother_id) REFERENCES Mothers(MotherId),
                phm_id int,
                FOREIGN KEY (phm_id) REFERENCES midwife(PHM_id),
                moh_id int,
                FOREIGN KEY (moh_id) REFERENCES doctors(MOH_id),
                baby_book_id int,
                FOREIGN KEY (baby_book_id) REFERENCES baby_book(bb_id),
                firstname varchar(255),
                lastname varchar(255),
                DOB date,
                blood_group varchar(255),
                address varchar(1000),
                status varchar(255),
                gender varchar(255)
             ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL11);

        $SQL12 = "CREATE TABLE baby_book(
                bb_id INT NOT NULL AUTO_INCREMENT primary key,
                child_id int,
                FOREIGN KEY (child_id) REFERENCES child(child_id),
                pregnancy_record_id int,
                FOREIGN KEY (pregnancy_record_id) REFERENCES pregnancy_record(id),
                phm_id int,
                FOREIGN KEY (phm_id) REFERENCES midwife(PHM_id),
                DO_reg date,
                special_needs varchar(255),
                birth_weight float,
                head_circum_birth float,
                overall_health varchar(1000),
                vitaminK tinyint    
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL12);

        $SQL13 = "CREATE TABLE prev_pregnancy_comp(
                id INT NOT NULL AUTO_INCREMENT primary key,
                mother_id int,
                FOREIGN KEY (mother_id) REFERENCES Mothers(MotherId),
                gradivity int,
                conditions varchar(5000)
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL13);

        $SQL14 = "CREATE TABLE contact_nos(
                id INT NOT NULL AUTO_INCREMENT primary key,
                user_id int,
                FOREIGN KEY (user_id) REFERENCES users(id),
                contact_no varchar(255)
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL14);

        $SQL15 = "CREATE TABLE baby_immu_visit(
                id INT NOT NULL AUTO_INCREMENT primary key,
                child_id int,
                FOREIGN KEY (child_id) REFERENCES child(child_id),
                date date,
                age int,
                vacc_type varchar(255),
                batch_no varchar(255),
                effects varchar(1000),
                DO_next_vacc date         
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL15);

        $SQL16 = "CREATE TABLE child_clinic_visit(
                id INT NOT NULL AUTO_INCREMENT primary key,
                FOREIGN KEY (id) REFERENCES clinic_sched(id),
                child_id int,
                FOREIGN KEY (child_id) REFERENCES child(child_id),
                age int,
                date date,
                congenital_dis varchar(255),
                eye_sight varchar(255),
                hearing varchar(255),
                dental_condition varchar(255),
                heart_condition varchar(255),
                hip_joint varchar(255),
                other_diseases varchar(1000),
                weight float,
                length float,
                DO_next_visit date             
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL16);

        $SQL17 = "CREATE TABLE clinic_sched(
                id INT NOT NULL AUTO_INCREMENT primary key,
                clinic_id int,
                FOREIGN KEY (clinic_id) REFERENCES clinics(id),
                moh_id int,
                FOREIGN KEY (moh_id) REFERENCES doctors(MOH_id),
                time timestamp,
                date date
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL17);

        $SQL18 = "CREATE TABLE home_visit_sched(
                id INT NOT NULL AUTO_INCREMENT primary key,
                phm_id int,
                FOREIGN KEY (phm_id) REFERENCES midwife(PHM_id),
                mother_id int,
                FOREIGN KEY (mother_id) REFERENCES Mothers(MotherId),
                time timestamp,
                date date    
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL18);

        $SQL19 = "CREATE TABLE prenatal_clinic_visit(
                id INT NOT NULL AUTO_INCREMENT primary key,
                FOREIGN KEY (id) REFERENCES clinic_sched(id),
                mother_id int,
                FOREIGN KEY (mother_id) REFERENCES Mothers(MotherId),
                visit_no int,
                trimester int,
                pregnancy_week int,
                weight float,
                fundal_height float,
                blood_sugar float,
                blood_pressure float,
                BMI float,
                DO_next_visit date
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL19);


        $SQL21 = "CREATE TABLE prenatal_home_visit(
                id INT NOT NULL AUTO_INCREMENT primary key,
                FOREIGN KEY (id) REFERENCES home_visit_sched(id),
                visit_no int,
                trimester int,
                pregnancy_week int,
                DO_next_visit date
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL21);

        $SQL22 = "CREATE TABLE postnatal_home_visit(
                id INT NOT NULL AUTO_INCREMENT primary key,
                FOREIGN KEY (id) REFERENCES home_visit_sched(id),
                visit_no int,
                postnatal_week int,
                DO_microNutrients int,
                DO_next_visit date
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL22);

        $SQL23 = "CREATE TABLE prenatal_class(
                id INT NOT NULL AUTO_INCREMENT primary key,
                mother_id int,
                FOREIGN KEY (mother_id) REFERENCES Mothers(MotherId),
                phm_id int,
                FOREIGN KEY (phm_id) REFERENCES midwife(PHM_id),
                date date,
                trimester int,
                place varchar(255),
                wife_attendance varchar(255),
                husband_attendance varchar(255)
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL23);

        $SQL25 = "CREATE TABLE obstetric_history(
                id INT NOT NULL AUTO_INCREMENT primary key,
                mother_id int,
                FOREIGN KEY (mother_id) REFERENCES Mothers(MotherId),
                pregnancy int,
                DO_delivery date,
                place_delivery varchar(255),
                method_delivery varchar(255),
                outcome varchar(255),
                birth_weight float,
                sex varchar(255),
                child_present_age int        
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL25);

        $SQL20 = "CREATE TABLE fetal_kick_count(
                id INT NOT NULL AUTO_INCREMENT primary key,
                mother_id int,
                FOREIGN KEY (mother_id) REFERENCES Mothers(MotherId),
                date date,
                kick_count int
            ) ENGINE=INNODB;
            ";

        $db->pdo->exec($SQL20);
    }

    public function down()
    {
        $db = Application::$app->db;

        $SQL = "DROP TABLE users;";

        $db->pdo->exec($SQL);
    }
}