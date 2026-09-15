<?php
// ============================================
// ProjectHub — Add New Project Idea
// ============================================
// Displays the project submission form.
// Form submits to save.php via POST.
// ============================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Submit a new project idea to ProjectHub.">
    <title>Add Project — ProjectHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation -->
<nav class="navbar">
    <div class="container">
        <a href="index.php" class="logo">PROJECTHUB <span>| Repository</span></a>
        <button class="nav-toggle" onclick="document.querySelector('.nav-links').classList.toggle('open')">&#9776;</button>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="add.php" class="active">Add Project</a></li>
            <li><a href="view.php">View Projects</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<main class="container">

    <div class="page-header">
        <h1>Add Project Idea</h1>
        <p>Fill in the details below to submit a new project idea to the repository.</p>
    </div>

    <div class="form-card">
        <form action="save.php" method="POST">

            <!-- Project Title -->
            <div class="form-group">
                <label for="project_title">Project Title <span class="required">*</span></label>
                <input type="text" id="project_title" name="project_title"
                       required maxlength="200"
                       placeholder="e.g., Smart Attendance System">
                <p class="hint">Maximum 200 characters</p>
            </div>

            <!-- Domain -->
            <div class="form-group">
                <label for="domain">Domain <span class="required">*</span></label>
                <select id="domain" name="domain" required>
                    <option value="" disabled selected>— Select a domain —</option>
                    <option value="Web Development">Web Development</option>
                    <option value="AI / Machine Learning">AI / Machine Learning</option>
                    <option value="Blockchain">Blockchain</option>
                    <option value="Cybersecurity">Cybersecurity</option>
                    <option value="Mobile Development">Mobile Development</option>
                    <option value="IoT">IoT</option>
                    <option value="Data Science">Data Science</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description <span class="required">*</span></label>
                <textarea id="description" name="description"
                          required maxlength="1000"
                          placeholder="Briefly describe the project idea, its goals, and expected outcome."></textarea>
                <p class="hint">Maximum 1000 characters</p>
            </div>

            <!-- Technology -->
            <div class="form-group">
                <label for="technology">Technology <span class="required">*</span></label>
                <input type="text" id="technology" name="technology"
                       required maxlength="200"
                       placeholder="e.g., Python, Flask, MySQL">
                <p class="hint">Comma-separated list of technologies (max 200 characters)</p>
            </div>

            <!-- Guide Required -->
            <div class="form-group">
                <label for="guide_required">Guide Required <span class="required">*</span></label>
                <select id="guide_required" name="guide_required" required>
                    <option value="" disabled selected>— Select —</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">&#10003; Submit Project Idea</button>

        </form>
    </div>

</main>

<!-- Footer -->
<footer class="footer">
    <p>ProjectHub &mdash; DBMS Unit 4 Mini Project | Problem Statement #37</p>
</footer>

</body>
</html>
