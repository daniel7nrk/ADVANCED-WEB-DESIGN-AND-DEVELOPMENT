
-- mysql -u root

-- CREATE DATABASE school_dbs;
USE school_dbs;
CREATE TABLE students (
    Reg_No    VARCHAR(20)  NOT NULL PRIMARY KEY,
    Full_Name VARCHAR(100) NOT NULL,
    Email     VARCHAR(100) NOT NULL,
    Gender    VARCHAR(10)  NOT NULL,
    Course    VARCHAR(100) NOT NULL,
    Telephone VARCHAR(20)  NOT NULL
);

INSERT INTO students (Reg_No, Full_Name, Email, Gender, Course, Telephone) VALUES
('ST001', 'Jane Doe',   'jane@example.com', 'Female', 'ICT',                '0789123456'),
('ST002', 'John Smith', 'john@example.com', 'Male',   'Health Informatics', '0789345678'),
('ST003', 'M. Jm',      'jmvs@example.com', 'Male',   'Database',           '0789345655');