<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Isabella's Portfolio</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <link rel="stylesheet" href="/assets/styles/homepage.css">
    <script defer src="/assets/js/chat.js"></script>
    <script defer src="/assets/js/form.js"></script>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/projects">Projects</a></li>
            <li><a href="/contact" class="active">Contact</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="/exclusive-projects">Exclusive Projects</a></li>
                <li><a href="/logout">Logout</a></li>
            <?php else: ?>
                <li><a href="/login">Login/Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main class="contact">
        <h2>Get in Touch</h2>
        <p>
            I’d love to hear from you! Whether you have a project in mind, a question, or just want to say hello, feel free to reach out using the form below.
        </p>
        <form id="contact-form" action="/submit-contact" method="POST">
            <input type="text" name="name" id="name" placeholder="Your Name" required>
            <input type="email" name="email" id="email" placeholder="Your Email" required>
            <textarea name="message" id="message" placeholder="Your Message" rows="5" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </main>

    <div class="chat-widget">
        <header class="chat-header">
            <div class="chat-avatar">
                <img src="../assets/images/profile.JPG" alt="Isabella Bot Avatar" />
            </div>
            <div class="chat-info">
                <h3>Isabella Bot</h3>
                <p>Ask me a question</p>
            </div>
        </header>
        <div class="chat-messages" id="chat-history">
            <div class="chat-bubble bot">Hi!</div>
            <div class="chat-bubble bot">
                I'm Isabella Bot. I'm here to help you with any questions you might have about Isabella's work.
            </div>
            <div class="chat-bubble bot">How can I help you today?</div>
            <div class="chat-options">
                <button class="chat-option">Looking for Isabella's old portfolio</button>
                <button class="chat-option">Just saying hello!</button>
                <button class="chat-option">Interested in mentorship</button>
                <button class="chat-option">We'd like to hire you</button>
            </div>
        </div>
        <div class="chat-input">
            <textarea id="chat-input" placeholder="Type your message here..."></textarea>
            <button id="chat-submit">Send</button>
        </div>
    </div>
    
    <footer class="site-footer">
        <a href="https://github.com" target="_blank" rel="noopener">Github</a>
        <a href="/cv">CV/Resume</a>
        <a href="https://linkedin.com" target="_blank" rel="noopener">LinkedIn</a>
        <a href="/contact">Message</a>
    </footer>
</body>
</html>
