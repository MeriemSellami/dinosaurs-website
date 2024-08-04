<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csv_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = $_GET["name"];
    $email = $_GET["email"];
    $message = $_GET["message"];
    $stmt = $conn->prepare("INSERT INTO info (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    $stmt->close();
}
echo "your message have been sumitted successfully you can go back to the home page from <a href='index.html'>here</a>";
$conn->close();
?>