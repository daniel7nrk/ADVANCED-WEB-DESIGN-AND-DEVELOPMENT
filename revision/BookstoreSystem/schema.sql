-- -- Run this in phpMyAdmin (SQL tab) or the MySQL console
-- CREATE DATABASE IF NOT EXISTS BOOKSTOREDB;
-- USE BOOKSTOREDB;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,          -- stores a password_hash() value, never plain text
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    author VARCHAR(100) NOT NULL,
    category VARCHAR(60) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL DEFAULT 0
);

-- Sample user: username "admin", password "admin123" (bcrypt hash)
INSERT INTO users (username, password) VALUES
('admin', '$2y$10$Y24m1GCO7bhtJJ/XGmCLHO1nwCbzCumUstILtKRstfKXrJp5yLkiu');

INSERT INTO books (title, author, category, price, quantity) VALUES
('Things Fall Apart', 'Chinua Achebe', 'Fiction', 12.50, 20),
('Clean Code', 'Robert C. Martin', 'Programming', 35.00, 8);
