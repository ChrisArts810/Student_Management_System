<?php 

// Start the session.
session_start();

include_once __DIR__ . '/../models/studentModel.php';

// Create an object (instance) of StudentModel.
$studentModel = new StudentModel();

// This processes the submitted student registration form.
$message = $studentModel->updateStudent();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Library Management System</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form method="POST" action="edit_student.php">
        <?php
        $students = $studentModel->getStudentById(isset($_GET['id']) ? $_GET['id'] : null);
        if ($students) {
            // Pre-fill the form fields with the student's data for editing
            $id = $students['id'];
            $name = $students['name'];
            $email = $students['email'];
            $phone = $students['phone'];
            $registrationNumber = $students['registration_no'];
        } else {
            // Initialize empty values for adding a new student
            $name = '';
            $email = '';
            $phone = '';
            $registrationNumber = '';
        }
        ?>
        <div class="form-group">
            <label for="studentName">Student Name</label>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Enter student name" required>
        </div>
        <div class="form-group">
            <label for="studentEmail">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Enter student email">
        </div>
        <div class="form-group">
            <label for="studentPhone">Phone</label>
            <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>"   placeholder="Enter student phone">
        </div>
        <div class="form-group">
            <label for="studentRegistrationNumber">Registration Number</label>
            <input type="text" class="form-control" name="registrationNumber" value="<?php echo $registrationNumber; ?>" placeholder="Enter student registration number">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>