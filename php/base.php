<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csv_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dinoName = isset($_POST['dinoName']) ? $_POST['dinoName'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action == 'search') {
    $stmt = $conn->prepare("SELECT * FROM dinosaur WHERE name = ?");
    $stmt->bind_param("s", $dinoName);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $rows = [];
    }
    $stmt->close();
} elseif ($action == 'delete') {
    $stmt = $conn->prepare("DELETE FROM dinosaur WHERE name = ?");
    $stmt->bind_param("s", $dinoName);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Biggest Dinosaurs' DataBase</title>
</head>
<link rel="stylesheet" type="text/css" href="styledata.css">
<body>
<div class="container">
<header>
            <nav>
                <a href="index.html">Home</a>
                <a href="about.html">About</a>
                <a href="info.html">Info</a>
                <a href="data.html">DATA</a>
            </nav>
        </header>
<h1>Biggest Dinosaurs' DataBase</h1>
<form id="dinoForm" action="base.php" method="post">
    <label for="dinoName">Dinosaur Name:</label><br>
    <input type="text" id="dinoName" name="dinoName"><br>
    <label for="action">Action:</label><br>
    <select class="items" id="action" name="action">
        <option value="search">Search</option>
        <option value="delete">Delete</option>
    </select><br>
    <input class="items" type="submit" value="Submit">
</form>
<div class="resultat" id="results">
    <?php
    if ($action == 'search') {
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                echo "<table>";
                foreach ($row as $key => $column) {
                    echo "<tr><th>$key</th><td>$column</td></tr>";
                }
                echo "</table><br>";
            }
        } else {
            echo "0 results";
        }
    }
    if ($action == 'delete') {
        echo "Record deleted successfully";
    }
    ?>
</div>
</div>
</body>
</html>