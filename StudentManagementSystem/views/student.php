
<?php

// Start the session.
session_start();

// Include the StudentModel class file.
include_once __DIR__ . '/../models/studentModel.php';

// Create an object (instance) of StudentModel.
$studentModel = new StudentModel();

// Retrieve the message from the session.
$message = $_SESSION['message'] ?? '';

// Remove the message after retrieving it.
unset($_SESSION['message']);

// Process student registration.
$registrationMessage = $studentModel->addStudent();

// Retrieve all students.
$students = $studentModel->getAllStudents();

// Use the registration message if available.
if (!empty($registrationMessage)) {
    $message = $registrationMessage;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Management System</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

    <style>

        /* Toast Notification Container */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        /* Toast Notification */
        .student-toast {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 320px;
            max-width: 420px;
            padding: 16px 20px;
            background: #ffffff;
            border-left: 5px solid #28a745;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);

            opacity: 0;
            transform: translateX(-30px);
            animation: slideIn 0.5s ease forwards;
        }

        /* Toast Icon */
        .toast-icon {
            font-size: 28px;
            color: #28a745;
        }

        /* Toast Content */
        .toast-content {
            flex: 1;
        }

        .toast-content strong {
            display: block;
            font-size: 15px;
            color: #333;
        }

        .toast-content p {
            margin: 3px 0 0;
            font-size: 13px;
            color: #666;
        }

        /* Close Button */
        .toast-close {
            border: none;
            background: none;
            font-size: 24px;
            color: #999;
            cursor: pointer;
        }

        /* Slide In Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Slide Out Animation */
        .student-toast.hide {
            animation: slideOut 0.5s ease forwards;
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(-30px);
            }
        }

    </style>

</head>

<body>


    <!-- Toast Notification Container -->
    <div class="toast-container">

        <?php if (!empty($message)) : ?>

            <div id="studentToast" class="student-toast">

                <div class="toast-icon">
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="toast-content">
                    <strong>Notification</strong>
                    <p><?php echo htmlspecialchars($message); ?></p>
                </div>

                <button type="button" class="toast-close"
                        onclick="closeToast()">
                    &times;
                </button>

            </div>

        <?php endif; ?>

    </div>


    <div class="container mt-5">

        <h1 class="text-center mb-4">
            Student Management System
        </h1>

        <p class="text-center">Student Page</p>

        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Dashboard</a>
            <a href="#" class="btn btn-primary">Students</a>
        </div>

        <div class="row mt-4">

            <!-- Student Registration Form -->
            <div class="col-md-4 mx-auto">

                <!-- Display registration feedback message -->
               

                <h2 class="text-center mb-4">
                    Add New Student
                </h2>

                <form method="POST" action="student.php">

                    <div class="form-group">
                        <label for="studentName">Student Name</label>

                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            placeholder="Enter student name"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="studentEmail">Email</label>

                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            placeholder="Enter student email"
                        >
                    </div>

                    <div class="form-group">
                        <label for="studentPhone">Phone</label>

                        <input
                            type="text"
                            class="form-control"
                            name="phone"
                            placeholder="Enter student phone"
                        >
                    </div>

                    <div class="form-group">
                        <label for="studentRegistrationNumber">
                            Registration Number
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="registrationNumber"
                            placeholder="Enter student registration number"
                        >
                    </div>

                    <button type="submit" class="btn btn-success">
                        Submit
                    </button>

                </form>

            </div>

            <!-- Student Records Table -->
            <div class="col-md-8 mx-auto">

                <h2 class="text-center mb-4">
                    Student List
                </h2>

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Registration Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        // Loop through all retrieved student records.
                        while ($row = $students->fetch_assoc()) {

                            echo "<tr>";

                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";

                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";

                            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";

                            echo "<td>" . htmlspecialchars($row['registration_no']) . "</td>";

                            echo "<td>
                                    <a href='edit_student.php?id=" . (int)$row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>

                                    <a href='delete_student.php?id=" . (int)$row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                                  </td>";

                            echo "</tr>";
                        }

                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
                
        // Automatically close the notification after 4 seconds.
        const toast = document.getElementById('studentToast');

        if (toast) {
            setTimeout(function() {
                closeToast();
            }, 4000);
        }

        // Function for closing the notification.
        function closeToast() {

            const toast = document.getElementById('studentToast');

            if (toast) {
                toast.classList.add('hide');

                setTimeout(function() {
                    toast.remove();
                }, 500);
            }
        }

    </script>
</body>
</html>
