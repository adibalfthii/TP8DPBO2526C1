<?php
class Course {
    private $conn;
    private $table = "courses";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT courses.*, lecturers.name AS lecturer_name 
                  FROM " . $this->table . " 
                  JOIN lecturers ON courses.lecturer_id = lecturers.id 
                  ORDER BY courses.id ASC";
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

    public function create($course_code, $course_name, $credits, $lecturer_id) {
        $query = "INSERT INTO " . $this->table . " (course_code, course_name, credits, lecturer_id) 
                  VALUES (:course_code, :course_name, :credits, :lecturer_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':course_code', $course_code);
        $stmt->bindParam(':course_name', $course_name);
        $stmt->bindParam(':credits', $credits);
        $stmt->bindParam(':lecturer_id', $lecturer_id);
        return $stmt->execute();
    }

    public function update($id, $course_code, $course_name, $credits, $lecturer_id) {
        $query = "UPDATE " . $this->table . " 
                  SET course_code = :course_code, course_name = :course_name, credits = :credits, lecturer_id = :lecturer_id 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':course_code', $course_code);
        $stmt->bindParam(':course_name', $course_name);
        $stmt->bindParam(':credits', $credits);
        $stmt->bindParam(':lecturer_id', $lecturer_id);
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