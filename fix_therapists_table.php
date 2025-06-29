<?php
require_once 'config/database.php';

try {
    // Check if column exists
    $check = $pdo->query("SHOW COLUMNS FROM therapists LIKE 'image_path'");
    if ($check->rowCount() == 0) {
        // Add image_path column if it doesn't exist
        $sql = "ALTER TABLE therapists ADD COLUMN image_path VARCHAR(255) AFTER bio";
        $pdo->exec($sql);
        echo "Successfully added image_path column to therapists table.";
    } else {
        echo "Column image_path already exists.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 