<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /login?error=Please%20log%20in%20to%20access%20Exclusive%20Projects');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusive Projects - Isabella's Portfolio</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <link rel="stylesheet" href="/assets/styles/homepage.css?v=1.0">
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/projects">Projects</a></li>
            <li><a href="/contact">Contact</a></li>
            <li><a href="/login">Login/Register</a></li>
            <li><a href="/exclusive-projects" class="active">Exclusive Projects</a></li>
            <li><a href="/logout">Logout</a></li>
        </ul>
    </nav>

    <main>
        <header class="projects-header">
            <h1>Exclusive Projects</h1>
        </header>
        <section class="projects-main">
            <div class="project-grid">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        <div class="project">
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p><?php echo htmlspecialchars($project['description']); ?></p>
                            <p><strong>Technologies:</strong> <?php echo htmlspecialchars($project['technologies']); ?></p>
                            <a href="<?php echo htmlspecialchars($project['link']); ?>" target="_blank">View Project</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No exclusive projects available at this time. Check back later!</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <a href="https://github.com" target="_blank" rel="noopener">Github</a>
        <a href="/cv">CV/Resume</a>
        <a href="https://linkedin.com" target="_blank" rel="noopener">LinkedIn</a>
        <a href="/contact">Message</a>
    </footer>
</body>
</html>
