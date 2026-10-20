CREATE DATABASE IF NOT EXISTS clinicdb;
USE clinicdb;

CREATE TABLE IF NOT EXISTS users (
    userid INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL   -- 255 needed for hashed passwords
);

CREATE TABLE IF NOT EXISTS patients (
    PatientID INT AUTO_INCREMENT PRIMARY KEY,
    Names VARCHAR(150) NOT NULL,
    Address VARCHAR(200),
    Phone VARCHAR(30),
    Age INT
);

-- New: appointments (deleting a patient also deletes their appointments)
CREATE TABLE IF NOT EXISTS appointments (
    AppointmentID INT AUTO_INCREMENT PRIMARY KEY,
    PatientID INT NOT NULL,
    AppointmentDate DATETIME NOT NULL,
    Reason VARCHAR(255),
    FOREIGN KEY (PatientID) REFERENCES patients(PatientID) ON DELETE CASCADE
);
