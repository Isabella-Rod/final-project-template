CREATE DATABASE portfolio;

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    technologies VARCHAR(255),
    link VARCHAR(255),
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO projects (title, description, technologies, link, image) VALUES
('Portfolio Website', 'A responsive portfolio showcasing my work.', 'HTML, CSS, JavaScript', 'https://example.com', 'portfolio.jpg'),
('Sorting Algorithms', 'Implemented and visualized sorting algorithms.', 'Python, Matplotlib', 'https://example.com/sorting', 'sorting.jpg');

CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE private_projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    technologies VARCHAR(255),
    link VARCHAR(255)
);

INSERT INTO private_projects (title, description, technologies, link) VALUES
('AI-Powered Personal Finance Tracker', 'An AI-based application to track expenses and generate financial insights.', 'Python, Flask, TensorFlow, SQLite', 'https://example.com/private-finance'),
('Encrypted File Sharing Platform', 'A secure platform for sharing files with end-to-end encryption.', 'Node.js, Express, MongoDB, AES Encryption', 'https://example.com/private-files'),
('Personalized Learning System', 'A learning management system that adapts to the user’s learning style.', 'PHP, Laravel, MySQL, JavaScript', 'https://example.com/private-learning'),
('Custom Portfolio Generator', 'A generator that allows users to build their own customizable portfolio websites.', 'React, Redux, Node.js, PostgreSQL', 'https://example.com/private-portfolio'),
('Data Analytics Dashboard', 'A private dashboard to visualize company sales and operational data.', 'Python, Django, Matplotlib, PostgreSQL', 'https://example.com/private-dashboard');
