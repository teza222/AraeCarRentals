<?php

require_once __DIR__ . '/../core/database.php';

$database = new Database();
$conn = $database->connect();

if ($conn) {
    echo "AREA CAR RENTAL database connected successfully!";
}