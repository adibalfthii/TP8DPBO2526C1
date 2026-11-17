<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <title>Sistem Akademik MVC</title>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Academic MVC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= ($page === 'lecturers') ? 'active' : '' ?>" href="index.php?page=lecturers">Lecturers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page === 'departments') ? 'active' : '' ?>" href="index.php?page=departments">Departments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page === 'courses') ? 'active' : '' ?>" href="index.php?page=courses">Courses</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-4">