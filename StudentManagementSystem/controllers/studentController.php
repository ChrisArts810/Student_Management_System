<?php
require_once __DIR__ . '/../config/Database.php';

class StudentController extends Database {

    public function __construct() {
        parent::__construct(); // Call parent constructor (Database)
        $this->connect();      // Establish connection automatically
    }

    // Funtion to add a new student to the database
    public function addStudent($name, $email, $phone, $registrationNumber) {
        $stmt = $this->conn->prepare("INSERT INTO students (name, email, phone, registration_no) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $registrationNumber);
        return $stmt->execute();
    }

    // Function to get all students from the database
    public function getAllStudents() {
        $stmt = $this->conn->prepare("SELECT * FROM students");
        $stmt->execute();
        return $stmt->get_result();
    }

    // Function to get a single student by ID
    public function getStudentById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Function to update a student's information
    public function updateStudent($id, $name, $email, $phone, $registrationNumber) {
        $stmt = $this->conn->prepare("UPDATE students SET name = ?, email = ?, phone = ?, registration_no = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $name, $email, $phone, $registrationNumber, $id);
        return $stmt->execute();
    }

    // Function to delete a student from the database
    public function deleteStudent($id) {
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
