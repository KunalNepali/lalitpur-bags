CREATE DATABASE lalitpur_bags;

USE lalitpur_bags;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE repair_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    bag_type VARCHAR(50),
    issue_type VARCHAR(50),
    image_path VARCHAR(255),
    calendar_date DATE,
    location VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    item VARCHAR(100),
    quantity INT,
    total_price DECIMAL(10, 2),
    status VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE purchase_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    item VARCHAR(100),
    amount DECIMAL(10, 2),
    purchased_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

