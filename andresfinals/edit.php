<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; 


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve logged-in user details from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Initialize $applicant and $applicant_id
$applicant = null;
$applicant_id = null;

// Handle GET request to fetch applicant details
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $applicant_id = $_GET['id'];

    // Fetch the applicant details from the database
    $query = "SELECT * FROM applicant WHERE id = :applicant_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':applicant_id', $applicant_id, PDO::PARAM_INT);
    $stmt->execute();
    $applicant = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$applicant) {
        echo "Invalid applicant ID.";
        exit();
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Applicant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php 
    // Fetch applicant data by ID
    $getApplicantByID = getApplicantByID($pdo, $_GET['id']);
    
    if (!$getApplicantByID) {
        echo "<p style='color: red;'>Applicant not found. Please check the ID and try again.</p>";
        exit;
    }
    ?>

    <h1>Edit Applicant Details</h1>
    
    <form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <p>
            <label for="firstName">First Name</label> 
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($getApplicantByID['first_name']); ?>" required>
        </p>
        
        <p>
            <label for="lastName">Last Name</label> 
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($getApplicantByID['last_name']); ?>" required>
        </p>
        
        <p>
            <label for="email">Email</label> 
            <input type="email" name="email" value="<?php echo htmlspecialchars($getApplicantByID['email']); ?>" required>
        </p>
        
        <p>
            <label for="gender">Gender</label> 
            <input type="text" name="gender" value="<?php echo htmlspecialchars($getApplicantByID['gender']); ?>" required>
        </p>
        
        <p>
            <label for="address">Address</label> 
            <input type="text" name="address" value="<?php echo htmlspecialchars($getApplicantByID['address']); ?>" required>
        </p>
        
        <p>
            <label for="state">State</label> 
            <input type="text" name="state" value="<?php echo htmlspecialchars($getApplicantByID['state']); ?>" required>
        </p>
        
        <p>
            <label for="nationality">Nationality</label> 
            <input type="text" name="nationality" value="<?php echo htmlspecialchars($getApplicantByID['nationality']); ?>" required>
        </p>
        
        <p>
            <label for="jobTitle">Job Title</label> 
            <input type="text" name="job_title" value="<?php echo htmlspecialchars($getApplicantByID['job_title']); ?>" required>
        </p>
        
        <p>
            <label for="qualifications">Qualifications</label> 
            <input type="text" name="qualifications" value="<?php echo htmlspecialchars($getApplicantByID['qualifications']); ?>" required>
        </p>
        
        <p>
            <label for="yearsOfExperience">Years of Experience</label> 
            <input type="number" name="years_of_experience" value="<?php echo htmlspecialchars($getApplicantByID['years_of_experience']); ?>" required>
        </p>
        
        <p>
            <input type="submit" value="Save Changes" name="editApplicantBtn">
        </p>
    </form>
</body>
</html>
