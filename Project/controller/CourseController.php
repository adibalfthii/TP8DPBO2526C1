<?php
require_once 'model/Course.php';
require_once 'model/Lecturer.php';

class CourseController {
    private $courseModel;
    private $lecturerModel;

    public function __construct($db) {
        $this->courseModel = new Course($db);
        $this->lecturerModel = new Lecturer($db);
    }

    public function handleRequest() {
        // Proses Create & Update
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $course_code = $_POST['course_code'];
            $course_name = $_POST['course_name'];
            $credits = $_POST['credits'];
            $lecturer_id = $_POST['lecturer_id'];

            if (!empty($id)) {
                $this->courseModel->update($id, $course_code, $course_name, $credits, $lecturer_id);
            } else {
                $this->courseModel->create($course_code, $course_name, $credits, $lecturer_id);
            }
            header("Location: index.php?page=courses");
            exit;
        }

        // Proses Delete
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $this->courseModel->delete($_GET['id']);
            header("Location: index.php?page=courses");
            exit;
        }

        // Ambil data untuk mode Edit (jika ada)
        $editData = null;
        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $editData = $this->courseModel->getById($_GET['id']);
        }

        // Ambil data courses & daftar lecturers untuk dropdown
        $courses = $this->courseModel->getAll();
        $lecturers = $this->lecturerModel->getAll();
        $page = 'courses';
        include 'view/courses.php';
    }
}
?>