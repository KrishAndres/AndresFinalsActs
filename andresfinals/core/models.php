<?php
require_once 'dbConfig.php';

function logActivity($user_id, $username, $action, $action_details)
{
    global $pdo; 

    if ($user_id == 0) {
        $user_id = NULL;  
    }
    $query = "INSERT INTO activity_logs (user_id, username, action, action_details) 
              VALUES (:user_id, :username, :action, :action_details)";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT); 
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':action', $action);
    $stmt->bindParam(':action_details', $action_details);

    $stmt->execute();
}
function getAllApplicant($pdo) {
    $sql = "SELECT * FROM applicant ORDER BY first_name ASC";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getApplicantByID($pdo, $id) {
    $sql = "SELECT * FROM applicant WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$id]);
    
    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function searchForAApplicant($pdo, $searchQuery) {
    $sql = "SELECT * FROM applicant WHERE 
            CONCAT(first_name, last_name, email, gender, 
                   address, state, nationality, job_title, 
                   qualifications, years_of_experience, date_added) 
            LIKE ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute(["%" . $searchQuery . "%"]);
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

// Insert a new applicant
function insertNewApplicant($pdo, $data) {
    $sql = "INSERT INTO applicant 
            (
                first_name,
                last_name,
                email,
                gender,
                address,
                state,
                nationality,
                job_title,
                qualifications,
                years_of_experience
            )
            VALUES (?,?,?,?,?,?,?,?,?,?)";

    // Check if $data is an array and pass it correctly to execute
    if (is_array($data)) {
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['gender'],
            $data['address'],
            $data['state'],
            $data['nationality'],
            $data['job_title'],
            $data['qualifications'],
            $data['years_of_experience']
        ]);

        return $executeQuery;
    } else {
        return false;
    }
}
    



// Edit an existing applicant's details
function editApplicant($pdo, $first_name, $last_name, $email, $gender, 
    $address, $state, $nationality, $job_title, 
    $qualifications, $years_of_experience, $id) {

    $sql = "UPDATE applicant
            SET first_name = ?,
                last_name = ?,
                email = ?,
                gender = ?,
                address = ?,
                state = ?,
                nationality = ?,
                job_title = ?,
                qualifications = ?,
                years_of_experience = ?
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([
        $first_name, $last_name, $email, $gender, 
        $address, $state, $nationality, $job_title, 
        $qualifications, $years_of_experience, $id
    ]);

    if ($executeQuery) {
        return true;
    }
    return false;
}

// Delete an applicant by ID
function deleteApplicant($pdo, $id) {
    $sql = "DELETE FROM applicant WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$id]);
    
    if ($executeQuery) {
        return true;
    }
    return false;
}



?>


