<?php
require_once 'model/Lecturer.php';
require_once 'model/Department.php';

class LecturerController {
    private $lecturerModel;
    private $departmentModel;

    public function __construct($db) {
        $this->lecturerModel = new Lecturer($db);
        $this->departmentModel = new Department($db);
    }

    public function handleRequest() {
        // Proses Create & Update
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $name = $_POST['name'];
            $nidn = $_POST['nidn'];
            $phone = $_POST['phone'];
            $join_date = $_POST['join_date'];
            $department_id = $_POST['department_id'];

            if (!empty($id)) {
                $this->lecturerModel->update($id, $name, $nidn, $phone, $join_date, $department_id);
            } else {
                $this->lecturerModel->create($name, $nidn, $phone, $join_date, $department_id);
            }
            header("Location: index.php?page=lecturers");
            exit;
        }

        // Proses Delete
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $this->lecturerModel->delete($_GET['id']);
            header("Location: index.php?page=lecturers");
            exit;
        }

        // Ambil data untuk mode Edit (jika ada)
        $editData = null;
        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $editData = $this->lecturerModel->getById($_GET['id']);
        }

        // Ambil data lecturers & daftar departments untuk dropdown
        $lecturers = $this->lecturerModel->getAll();
        $departments = $this->departmentModel->getAll();
        $page = 'lecturers';
        include 'view/lecturers.php';
    }
}
?>