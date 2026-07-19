<?php

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$publicRoutes = [
    '/login'
];

if (
    empty($_SESSION['user']) &&
    !in_array($path, $publicRoutes, true)
) {
    header('Location: /login');
    exit;
}

require __DIR__ . '/../app/Core/helpers.php';
require __DIR__ . '/../app/Core/Router.php';
require __DIR__ . '/../app/Core/Database.php';
require __DIR__ . '/../app/Core/DuplicateRecordException.php';
require __DIR__ . '/../app/Core/Auth.php';

require __DIR__ . '/../app/Repositories/UserRepository.php';
require __DIR__ . '/../app/Repositories/StudentRepository.php';
require __DIR__ . '/../app/Repositories/EnrollmentRepository.php';
require __DIR__ . '/../app/Repositories/LeadRepository.php';

require __DIR__ . '/../app/Services/AuthService.php';
require __DIR__ . '/../app/Services/StudentService.php';
require __DIR__ . '/../app/Services/EnrollmentService.php';
require __DIR__ . '/../app/Services/LeadService.php';

require __DIR__ . '/../app/Controllers/HomeController.php';
require __DIR__ . '/../app/Controllers/HealthController.php';

require __DIR__ . '/../app/Controllers/AuthController.php';
require __DIR__ . '/../app/Controllers/DashboardController.php';

require __DIR__ . '/../app/Controllers/PublicLeadController.php';

require __DIR__ . '/../app/Controllers/StudentController.php';
require __DIR__ . '/../app/Controllers/EnrollmentController.php';

$router = new Router();

$router->get(
    '/',
    [HomeController::class,'index']
);

$router->get(
    '/health',
    [HealthController::class,'index']
);

$router->get(
    '/login',
    [AuthController::class,'login']
);


$router->post(
    '/login',
    [AuthController::class,'handleLogin']
);


$router->post(
    '/logout',
    [AuthController::class,'logout']
);

$router->get(
    '/dashboard',
    [DashboardController::class,'index']
);

$router->get(
    '/public-leads/create',
    [PublicLeadController::class,'create']
);


$router->post(
    '/public-leads',
    [PublicLeadController::class,'store']
);

$router->get(
    '/students',
    [StudentController::class,'index']
);


$router->get(
    '/students/create',
    [StudentController::class,'create']
);


$router->post(
    '/students/store',
    [StudentController::class,'store']
);


$router->get(
    '/students/edit',
    [StudentController::class,'edit']
);


$router->post(
    '/students/update',
    [StudentController::class,'update']
);


$router->post(
    '/students/delete',
    [StudentController::class,'delete']
);

$router->get(
    '/enrollments',
    [EnrollmentController::class,'index']
);


$router->get(
    '/enrollments/create',
    [EnrollmentController::class,'create']
);


$router->post(
    '/enrollments/store',
    [EnrollmentController::class,'store']
);


$router->get(
    '/enrollments/edit',
    [EnrollmentController::class,'edit']
);


$router->post(
    '/enrollments/update',
    [EnrollmentController::class,'update']
);


$router->post(
    '/enrollments/delete',
    [EnrollmentController::class,'delete']
);



$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);