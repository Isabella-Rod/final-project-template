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
