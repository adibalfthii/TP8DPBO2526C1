<?php
require_once 'config/Database.php';
require_once 'controller/LecturerController.php';
require_once 'controller/DepartmentController.php';
require_once 'controller/CourseController.php';

$database = new Database();
$db = $database->getConnection();

$page = isset($_GET['page']) ? $_GET['page'] : 'lecturers';

switch ($page) {
    case 'departments':
        $controller = new DepartmentController($db);
        $controller->handleRequest();
        break;
    case 'courses':
        $controller = new CourseController($db);
        $controller->handleRequest();
        break;
    case 'lecturers':
    default:
        $controller = new LecturerController($db);
        $controller->handleRequest();
        break;
}
?>