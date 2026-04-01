<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $p_no = $_POST["p_no"];
    $email_sub = $_POST["email_sub"];
    $message = $_POST["message"];

    // Database connection details
    $localhost = "localhost"; // Change this to your database host
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $database = "portfolio"; // Change this to your database name

    // Create a database connection
    $conn = new mysqli($localhost, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert data into the table
    $sql = "INSERT INTO contact_form (NAME, EMAIL, PHONENO, EMAILSUB, MESSAGE) VALUES ($name,$email,$p_no,$email_sub,$message)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $p_no, $email_sub, $message);
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the form or a thank-you page
    header("Location: thank_you_page.html");
    exit();
}
?>
