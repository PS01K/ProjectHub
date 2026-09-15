<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ProjectHub — A Project Idea Repository to discover, submit, and browse project ideas across various domains.">
    <title>ProjectHub — Project Idea Repository</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation -->
<nav class="navbar">
    <div class="container">
        <a href="index.php" class="logo">PROJECTHUB <span>| Repository</span></a>
        <button class="nav-toggle" onclick="document.querySelector('.nav-links').classList.toggle('open')">&#9776;</button>
        <ul class="nav-links">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="add.php">Add Project</a></li>
            <li><a href="view.php">View Projects</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<main class="container">

    <!-- Hero Section -->
    <section class="hero">
        <h1>PROJECTHUB</h1>
        <p class="subtitle">Project Idea Repository</p>
        <p class="tagline">"Discover ideas. Find inspiration. Build something meaningful."</p>
        <div class="hero-buttons">
            <a href="add.php" class="btn-white">&#10010; Add Project Idea</a>
            <a href="view.php" class="btn-outline">&#128269; Browse Projects</a>
        </div>
    </section>

    <!-- Info Cards -->
    <section class="info-section">
        <div class="info-card">
            <div class="icon">&#128221;</div>
            <h3>Submit Ideas</h3>
            <p>Share your project ideas with details like title, domain, description, technology stack, and guide requirements.</p>
        </div>
        <div class="info-card">
            <div class="icon">&#128270;</div>
            <h3>Search by Domain</h3>
            <p>Filter project ideas by domain — Web Development, AI, Blockchain, Cybersecurity, IoT, and more.</p>
        </div>
        <div class="info-card">
            <div class="icon">&#128161;</div>
            <h3>Find Inspiration</h3>
            <p>Browse through a collection of project ideas to find inspiration for your next academic or personal project.</p>
        </div>
    </section>

</main>

<!-- Footer -->
<footer class="footer">
    <p>ProjectHub &mdash; DBMS Unit 4 Mini Project | Problem Statement #37</p>
</footer>

</body>
</html>
