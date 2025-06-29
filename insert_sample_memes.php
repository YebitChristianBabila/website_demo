<?php
require_once 'config.php';

// First, ensure we have an admin user
$admin_check = $conn->query("SELECT id FROM admins LIMIT 1");
if ($admin_check->num_rows === 0) {
    // Create an admin user if none exists
    $admin_username = 'admin';
    $admin_email = 'admin@example.com';
    $admin_password = password_hash('admin123', PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO admins (username, email, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt->bind_param("sss", $admin_username, $admin_email, $admin_password);
    $stmt->execute();
    $admin_id = $conn->insert_id;
} else {
    $admin_id = $admin_check->fetch_assoc()['id'];
}

// Sample memes data
$sample_memes = [
    [
        'title' => 'Monday Motivation',
        'description' => 'When you realize it\'s Monday morning',
        'image_path' => 'uploads/memes/monday_motivation.jpg'
    ],
    [
        'title' => 'Coding Life',
        'description' => 'Debugging be like...',
        'image_path' => 'uploads/memes/coding_life.jpg'
    ],
    [
        'title' => 'Workout Goals',
        'description' => 'Me vs. My workout goals',
        'image_path' => 'uploads/memes/workout_goals.jpg'
    ]
];

// Create uploads/memes directory if it doesn't exist
if (!file_exists('uploads/memes')) {
    mkdir('uploads/memes', 0777, true);
}

// Insert sample memes
foreach ($sample_memes as $meme) {
    $stmt = $conn->prepare("INSERT INTO memes (title, description, image_path, created_by) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $meme['title'], $meme['description'], $meme['image_path'], $admin_id);
    $stmt->execute();
}

echo "Sample memes have been added successfully!";
?> 