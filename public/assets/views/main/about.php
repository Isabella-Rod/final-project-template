<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Isabella's Portfolio</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <link rel="stylesheet" href="/assets/styles/homepage.css">
</head>
<body>

<nav class="navbar">
    <ul>
        <li><a href="/home">Home</a></li>
        <li><a href="/about" class="active">About</a></li>
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


    <main class="about">
        <div class="profile-container"> 
            <div class="image-wrapper"> 
                <img src="../assets/images/profile.JPG" alt="Profile Picture" class="profile-image">
            </div>
            <div class="profile-text"> 
                <h1>I'm Isabella.</h1>
                <h2>
                    I'm a Computer Science and Political Science student at Fordham University, based in New York, NY. Passionate about creating thoughtful, user-centered designs, I merge creativity with technical expertise to deliver impactful solutions. I specialize in web development, data analysis, and user-focused projects.
                </h2>
                <p>
                    Whether it's crafting intuitive user interfaces, solving complex problems, or bringing ideas to life, I’m always eager to learn 
                    and grow in my journey as a creative professional.
                </p>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <a href="https://github.com" target="_blank" rel="noopener">Github</a>
        <a href="/cv">CV/Resume</a>
        <a href="https://linkedin.com" target="_blank" rel="noopener">LinkedIn</a>
        <a href="/contact">Message</a>
    </footer>
</body>
</html>
