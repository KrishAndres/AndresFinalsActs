<?php 
session_start();
require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; 


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['searchBtn'])) {
    $search_input = $_GET['searchInput'];

    // Retrieve logged-in user details from the session
    $user_id = $_SESSION['user_id'] ?? 0;
    $username = $_SESSION['username'] ?? 'Guest';

    $searchResult = searchForAApplicant($pdo, $search_input);
    $applicants = $searchResult['querySet'] ?? [];
    $message = $searchResult['message'] ?? 'Applicants loaded successfully.';
    $searchSuccessMessage = !empty($applicants) ? "Search completed successfully! Found " . count($applicants) . " result(s)." : "No applicants found matching your search.";

    // Log the search action with the search keyword
    logActivity($user_id, $username, 'search', "Searched for keyword: $search_input");
} else {
    $allApplicants = getAllApplicant($pdo);
    $applicants = $allApplicants['querySet'] ?? []; 
    $message = $allApplicants['message'] ?? 'Applicants loaded successfully.';
}


    // Fetch activity logs for display
    $query = "SELECT * FROM activity_logs ORDER BY action_timestamp DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        
        <header>Welcome, <?= htmlspecialchars($_SESSION['first_name']); ?>!</header>

        <!-- Success Message -->
        <?php if (isset($_SESSION['message'])): ?>
            <p class="message success"><?= htmlspecialchars($_SESSION['message']); ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <!-- Search Bar -->
        <h1>List of Applicant</h1>
        <form action="index.php" method="GET">
            <input type="text" name="searchInput" placeholder="Search for applicants" value="<?= htmlspecialchars($_GET['searchInput'] ?? '') ?>">
            <input type="submit" name="searchBtn" value="Search">
        </form>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a class="btn clear-search" href="index.php">Clear Search</a>
            <a class="btn insert-applicant" href="insert.php">Insert New Applicant</a>
            <a class="btn logout" href="logout.php">Logout</a>
        </div>

        <!-- Applicant Table -->
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>State</th>
                    <th>Nationality</th>
                    <th>Job Title</th>
                    <th>Qualifications</th>
                    <th>Years of Experience</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
                <?php if (!isset($_GET['searchBtn'])) { ?>
            <?php $getAllApplicant = getAllApplicant($pdo); ?>
                   <?php foreach ($getAllApplicant as $row) { ?>
                    <tr>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['state']; ?></td>
                        <td><?php echo $row['nationality']; ?></td>
                        <td><?php echo $row['job_title']; ?></td>
                        <td><?php echo $row['qualifications']; ?></td>
                        <td><?php echo $row['years_of_experience']; ?></td>
                        <td><?php echo $row['date_added']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
        <?php } else { ?>
            <?php $searchForAApplicant = searchForAApplicant($pdo, $_GET['searchInput']); ?>
                    <?php foreach ($searchForAApplicant as $row) { ?>
                    <tr>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['state']; ?></td>
                        <td><?php echo $row['nationality']; ?></td>
                        <td><?php echo $row['job_title']; ?></td>
                        <td><?php echo $row['qualifications']; ?></td>
                        <td><?php echo $row['years_of_experience']; ?></td>
                        <td><?php echo $row['date_added']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
        <?php } ?>
            </thead>
            <tbody>
                <?php if (!empty($applicants)) {
                    foreach ($applicants as $applicant) { ?>
                        <tr>
                            <td><?= htmlspecialchars($applicant['first_name']); ?></td>
                            <td><?= htmlspecialchars($applicant['last_name']); ?></td>
                            <td><?= htmlspecialchars($applicant['email']); ?></td>
                            <td><?= htmlspecialchars($applicant['gender']); ?></td>
                            <td><?= htmlspecialchars($applicant['address']); ?></td>
                            <td><?= htmlspecialchars($applicant['state']); ?></td>
                            <td><?= htmlspecialchars($applicant['nationality']); ?></td>
                            <td><?= htmlspecialchars($applicant['job_title']); ?></td>
                            <td><?= htmlspecialchars($applicant['qualifications']); ?></td>
                            <td><?= htmlspecialchars($applicant['years_of_experience']); ?></td>
                            <td><?= htmlspecialchars($applicant['date_added']); ?></td>
                            <td>
                                <a href="edit.php?id=<?= htmlspecialchars($applicant['id']); ?>">Edit</a>
                                <a href="delete.php?id=<?= htmlspecialchars($applicant['id']); ?>" onclick="return confirm('Are you sure you want to delete this applicant?');">Delete</a>
                            </td>
                        </tr>
                    <?php }
                } else {
                } ?>
            </tbody>
        </table>
      
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Job Applications</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>Admin Dashboard</header>

        <h2>Activity Log</h2>
        <table class="activity-log-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Action</th>
                    <th>Details</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log) : ?>
                    <tr>
                        <td><?= htmlspecialchars($log['username']); ?></td>
                        <td><?= htmlspecialchars($log['action']); ?></td>
                        <td><?= htmlspecialchars($log['action_details']); ?></td>
                        <td><?= htmlspecialchars($log['action_timestamp']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container">

        <!-- Display Success Message -->
        <?php if (isset($_SESSION['message'])): ?>
            <p class="message success"><?php echo $_SESSION['message']; ?></p>
            <?php unset($_SESSION['message']); // Clear the message after displaying it ?>
        <?php endif; ?>
