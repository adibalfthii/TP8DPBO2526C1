<?php
class Department {
    private $conn;
    private $table = "departments";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($department_name, $faculty) {
        $query = "INSERT INTO " . $this->table . " (department_name, faculty) VALUES (:department_name, :faculty)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':department_name', $department_name);
        $stmt->bindParam(':faculty', $faculty);
        return $stmt->execute();
    }

    public function update($id, $department_name, $faculty) {
        $query = "UPDATE " . $this->table . " SET department_name = :department_name, faculty = :faculty WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':department_name', $department_name);
        $stmt->bindParam(':faculty', $faculty);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>