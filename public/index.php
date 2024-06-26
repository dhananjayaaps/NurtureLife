<?php

require_once __DIR__ .'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use app\controllers\AdminController\AdminController;
use app\controllers\AdminController\ClinicsController;
use app\controllers\AdminController\DoctorController;
use app\controllers\AdminController\MidwifeController;
use app\controllers\AdminController\UsersController;
use app\controllers\AppoinmetHandler;
use app\controllers\AuthController;
use app\controllers\DoctorController\PostMotherController;
use app\controllers\EmergencyController;
use app\controllers\FeedbackController;
use app\controllers\MidwifeController\AppointmentController;
use app\controllers\MidwifeController\ChildChartController;
use app\controllers\MidwifeController\ChildController;
use app\controllers\MidwifeController\PreMotherController;
use app\controllers\MotherController;
use app\controllers\MotherController\FetalkickController;
use app\controllers\PostController;
use app\controllers\MotherController\PreMotherCareController;
use app\controllers\PostRequestController;
use app\controllers\ReportController\Registration;
use app\controllers\RoleRequestController;
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
$app->router->get('/about', [SiteController::class, 'about']);

$app->router->get('/contact', [FeedbackController::class, 'feedbacks']);
$app->router->post('/contact', [FeedbackController::class, 'feedbacks']);

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

$app->router->get('/users', [UsersController::class, 'users']);
$app->router->post('/users', [UsersController::class, 'users']);

$app->router->post('/userUpdate', [UsersController::class, 'userUpdate']);

$app->router->post('/changeRole', [\app\controllers\SiteController::class, 'changeRole']);

$app->router->get('/preMotherForm', [PreMotherController::class, 'PreMother']);
$app->router->post('/preMotherForm', [PreMotherController::class, 'PreMother']);
$app->router->get('/preMotherForm', [PreMotherController::class, 'PreMother']);
$app->router->post('/preMotherForm', [PreMotherController::class, 'PreMother']);

$app->router->get('/MotherSymptoms', [MotherController::class, 'MotherSymptom']);
$app->router->post('/MotherSymptoms', [MotherController::class, 'MotherSymptom']);
$app->router->post('/symptomsUpdate', [MotherController::class, 'MotherSymptomUpdate']);
$app->router->post('/deleteSymptom', [MotherController::class, 'MotherSymptomDelete']);

$app->router->get('/fetalkick', [FetalkickController::class, 'Fetalkick']);
$app->router->post('/fetalkick', [FetalkickController::class, 'Fetalkick']);
$app->router->post('/fetalkickUpdate', [FetalkickController::class, 'fetalkickUpdate']);

$app->router->get('/doctorClinics', [SiteController::class, 'doctorClinics']);
$app->router->get('/doctorMothers', [SiteController::class, 'doctorMothers']);

$app->router->get('/Child', [ChildController::class, 'Child']);
$app->router->post('/Child', [ChildController::class, 'Child']);

$app->router->get('/viewChild', [ChildController::class, 'viewChild']);

$app->router->get('/childCard', [ChildController::class, 'ChildCard']);
$app->router->post('/childCard', [ChildController::class, 'ChildCard']);

$app->router->get('/childCard1', [ChildController::class, 'ChildCard1']);
$app->router->post('/childCard1', [ChildController::class, 'ChildCard1']);

$app->router->get('/childCard2', [ChildController::class, 'ChildCard2']);
$app->router->post('/childCard2', [ChildController::class, 'ChildCard2']);

$app->router->get('/ManageAppointments', [AppointmentController::class, 'ManageAppointments']);
$app->router->post('/ManageAppointments', [AppointmentController::class, 'ManageAppointments']);

$app->router->get('/mothers', [AppoinmetHandler::class, 'appointments']);

$app->router->get('/appointments', [AppoinmetHandler::class, 'appointments']);
$app->router->post('/appointments', [AppoinmetHandler::class, 'appointments']);

$app->router->get('/about', [SiteController::class, 'about']);
//$app->router->get('/preMotherTest', [SiteController::class, 'preMotherTest']);
$app->router->get('/communication', [PostController::class, 'communication']);
$app->router->get('/communication', [PostController::class, 'communication']);

$app->router->get('/replySymptoms', [SiteController::class, 'doctorViewSymptoms']);
$app->router->get('/checkSymptoms', [SiteController::class, 'midwifeViewSymptoms']);



$app->router->get('/immunizationCard', [ChildController::class, 'ImmunizationCard']);
$app->router->post('/immunizationCard', [ChildController::class, 'ImmunizationCard']);

$app->router->get('/  ', [ChildController::class, 'preMotherForm1']);
$app->router->post('/preMotherForm1', [ChildController::class, 'preMotherForm1']);

$app->router->get('/fetalKicks', [FetalkickController::class, 'Fetalkick']);
$app->router->post('/fetalKicks', [FetalkickController::class, 'fetalkickUpdate']);

$app->router->get('/preMotherHistoryForm1', [PreMotherController::class, 'preMotherHistoryForm1']);
$app->router->post('/preMotherHistoryForm1', [PreMotherController::class, 'preMotherHistoryForm1']);

$app->router->get('/preMotherHistoryForm2', [PreMotherController::class, 'preMotherHistoryForm2']);
$app->router->post('/preMotherHistoryForm2', [PreMotherController::class, 'preMotherHistoryForm2']);

$app->router->get('/preMotherHistoryForm3', [PreMotherController::class, 'preMotherHistoryForm3']);
$app->router->post('/preMotherHistoryForm3', [PreMotherController::class, 'preMotherHistoryForm3']);

$app->router->get('/personalInformationForm', [PreMotherController::class, 'personalInformationForm']);
$app->router->post('/personalInformationForm', [PreMotherController::class, 'personalInformationForm']);

$app->router->get('/verify-email', [AuthController::class, 'verifyEmail']);
$app->router->get('/verify', [AuthController::class, 'verifyEmail']);
$app->router->get('/verify-phone', [AuthController::class, 'verifyPhone']);

$app->router->get('/motherProfile', [MotherController\MotherProfile::class, 'motherProfile']);

$app->router->get('/childProfile', [ChildController::class, 'childProfile']);

$app->router->get('/postMotherForm1', [PostMotherController::class, 'postMotherForm1']);
$app->router->post('/postMotherForm1', [PostMotherController::class, 'postMotherForm1']);

$app->router->get('/posts', [PostController::class, 'posts']);
$app->router->post('/posts', [PostController::class, 'posts']);
$app->router->post('/postsUpdate', [PostController::class, 'postsUpdate']);
$app->router->post('/postDelete', [PostController::class, 'postDelete']);
$app->router->get('/getPostDetails', [PostController::class, 'getPostDetails']);

$app->router->get('/policy', [SiteController::class, 'policy']);
$app->router->post('/policy', [SiteController::class, 'policy']);

$app->router->get('/preMotherCareForm2', [PreMotherCareController::class, 'preMotherCareForm2']);
$app->router->post('/preMotherCareForm2', [PreMotherCareController::class, 'preMotherCareForm2']);

$app->router->get('/ManageAdmins', [AdminController::class, 'Admin']);
$app->router->post('/ManageAdmins', [AdminController::class, 'Admin']);

$app->router->post('/cancel-appointment', [AppoinmetHandler::class, 'cancelAppointment']);

$app->router->get('/childweight', [ChildChartController::class, 'ChildWeight']);
$app->router->post('/childweight', [ChildChartController::class, 'ChildWeightUpdate']);

$app->router->get('/childHeight', [ChildChartController::class, 'ChildHeight']);
$app->router->post('/childHeight', [ChildChartController::class, 'ChildHeightUpdate']);

$app->router->get('/roleRequest', [RoleRequestController::class, 'roleRequest']);
$app->router->post('/roleRequest', [RoleRequestController::class, 'roleRequest']);

$app->router->get('/motherRegistrations', [Registration::class, 'MotherRegistration']);
$app->router->get('/childBorn', [Registration::class, 'childBorn']);

$app->router->get('/nutrition', [SiteController::class, 'nutrition']);

$app->router->get('/articles', [SiteController::class, 'articles']);

$app->router->get('/motherRegistrations', [Registration::class, 'MotherRegistration']);
$app->router->get('/childBorn', [Registration::class, 'childBorn']);

$app->router->post('/deleteAppointments', [AppoinmetHandler::class, 'deleteAppointments']);


$app->run();