<?php
require_once 'config.php';

// Create memes table
$create_memes_table = "CREATE TABLE IF NOT EXISTS `memes` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `image_path` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `likes` INT DEFAULT 0,
    `created_by` INT,
    FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Create meme_likes table
$create_meme_likes_table = "CREATE TABLE IF NOT EXISTS `meme_likes` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `meme_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`meme_id`) REFERENCES `memes`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `unique_meme_like` (`meme_id`, `user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Execute the queries
if ($conn->query($create_memes_table)) {
    echo "Memes table created successfully!<br>";
} else {
    echo "Error creating memes table: " . $conn->error . "<br>";
}

if ($conn->query($create_meme_likes_table)) {
    echo "Meme likes table created successfully!<br>";
} else {
    echo "Error creating meme likes table: " . $conn->error . "<br>";
}

$conn->close();
?> 