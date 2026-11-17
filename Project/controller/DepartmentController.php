<?php
require_once 'model/Department.php';

class DepartmentController {
    private $departmentModel;

    public function __construct($db) {
        $this->departmentModel = new Department($db);
    }

    public function handleRequest() {
        // Proses Create & Update
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $department_name = $_POST['department_name'];
            $faculty = $_POST['faculty'];

            if (!empty($id)) {
                $this->departmentModel->update($id, $department_name, $faculty);
            } else {
                $this->departmentModel->create($department_name, $faculty);
            }
            header("Location: index.php?page=departments");
            exit;
        }

        // Proses Delete
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $this->departmentModel->delete($_GET['id']);
            header("Location: index.php?page=departments");
            exit;
        }

        // Ambil data untuk mode Edit (jika ada)
        $editData = null;
        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $editData = $this->departmentModel->getById($_GET['id']);
        }

        // Ambil semua data untuk ditampilkan di tabel
        $departments = $this->departmentModel->getAll();
        $page = 'departments';
        include 'view/departments.php';
    }
}
?>