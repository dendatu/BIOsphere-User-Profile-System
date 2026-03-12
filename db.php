<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    /* CONNECT TO MYSQL SERVER */
    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    /* CREATE DATABASE IF NOT EXISTS */
    $sql = "CREATE DATABASE IF NOT EXISTS user_system";
    $conn->query($sql);

    /* SELECT DATABASE */
    $conn->select_db("user_system");

    /* CREATE USERS TABLE IF NOT EXISTS */
    $table = "CREATE TABLE IF NOT EXISTS users(
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE,
        password VARCHAR(255),
        full_name VARCHAR(100),
        skills VARCHAR(255),
        profile_pic VARCHAR(255)
    )";

    $conn->query($table);
?>