<?php
require_once 'dbConfig.php';

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
function insertNewApplicant($pdo, $first_name, $last_name, $email, 
    $gender, $address, $state, $nationality, $job_title, 
    $qualifications, $years_of_experience) {

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

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([
        $first_name, $last_name, $email, 
        $gender, $address, $state, 
        $nationality, $job_title, 
        $qualifications, $years_of_experience
    ]);

    if ($executeQuery) {
        return true;
    }
    return false;
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
