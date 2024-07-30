<?php
session_start();
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "therapy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// add appointment
if (isset($_POST['add'])) {
    $patientname = $_POST['patientName'];
    $date = $_POST['appointmentDate'];
    $time = $_POST['appointmentTime'];

    $sql = "INSERT INTO appointment (patient, datee, timee) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $patientname, $date, $time);

    if ($stmt->execute()) {
        header('Location: \hackathon-week-1\p_dashboard');
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
// delete appointment
if (isset($_POST['delete'])) {
    $appointment_id = $_POST['id'];

    $sql = "DELETE FROM appointment WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $appointment_id);

    if ($stmt->execute()) {
        header('Location: \hackathon-week-1\p_dashboard');
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
// delete appointment
if (isset($_POST['done'])) {
    $appointment_id = $_POST['id'];

    $sql = "UPDATE appointment SET done = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $appointment_id);

    if ($stmt->execute()) {
        header('Location: \hackathon-week-1\p_dashboard');
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}