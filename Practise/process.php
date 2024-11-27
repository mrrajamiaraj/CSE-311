<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Default username for local setup
$password = "";     // Default password for local setup
$database = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full-name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Ideally, hash this before storing
    $gender = $_POST['gender'];
    $country = $_POST['options'];
    $interests = isset($_POST['interests']) ? implode(", ", $_POST['interests']) : ""; // Convert array to string
    $comments = $_POST['comments'];

    // Prepare an SQL query
    $sql = "INSERT INTO users (full_name, email, password, gender, country, interests, comments) 
            VALUES ('$full_name', '$email', '$password', '$gender', '$country', '$interests', '$comments')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
