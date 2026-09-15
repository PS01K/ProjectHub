<?php
// ============================================
// ProjectHub — Save Project Idea (INSERT)
// ============================================
// Receives POST data from add.php form.
// Validates input server-side.
// Inserts into MySQL using a prepared statement.
// ============================================

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add.php');
    exit;
}

// Include database connection
require_once 'config.php';

// --- Allowed domain values ---
$allowed_domains = [
    'Web Development',
    'AI / Machine Learning',
    'Blockchain',
    'Cybersecurity',
    'Mobile Development',
    'IoT',
    'Data Science',
    'Other'
];

// --- Retrieve and trim form inputs ---
$project_title  = isset($_POST['project_title'])  ? trim($_POST['project_title'])  : '';
$domain         = isset($_POST['domain'])          ? trim($_POST['domain'])          : '';
$description    = isset($_POST['description'])     ? trim($_POST['description'])     : '';
$technology     = isset($_POST['technology'])       ? trim($_POST['technology'])       : '';
$guide_required = isset($_POST['guide_required'])  ? trim($_POST['guide_required'])  : '';

// --- Server-side validation ---
$errors = [];

if ($project_title === '' || strlen($project_title) > 200) {
    $errors[] = 'Project Title is required (max 200 characters).';
}

if (!in_array($domain, $allowed_domains, true)) {
    $errors[] = 'Please select a valid domain.';
}

if ($description === '' || strlen($description) > 1000) {
    $errors[] = 'Description is required (max 1000 characters).';
}

if ($technology === '' || strlen($technology) > 200) {
    $errors[] = 'Technology is required (max 200 characters).';
}

if ($guide_required !== 'Yes' && $guide_required !== 'No') {
    $errors[] = 'Please select Yes or No for Guide Required.';
}

// --- If validation fails, show errors ---
if (!empty($errors)) {
    $error_message = implode('<br>', array_map('htmlspecialchars', $errors));
    $status = 'error';
    $message = $error_message;
} else {
    // --- INSERT using prepared statement ---
    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO project_ideas (project_title, domain, description, technology, guide_required)
         VALUES (?, ?, ?, ?, ?)"
    );

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $project_title, $domain, $description, $technology, $guide_required);

        if (mysqli_stmt_execute($stmt)) {
            $status = 'success';
            $message = 'Project idea added successfully!';
        } else {
            // Generic error — do NOT expose database internals
            $status = 'error';
            $message = 'Something went wrong while saving your project idea. Please try again.';
        }

        mysqli_stmt_close($stmt);
    } else {
        $status = 'error';
        $message = 'Something went wrong. Please try again later.';
    }
}

// Close database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($status === 'success') ? 'Success' : 'Error'; ?> — ProjectHub</title>
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
        <h1><?php echo ($status === 'success') ? 'Success!' : 'Submission Error'; ?></h1>
    </div>

    <!-- Status Message -->
    <div class="alert <?php echo ($status === 'success') ? 'alert-success' : 'alert-error'; ?>">
        <?php echo ($status === 'success') ? htmlspecialchars($message) : $message; ?>
    </div>

    <!-- Action Links -->
    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="view.php" class="btn-submit" style="text-decoration: none; text-align: center;">
            &#128196; View Projects
        </a>
        <a href="add.php" class="btn-submit" style="text-decoration: none; text-align: center; background: #64748b;">
            &#10010; Add Another Project
        </a>
    </div>

</main>

<!-- Footer -->
<footer class="footer">
    <p>ProjectHub &mdash; DBMS Unit 4 Mini Project | Problem Statement #37</p>
</footer>

</body>
</html>
