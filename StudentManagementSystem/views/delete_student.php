<?php

// Start the session.
session_start();

// Include StudentModel.
include_once __DIR__ . '/../models/StudentModel.php';

// Create StudentModel object.
$studentModel = new StudentModel();

// Call deleteStudent() and retrieve the message.
$message = $studentModel->deleteStudent();

// Store the message in the session.
$_SESSION['message'] = $message;

// Redirect to student.php without URL parameters.
header("Location: student.php");
exit();

?>