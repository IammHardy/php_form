<?php
// Database connection settings
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "form_db";        

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = htmlspecialchars($_POST['Username']);
    $pass = htmlspecialchars($_POST['Password']);
    
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    
   
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    
   
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $hashed_password);  // "ss" means two strings (username, password)
    
    // Execute the query
    if ($stmt->execute()) {
        echo "Data successfully inserted into the database.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
