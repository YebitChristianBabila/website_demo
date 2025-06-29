<?php
// Database connection parameters
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

try {
    // Create connection without database
    $conn = new mysqli($db_host, $db_user, $db_pass);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS mental_health";
    if (!$conn->query($sql)) {
        throw new Exception("Error creating database: " . $conn->error);
    }
    
    // Select the database
    $conn->select_db("mental_health");
    
    // Create admins table
    $sql = "CREATE TABLE IF NOT EXISTS admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('super_admin', 'admin') NOT NULL DEFAULT 'admin',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($sql)) {
        throw new Exception("Error creating admins table: " . $conn->error);
    }
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($sql)) {
        throw new Exception("Error creating users table: " . $conn->error);
    }
    
    // Create user_profiles table
    $sql = "CREATE TABLE IF NOT EXISTS user_profiles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        first_name VARCHAR(50),
        last_name VARCHAR(50),
        phone_number VARCHAR(20),
        date_of_birth DATE,
        gender ENUM('Male', 'Female', 'Other', 'Prefer not to say'),
        address TEXT,
        emergency_contact VARCHAR(100),
        emergency_phone VARCHAR(20),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    if (!$conn->query($sql)) {
        throw new Exception("Error creating user_profiles table: " . $conn->error);
    }
    
    // Create journal_entries table
    $sql = "CREATE TABLE IF NOT EXISTS journal_entries (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255),
        content TEXT NOT NULL,
        mood_rating INT CHECK (mood_rating BETWEEN 1 AND 10),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    if (!$conn->query($sql)) {
        throw new Exception("Error creating journal_entries table: " . $conn->error);
    }
    
    // Create resources table
    $sql = "CREATE TABLE IF NOT EXISTS resources (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        category VARCHAR(50),
        url VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($sql)) {
        throw new Exception("Error creating resources table: " . $conn->error);
    }
    
    // Create appointments table
    $sql = "CREATE TABLE IF NOT EXISTS appointments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        appointment_date DATETIME NOT NULL,
        status ENUM('scheduled', 'completed', 'cancelled') DEFAULT 'scheduled',
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    if (!$conn->query($sql)) {
        throw new Exception("Error creating appointments table: " . $conn->error);
    }
    
    // Create support_groups table
    $sql = "CREATE TABLE IF NOT EXISTS support_groups (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        meeting_schedule VARCHAR(255),
        location VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($sql)) {
        throw new Exception("Error creating support_groups table: " . $conn->error);
    }
    
    // Create group_members table
    $sql = "CREATE TABLE IF NOT EXISTS group_members (
        id INT AUTO_INCREMENT PRIMARY KEY,
        group_id INT NOT NULL,
        user_id INT NOT NULL,
        joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (group_id) REFERENCES support_groups(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    if (!$conn->query($sql)) {
        throw new Exception("Error creating group_members table: " . $conn->error);
    }
    
    // Insert default admin account if it doesn't exist
    $stmt = $conn->prepare("SELECT id FROM admins WHERE username = 'admin'");
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        $admin_password = password_hash('password', PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO admins (username, email, password, role) VALUES (?, ?, ?, ?)");
        $username = 'admin';
        $email = 'admin@mentalhealth.com';
        $role = 'super_admin';
        $stmt->bind_param("ssss", $username, $email, $admin_password, $role);
        
        if (!$stmt->execute()) {
            throw new Exception("Error creating default admin account: " . $stmt->error);
        }
    }
    
    // Insert sample resources
    $stmt = $conn->prepare("SELECT id FROM resources LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        $resources = [
            ['National Suicide Prevention Lifeline', '24/7 support for people in suicidal crisis or emotional distress', 'Emergency', 'https://988lifeline.org/'],
            ['SAMHSA\'s National Helpline', 'Treatment referral and information service for individuals facing mental health or substance use disorders', 'Helpline', 'https://www.samhsa.gov/find-help/national-helpline'],
            ['Mental Health First Aid', 'Learn how to identify, understand and respond to signs of mental illnesses and substance use disorders', 'Education', 'https://www.mentalhealthfirstaid.org/']
        ];
        
        $stmt = $conn->prepare("INSERT INTO resources (title, description, category, url) VALUES (?, ?, ?, ?)");
        
        foreach ($resources as $resource) {
            $stmt->bind_param("ssss", $resource[0], $resource[1], $resource[2], $resource[3]);
            if (!$stmt->execute()) {
                throw new Exception("Error inserting sample resources: " . $stmt->error);
            }
        }
    }
    
    echo "Database and tables created successfully!<br>";
    echo "Default admin account created:<br>";
    echo "Username: admin<br>";
    echo "Password: password<br>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?> 