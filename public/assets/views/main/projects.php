<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Isabella's Portfolio</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="/assets/styles/homepage.css?v=1.0">
</head>
<body>
    <div class="wrapper">
        <div class="main-content">
            <nav class="navbar">
                <ul>
                    <li><a href="/home">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/projects" class="active">Projects</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li><a href="/exclusive-projects">Exclusive Projects</a></li>
                        <li><a href="/logout">Logout</a></li>
                    <?php else: ?>
                        <li><a href="/login">Login/Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <header class="projects-header">
                <h1>My Projects</h1>
            </header>
            <main class="projects-main">
                <section class="projects-section">
                    <h2>My Work</h2>
                    <div class="project-grid" id="project-grid"></div>
                </section>
            </main>
        </div>
        <footer class="site-footer">
            <a href="https://github.com" target="_blank" rel="noopener">Github</a>
            <a href="/cv">CV/Resume</a>
            <a href="https://linkedin.com" target="_blank" rel="noopener">LinkedIn</a>
            <a href="/contact">Message</a>
        </footer>
    </div>
    <script>
        async function loadProjects() {
            try {
                const response = await fetch('/api/projects');
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

                const projects = await response.json();

                const projectsGrid = document.getElementById('project-grid');
                if (!projectsGrid) {
                    console.error('Error: projects-grid element not found.');
                    return;
                }

                projects.forEach(project => {
                    const projectDiv = document.createElement('div');
                    projectDiv.classList.add('project');
                    projectDiv.innerHTML = `
                        <h3>${project.title}</h3>
                        <p>${project.description}</p>
                        <p><strong>Technologies:</strong> ${project.technologies}</p>
                        <a href="${project.link}" target="_blank">View Project</a>
                    `;
                    projectsGrid.appendChild(projectDiv);
                });
            } catch (error) {
                console.error('Error fetching projects:', error);
                const projectsGrid = document.getElementById('project-grid');
                if (projectsGrid) {
                    projectsGrid.innerHTML = "<p>Error loading projects. Please try again later.</p>";
                }
            }
        }

        document.addEventListener('DOMContentLoaded', loadProjects);
    </script>
</body>
</html>
