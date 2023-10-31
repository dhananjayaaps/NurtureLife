<?php

require_once __DIR__ .'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use app\controllers\AdminController\ClinicsController;
use app\controllers\AdminController\DoctorController;
use app\controllers\AdminController\MidwifeController;
use app\controllers\AuthController;
use app\core\Application;
use app\controllers\SiteController;
use app\models\User;

$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/profile', [AuthController::class, 'profile']);

$app->router->get('/doctors', [DoctorController::class, 'Doctor']);
$app->router->post('/doctors', [DoctorController::class, 'Doctor']);
$app->router->post('/doctorUpdate', [DoctorController::class, 'DoctorsUpdate']);
$app->router->post('/deleteDoctor', [DoctorController::class, 'DoctorDelete']);
$app->router->get('/getDoctorDetails', [DoctorController::class, 'getDoctorDetails']);

$app->router->get('/clinics', [ClinicsController::class, 'clinics']);
$app->router->post('/clinics', [ClinicsController::class, 'clinics']);
$app->router->post('/clinicsUpdate', [ClinicsController::class, 'clinicsUpdate']);
$app->router->post('/deleteClinic', [ClinicsController::class, 'clinicDelete']);
$app->router->get('/getClinicDetails', [ClinicsController::class, 'getClinicDetails']);

$app->router->get('/midwife', [MidwifeController::class, 'Midwife']);
$app->router->post('/midwife', [MidwifeController::class, 'Midwife']);
$app->router->post('/midwifeUpdate', [MidwifeController::class, 'MidwifeUpdate']);
$app->router->post('/deleteMidwife', [MidwifeController::class, 'MidwifeDelete']);
$app->router->get('/getMidwifeDetails', [MidwifeController::class, 'getMidwifeDetails']);


$app->router->get('/reports', [ClinicsController::class, 'reports']);
$app->router->post('/reports', [ClinicsController::class, 'reports']);

$app->router->post('/changeRole', [\app\controllers\SiteController::class, 'changeRole']);



$app->run();