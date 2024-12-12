<?php  
session_start();
require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['insertNewUserBtn'])) {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Check if the username already exists
        $query = "SELECT * FROM user_accounts WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            $error_message = "Username already taken.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $insert_query = "INSERT INTO user_accounts (username, first_name, last_name, password) 
                             VALUES (:username, :first_name, :last_name, :password)";
            $insert_stmt = $pdo->prepare($insert_query);
            $insert_stmt->bindParam(':username', $username);
            $insert_stmt->bindParam(':first_name', $first_name);
            $insert_stmt->bindParam(':last_name', $last_name);
            $insert_stmt->bindParam(':password', $hashed_password);
            $insert_stmt->execute();

            // Redirect to login page after successful registration
            header("Location: login.php?message=Registration successful, please login.");
            exit();
        }
    }
}

    if (isset($_POST['loginBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $query = "SELECT * FROM user_accounts WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // If credentials are correct, start the session and store user data
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];

        // Redirect to the main page (index.php)
        header("Location: index.php");
        exit();
    } else {
        // If login fails, set an error message
        $login_error = "Invalid username or password.";
    }
}

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
