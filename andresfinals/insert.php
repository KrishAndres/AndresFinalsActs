<?php
require_once 'core/handleForms.php';
require_once 'core/models.php';

// Handle the form submission for inserting a new applicant
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the form data
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'gender' => $_POST['gender'],
        'address' => $_POST['address'],
        'state' => $_POST['state'],
        'nationality' => $_POST['nationality'],
        'job_title' => $_POST['job_title'],
        'qualifications' => $_POST['qualifications'],
        'years_of_experience' => $_POST['years_of_experience'],
    ];

    // Check if all fields are filled out
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $error_message = "Please fill out all fields.";
            break;
        }
    }

    if (!isset($error_message)) {
        // Insert the new applicant using the insertApplicant function
        $insertResult = insertNewApplicant($pdo, $data); // Pass the entire $data array here

        // Check if the insertion was successful
        if ($insertResult) {
            // Log the activity (if user is logged in)
            if (isset($_SESSION['user_id'], $_SESSION['username'])) {
                $user_id = $_SESSION['user_id'];
                $username = $_SESSION['username'];
                $action = "Insert Applicant";
                $action_details = "Inserted a new applicant: " . json_encode($data);

                logActivity($user_id, $username, $action, $action_details);
            }

            // Set a session message and redirect
            $_SESSION['message'] = 'Applicant inserted successfully';
            header("Location: index.php"); // Redirect to index.php after successful insertion
            exit();
        } else {
            $_SESSION['message'] = 'Error inserting applicant';
        }
    } else {
        $_SESSION['message'] = $error_message;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Applicant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Insert New Applicant!</h1>
    <?php if (isset($_SESSION['message'])): ?>
        <p style="color: red;"><?php echo $_SESSION['message']; ?></p>
    <?php endif; ?>
    <form action="insert.php" method="POST">
        <p>
            <label for="first_name">First Name</label> 
            <input type="text" name="first_name" required>
        </p>
        <p>
            <label for="last_name">Last Name</label> 
            <input type="text" name="last_name" required>
        </p>
        <p>
            <label for="email">Email</label> 
            <input type="email" name="email" required>
        </p>
        <p>
            <label for="gender">Gender</label> 
            <input type="text" name="gender" required>
        </p>
        <p>
            <label for="address">Address</label> 
            <input type="text" name="address" required>
        </p>
        <p>
            <label for="state">State</label> 
            <input type="text" name="state" required>
        </p>
        <p>
            <label for="nationality">Nationality</label> 
            <input type="text" name="nationality" required>
        </p>
        <p>
            <label for="job_title">Job Title</label> 
            <input type="text" name="job_title" required>
        </p>
        <p>
            <label for="qualifications">Qualifications</label> 
            <input type="text" name="qualifications" required>
        </p>
        <p>
            <label for="years_of_experience">Years of Experience</label> 
            <input type="number" name="years_of_experience" min="0" required>
        </p>
        <p>
            <input type="submit" name="insertApplicantBtn" value="Save">
        </p>
    </form>
</body>
</html>
