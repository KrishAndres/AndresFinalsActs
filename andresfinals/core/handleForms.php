<?php  

require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertApplicantBtn'])) {
    $insertApplicant = insertNewApplicant(
        $pdo,
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['gender'],
        $_POST['address'],
        $_POST['state'],
        $_POST['nationality'],
        $_POST['job_title'],
        $_POST['qualifications'],
        $_POST['years_of_experience']
    );

    if ($insertApplicant) {
        $_SESSION['message'] = "Successfully inserted!";
        header("Location: ../index.php");
    }
}

if (isset($_POST['editApplicantBtn'])) {
    $editApplicant = editApplicant(
        $pdo,
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['gender'],
        $_POST['address'],
        $_POST['state'],
        $_POST['nationality'],
        $_POST['job_title'],
        $_POST['qualifications'],
        $_POST['years_of_experience'],
        $_GET['id']
    );

    if ($editApplicant) {
        $_SESSION['message'] = "Successfully edited!";
        header("Location: ../index.php");
    }
}

if (isset($_POST['deleteApplicantBtn'])) {
    $deleteApplicant = deleteApplicant($pdo, $_GET['id']);

    if ($deleteApplicant) {
        $_SESSION['message'] = "Successfully deleted!";
        header("Location: ../index.php");
    }
}

if (isset($_GET['searchBtn'])) {
    $searchForAApplicant = searchForAApplicant($pdo, $_GET['searchInput']);
    foreach ($searchForAApplicant as $row) {
        echo "<tr> 
                <td>{$row['id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['address']}</td>
                <td>{$row['state']}</td>
                <td>{$row['nationality']}</td>
                <td>{$row['job_title']}</td>
                <td>{$row['qualifications']}</td>
                <td>{$row['years_of_experience']}</td>
              </tr>";
    }
}

?>
