<?php
class Lecturer {
    private $conn;
    private $table = "lecturers";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT lecturers.*, departments.department_name 
                  FROM " . $this->table . " 
                  JOIN departments ON lecturers.department_id = departments.id 
                  ORDER BY lecturers.id ASC";
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

    public function create($name, $nidn, $phone, $join_date, $department_id) {
        $query = "INSERT INTO " . $this->table . " (name, nidn, phone, join_date, department_id) 
                  VALUES (:name, :nidn, :phone, :join_date, :department_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':nidn', $nidn);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':join_date', $join_date);
        $stmt->bindParam(':department_id', $department_id);
        return $stmt->execute();
    }

    public function update($id, $name, $nidn, $phone, $join_date, $department_id) {
        $query = "UPDATE " . $this->table . " 
                  SET name = :name, nidn = :nidn, phone = :phone, join_date = :join_date, department_id = :department_id 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':nidn', $nidn);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':join_date', $join_date);
        $stmt->bindParam(':department_id', $department_id);
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