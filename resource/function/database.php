<?php
// connection database
try {
    $db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("FATAL ERROR: " . $e->getMessage());
}

// create database function
function createdb() {
    global $db;
    $sql1 = "CREATE TABLE IF NOT EXISTS project(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    deskrip VARCHAR(255) NOT NULL,
    github VARCHAR(255) NOT NULL,
    demo VARCHAR(255) NOT NULL,
    statuspo ENUM('complated','ongoing') NOT NULL default 'ongoing',
    uploadat TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

    $sql2 = "CREATE TABLE IF NOT EXISTS image(
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    path_image VARCHAR(255),
    createat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(project_id) REFERENCES project(id))";

    $sql3 = "CREATE TABLE IF NOT EXISTS tag(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tag VARCHAR(50) NOT NULL,
    color VARCHAR(10),
    project_id INT NOT NULL,
    createat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(project_id) REFERENCES project(id))";
    
    try {
        $db->exec($sql1);
        $db->exec($sql2);
        $db->exec($sql3);
    } catch(PDOException $e) {
        die("Database creation error: " . $e->getMessage());
    }
}
createdb();