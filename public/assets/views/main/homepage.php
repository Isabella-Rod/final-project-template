<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Isabella's Portfolio</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <link rel="stylesheet" href="/assets/styles/homepage.css">
</head>
<body>
    <div class="wrapper">
        <main class="main-content">
            <header class="home">
                <nav class="navbar"> 
                    <ul>
                        <li><a href="/home" class="active">Home</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/projects">Projects</a></li>
                        <li><a href="/contact">Contact</a></li>
                        <?php if (isset($_SESSION['user'])): ?>
                            <li><a href="/exclusive-projects">Exclusive Projects</a></li>
                            <li><a href="/logout">Logout</a></li>
                        <?php else: ?>
                            <li><a href="/login">Login/Register</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <div class="home-content"> 
                    <h1> Hi. I'm Isabella. <br> A Computer Science Student. </h1>
                </div>
            </header>
        </main>
        <footer class="site-footer">
            <a href="https://github.com" target="_blank" rel="noopener">Github</a>
            <a href="/cv">CV/Resume</a>
            <a href="https://linkedin.com" target="_blank" rel="noopener">LinkedIn</a>
            <a href="/contact">Message</a>
        </footer>
    </div>
</body>
</html>
