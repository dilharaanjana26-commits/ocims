<?php
session_start();
require_once __DIR__ . '/../app/bootstrap.php';

$router = new Router();

$router->get('', ['HomeController', 'index']);
$router->get('login', ['AuthController', 'login']);
$router->post('login', ['AuthController', 'handleLogin']);
$router->get('signup', ['AuthController', 'signup']);
$router->post('signup/teacher', ['AuthController', 'registerTeacher']);
$router->post('signup/student', ['AuthController', 'registerStudent']);
$router->get('logout', ['AuthController', 'logout']);

$router->get('admin', ['Admin\\DashboardController', 'index']);
$router->get('admin/dashboard', ['Admin\\DashboardController', 'index']);
$router->get('admin/teachers', ['Admin\\TeachersController', 'index']);
$router->post('admin/teachers/create', ['Admin\\TeachersController', 'store']);
$router->post('admin/teachers/approve', ['Admin\\TeachersController', 'approve']);
$router->get('admin/students', ['Admin\\StudentsController', 'index']);
$router->post('admin/students/create', ['Admin\\StudentsController', 'store']);
$router->post('admin/students/approve', ['Admin\\StudentsController', 'approve']);
$router->get('admin/batches', ['Admin\\BatchesController', 'index']);
$router->post('admin/batches/create', ['Admin\\BatchesController', 'store']);
$router->get('admin/payments', ['Admin\\PaymentsController', 'index']);
$router->get('admin/payments/proof', ['Admin\\PaymentsController', 'proof']);
$router->post('admin/payments/teacher/approve', ['Admin\\PaymentsController', 'approveTeacher']);
$router->post('admin/payments/student/approve', ['Admin\\PaymentsController', 'approveStudent']);
$router->get('admin/posts', ['Admin\\PostsController', 'index']);
$router->post('admin/posts/approve', ['Admin\\PostsController', 'approve']);
$router->post('admin/posts/feature', ['Admin\\PostsController', 'approveFeature']);
$router->get('admin/reminders', ['Admin\\RemindersController', 'index']);
$router->post('admin/reminders/run', ['Admin\\RemindersController', 'runJobs']);
$router->get('admin/reports', ['Admin\\ReportsController', 'index']);
$router->get('admin/setup-check', ['Admin\\SetupController', 'index']);

$router->get('teacher', ['Teacher\\DashboardController', 'index']);
$router->get('teacher/dashboard', ['Teacher\\DashboardController', 'index']);
$router->get('teacher/payments', ['Teacher\\PaymentsController', 'index']);
$router->post('teacher/payments/create', ['Teacher\\PaymentsController', 'store']);
$router->get('teacher/classes', ['Teacher\\ClassesController', 'index']);
$router->post('teacher/classes/create', ['Teacher\\ClassesController', 'store']);
$router->get('teacher/posts', ['Teacher\\PostsController', 'index']);
$router->post('teacher/posts/create', ['Teacher\\PostsController', 'store']);
$router->post('teacher/posts/feature', ['Teacher\\PostsController', 'requestFeature']);
$router->get('teacher/content', ['Teacher\\ContentController', 'index']);
$router->post('teacher/content/tute', ['Teacher\\ContentController', 'uploadTute']);
$router->post('teacher/content/live', ['Teacher\\ContentController', 'addLive']);

$router->get('student/{id}', ['Student\\DashboardController', 'index']);
$router->get('student/dashboard', ['Student\\DashboardController', 'index']);
$router->get('student/payments', ['Student\\PaymentsController', 'index']);
$router->post('student/payments/manual', ['Student\\PaymentsController', 'storeManual']);
$router->post('student/payments/online', ['Student\\PaymentsController', 'storeOnline']);
$router->get('student/content', ['Student\\ContentController', 'index']);

$router->dispatch();
