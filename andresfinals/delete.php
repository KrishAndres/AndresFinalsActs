<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

if (isset($_GET['id'])) 
    $id = htmlspecialchars($_GET['id']); // Sanitize the ID for security

    // Fetch applicant details from the database
    $query = $pdo->prepare("SELECT * FROM applicant WHERE id = :id");
    $query->execute(['id' => $id]);
    $applicant = $query->fetch(PDO::FETCH_ASSOC);

    // If the user has confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {

        // First, delete related activity logs if needed
        $deleteLogsQuery = "DELETE FROM activity_logs WHERE log_id = :id";
        $deleteLogsStmt = $pdo->prepare($deleteLogsQuery);
        $deleteLogsStmt->bindParam(':id', $id);
        $deleteLogsStmt->execute();

        // Now delete the applicant
        $deleteApplicantQuery = "DELETE FROM applicant WHERE id = :id";
        $deleteApplicantStmt = $pdo->prepare($deleteApplicantQuery);
        $deleteApplicantStmt->bindParam(':id', $id);

        if ($deleteApplicantStmt->execute()) {
            // Log the activity of the deletion
            logActivity($_SESSION['user_id'], $_SESSION['username'], 'delete', 'Deleted applicant with ID: ' . $id);

            // Set a success message
            $_SESSION['message'] = "Applicant deleted successfully.";

            // Redirect to the main page
            header('Location: index.php');
            exit();
        } else {
            // Set an error message
            $_SESSION['message'] = "Error deleting applicant.";
            header('Location: index.php');
            exit();
        }
    }

        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Applicant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Are you sure you want to delete this applicant?</h1>
    <?php 
    $getApplicantByID = getApplicantByID($pdo, $_GET['id']);?>

    <!-- Applicant Details Display -->
    <div class="container" style="border-style: solid; border-color: red; background-color: #ffcbd1; height: 800px;">
        <h2>First Name: <?php echo  $getApplicantByID['first_name']; ?></h2>
        <h2>Last Name: <?php echo  $getApplicantByID['last_name']; ?></h2>
        <h2>Email: <?php echo  $getApplicantByID['email']; ?></h2>
        <h2>Gender: <?php echo  $getApplicantByID['gender']; ?></h2>
        <h2>Address: <?php echo  $getApplicantByID['address']; ?></h2>
        <h2>State: <?php echo  $getApplicantByID['state']; ?></h2>
        <h2>Nationality: <?php echo  $getApplicantByID['nationality']; ?></h2>
        <h2>Job Title: <?php echo  $getApplicantByID['job_title']; ?></h2>
        <h2>Qualifications: <?php echo  $getApplicantByID['qualifications']; ?></h2>
        <h2>Years of Experience: <?php echo  $getApplicantByID['years_of_experience']; ?></h2>

        <!-- Confirm Deletion -->
        <div class="deleteBtn" style="float: right; margin-right: 10px;">
            <form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <input type="submit" name="deleteApplicantBtn" value="Delete" style="background-color: #f69697; border-style: solid;">
            </form>
        </div>
    </div>

</body>
</html>
