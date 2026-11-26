
<?php

// Include the Student class file.
include_once __DIR__ . '/../controllers/studentController.php';

// Create the StudentModel class.
class StudentModel {

    // Declare a private property for the Student object.
    private $student;

    // Constructor method.
    // Automatically creates a Student object.
    public function __construct() {
        $this->student = new StudentController();
    }

    // Method for adding a new student.
    public function addStudent() {

        // Initialize an empty message variable.
        $message = '';

        // Check whether the submitted request uses POST.
        // Also check whether all required form fields are present.
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset(
                $_POST['name'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['registrationNumber']
            )
        ) {

            // Retrieve student information from the form.
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $registrationNumber = $_POST['registrationNumber'];

            // Call the addStudent() method from the Student class.
            if ($this->student->addStudent(
                $name,
                $email,
                $phone,
                $registrationNumber
            )) {

                // Store a success message.
                $message = "Student added successfully!";

            } else {

                // Store an error message.
                $message = "Error adding student.";
            }
        }

        // Return the registration message.
        return $message;
    }

    // Method for retrieving all student records.
    public function getAllStudents() {

        // Call the getAllStudents() method
        // from the Student class.
        return $this->student->getAllStudents();
    }

    public function getStudentById($id){

        return $this->student->getStudentById($id);
    }

    public function updateStudent(){

        $message = "";

        // Store the message in the session.
        $_SESSION['message'] = $message;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['registrationNumber'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $registrationNumber = $_POST['registrationNumber'];

            // Update existing student
            if ($this->student->updateStudent($id, $name, $email, $phone, $registrationNumber)) {
                $message = "Student updated successfully";

                // Store the message in the session.
                $_SESSION['message'] = $message;
                
                header("Location: student.php?");
                //exit();
            } else {
                $message = "Error updating student!";
                //header("Location: student.php?message=Error updating student");
                //exit();
            }
        }

        // Return the message to the calling PHP page.
        return $message;

    }

    // ==========================================
    // FUNCTION: DELETE STUDENT
    // ==========================================
    public function deleteStudent() {

        // Initialize an empty message variable.
        $message = "";

        // Check whether a student ID is provided through GET.
        if (isset($_GET['id'])) {

            // Retrieve the student ID.
            $id = $_GET['id'];

            // Validate the student ID.
            if (!is_numeric($id) || (int)$id <= 0) {
                return "Invalid student ID.";
            }

            // Call the deleteStudent() method from Student class.
            if ($this->student->deleteStudent((int)$id)) {

                // Return success message.
                $message = "Student deleted successfully!";

            } else {

                // Return error message.
                $message = "Error deleting student.";
            }

        } else {

            // Return message if ID is missing.
            $message = "Student ID not found.";
        }

        // Return the result.
        return $message;
    }
}

?>
