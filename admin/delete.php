<?php
$id = $_POST["id"] ?? null;

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=moodhousedb', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare("delete from films where id = :id ");
$statement->bindValue(":id", $id);
$statement->execute();

if (!$id) {
    header("LOCATION: /admin");
    exit;
}

header("LOCATION: /admin");
