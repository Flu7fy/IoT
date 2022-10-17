<?php
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['nimi'];
$viesti = $_POST['viesti'];

$stmt = $conn->prepare(' INSERT INTO keskustelu (nimi, viesti) VALUES (?, ?)');
$stmt->bind_param('ss', $name, $viesti);

$stmt->execute();

$conn->close();

header("Location: keskustelu.php");
die();
?>