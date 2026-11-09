<?php
$siteName = "AREA Car Rentals";
$pageTitle = "Dont buy it, Just Rent it!";
$currentYear = date("Y"); 
$isLoggedIn = false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle . " | " . $siteName; ?></title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/assets/img/hero2.jpg');
            background-size: cover;
            background-position: center;
            min-height: 70vh;
        }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <header class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><?php echo $siteName; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-success btn-sm px-3" href="dashboard.php">Dashboard</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-outline-light btn-sm px-3" href="login.php">Sign In</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </header>

    <section class="hero text-white text-center py-5 px-3">
        <div class="container py-5">
            <h1 class="display-4 fw-bold mb-3"><?php echo $pageTitle; ?></h1>
            <p class="lead mb-4 mx-auto" style="max-width: 600px;">Experience the convenience of renting high-quality vehicles without the commitment of ownership.</p>
            <a href="#get-started" class="btn btn-danger btn-lg px-4 py-2 fw-bold shadow">Rent Now</a>
        </div>
    </section>

    <main class="container my-5 flex-grow-1">
        <h2 class="text-center mb-4 fw-bold text-dark">Get Started</h2>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 p-3">
                    <div class="card-body">
                        <h3 class="h5 card-title fw-bold text-dark mb-3">➡️ Step 1</h3>
                        <p class="card-text text-muted">Take a valid driver's license and be at least 21 years old.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 p-3">
                    <div class="card-body">
                        <h3 class="h5 card-title fw-bold text-dark mb-3">➡️ Step 2</h3>
                        <p class="card-text text-muted">Choose from our wide selection of vehicles and select your preferred rental period.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 p-3">
                    <div class="card-body">
                        <h3 class="h5 card-title fw-bold text-dark mb-3">➡️ Step 3</h3>
                        <p class="card-text text-muted">Complete the rental agreement and payment process to secure your vehicle.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-secondary text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; <?php echo $currentYear; ?> <?php echo $siteName; ?>. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>