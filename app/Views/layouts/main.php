
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($pageTitle ?? APP_NAME) ?> | AREA Car Rentals</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .hero {
            background:
                linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)),
                url('/assets/img/hero2.jpg');
            background-size: cover;
            background-position: center;
            min-height: 70vh;
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="/">
            AREA Car Rentals
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

            <ul class="navbar-nav align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/?page=browse-vehicles">Browse Vehicles</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/?page=about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/?page=services">Services</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/?page=contact">Contact</a>
                </li>

                <?php if (!empty($_SESSION['user_id'])): ?>

                    <li class="nav-item ms-lg-3">
                        <span class="nav-link text-white">
                            Hi, <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-success btn-sm px-3 my-2 my-lg-0"
                           href="/?page=dashboard">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-outline-light btn-sm px-3"
                           href="/?page=logout">
                            Logout
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-light btn-sm px-3 my-2 my-lg-0"
                           href="/?page=login">
                            Sign In
                        </a>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-danger btn-sm px-3"
                           href="/?page=register">
                            Register
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>
    </div>
</nav>

<main class="flex-grow-1">
    <?= $content ?>
</main>

<footer class="bg-dark text-secondary text-center py-4 mt-auto">
    <div class="container">
        <p class="mb-0">
            &copy; <?= date('Y') ?> AREA Car Rentals. All rights reserved.
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
