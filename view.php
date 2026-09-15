<?php
// ============================================
// ProjectHub — View & Search Project Ideas
// ============================================
// Displays all project ideas from MySQL.
// Supports filtering by domain using a
// prepared statement with WHERE clause.
// ============================================

require_once 'config.php';

// --- Allowed domain values for filter validation ---
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

// --- Check if a domain filter was submitted ---
$selected_domain = '';
$projects = [];

if (isset($_GET['domain']) && $_GET['domain'] !== '') {
    $selected_domain = trim($_GET['domain']);

    // Validate the domain value
    if (in_array($selected_domain, $allowed_domains, true)) {
        // --- SELECT with WHERE using prepared statement ---
        $stmt = mysqli_prepare(
            $conn,
            "SELECT project_id, project_title, domain, description, technology, guide_required
             FROM project_ideas
             WHERE domain = ?
             ORDER BY project_id DESC"
        );
        mysqli_stmt_bind_param($stmt, "s", $selected_domain);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $projects[] = $row;
        }

        mysqli_stmt_close($stmt);
    }
    // If invalid domain, $projects stays empty — shows "No results" message
} else {
    // --- SELECT all projects (no user input, no prepared statement needed) ---
    $result = mysqli_query(
        $conn,
        "SELECT project_id, project_title, domain, description, technology, guide_required
         FROM project_ideas
         ORDER BY project_id DESC"
    );

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $projects[] = $row;
        }
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Browse and search project ideas in ProjectHub by domain.">
    <title>View Projects — ProjectHub</title>
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
            <li><a href="add.php">Add Project</a></li>
            <li><a href="view.php" class="active">View Projects</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<main class="container">

    <div class="page-header">
        <h1>Browse Project Ideas</h1>
        <p>View all submitted project ideas or filter by domain.</p>
    </div>

    <!-- Domain Filter / Search Bar -->
    <form class="filter-bar" method="GET" action="view.php">
        <label for="domain">Filter by Domain:</label>
        <select id="domain" name="domain">
            <option value="">All Domains</option>
            <?php foreach ($allowed_domains as $d): ?>
                <option value="<?php echo htmlspecialchars($d); ?>"
                    <?php echo ($selected_domain === $d) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($d); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn-filter">&#128269; Search</button>
        <?php if ($selected_domain !== ''): ?>
            <a href="view.php" class="btn-clear">&#10005; Clear Filter</a>
        <?php endif; ?>
    </form>

    <!-- Results Count -->
    <?php if ($selected_domain !== ''): ?>
        <p class="results-count">
            Showing <?php echo count($projects); ?> result(s) for domain:
            <strong><?php echo htmlspecialchars($selected_domain); ?></strong>
        </p>
    <?php else: ?>
        <p class="results-count">
            Showing all <?php echo count($projects); ?> project idea(s)
        </p>
    <?php endif; ?>

    <!-- Project Listing -->
    <?php if (count($projects) > 0): ?>
        <div class="projects-grid">
            <?php foreach ($projects as $project): ?>
                <div class="project-card">
                    <div class="card-header">
                        <span class="card-title"><?php echo htmlspecialchars($project['project_title']); ?></span>
                        <span class="card-id">#<?php echo htmlspecialchars($project['project_id']); ?></span>
                    </div>
                    <p class="card-description"><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
                    <div class="card-meta">
                        <span class="badge badge-domain"><?php echo htmlspecialchars($project['domain']); ?></span>
                        <span class="badge badge-tech"><?php echo htmlspecialchars($project['technology']); ?></span>
                        <?php if ($project['guide_required'] === 'Yes'): ?>
                            <span class="badge badge-guide-yes">&#10003; Guide Required</span>
                        <?php else: ?>
                            <span class="badge badge-guide-no">&#10007; No Guide</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <div class="icon">&#128194;</div>
            <?php if ($selected_domain !== ''): ?>
                <h3>No project ideas found for "<?php echo htmlspecialchars($selected_domain); ?>"</h3>
                <p>Try selecting a different domain or <a href="view.php">view all projects</a>.</p>
            <?php else: ?>
                <h3>No project ideas yet</h3>
                <p>Be the first to <a href="add.php">add a project idea</a>!</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</main>

<!-- Footer -->
<footer class="footer">
    <p>ProjectHub &mdash; DBMS Unit 4 Mini Project | Problem Statement #37</p>
</footer>

</body>
</html>
