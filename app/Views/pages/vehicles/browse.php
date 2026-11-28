<?php
$typeLabels = [
    'car' => 'Cars',
    'bus' => 'Buses'
];
?>

<div class="container py-5">

    <!-- Page Heading -->
    <div class="mb-4">
        <h1 class="fw-bold">Find Your Perfect Ride</h1>
        <p class="text-muted">
            Explore our vehicles and find the perfect option for your journey.
        </p>
    </div>

    <!-- Search and Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="/" class="row g-3">

                <input type="hidden" name="page" value="browse-vehicles">

                <div class="col-md-6">
                    <label class="form-label">Search Vehicles</label>

                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search brand, model or vehicle name..."
                           value="<?= htmlspecialchars($search) ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Vehicle Type</label>

                    <select name="type" class="form-select">

                        <option value="">All Vehicles</option>

                        <option value="car"
                            <?= $type === 'car' ? 'selected' : '' ?>>
                            Cars
                        </option>

                        <option value="bus"
                            <?= $type === 'bus' ? 'selected' : '' ?>>
                            Buses
                        </option>

                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">

                    <button type="submit" class="btn btn-primary flex-grow-1">
                        Search
                    </button>

                    <a href="/?page=browse-vehicles"
                       class="btn btn-outline-secondary">
                        Reset
                    </a>

                </div>

            </form>

        </div>
    </div>

    <!-- Results -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="mb-0">Available Vehicles</h4>

        <span class="text-muted">
            <?= count($vehicles) ?> vehicle(s) found
        </span>

    </div>

    <?php if (empty($vehicles)): ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">

                <h4>No vehicles found</h4>

                <p class="text-muted">
                    Try changing your search or filter.
                </p>

                <a href="/?page=browse-vehicles"
                   class="btn btn-primary">
                    View All Vehicles
                </a>

            </div>
        </div>

    <?php else: ?>

        <div class="row g-4">

            <?php foreach ($vehicles as $vehicle): ?>

                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 border-0 shadow-sm">

                        <!-- Vehicle Image -->
                        <?php if (!empty($vehicle['image'])): ?>

                            <img src="/<?= htmlspecialchars($vehicle['image']) ?>"
                                 class="card-img-top"
                                 alt="<?= htmlspecialchars($vehicle['name']) ?>"
                                 style="height:230px;object-fit:cover">

                        <?php else: ?>

                            <div class="bg-light d-flex justify-content-center align-items-center"
                                 style="height:230px">

                                <span class="text-muted">
                                    No image available
                                </span>

                            </div>

                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">

                            <!-- Vehicle Name -->
                            <h5 class="card-title fw-bold">
                                <?= htmlspecialchars($vehicle['name']) ?>
                            </h5>

                            <p class="text-muted mb-3">
                                <?= htmlspecialchars($vehicle['brand']) ?>
                                <?= htmlspecialchars($vehicle['model']) ?>
                                · <?= (int)$vehicle['year'] ?>
                            </p>

                            <!-- Vehicle Information -->
                            <div class="d-flex justify-content-between text-muted small mb-3">

                                <span>
                                    <i class="bi bi-people"></i>
                                    <?= (int)$vehicle['seats'] ?> Seats
                                </span>

                                <span>
                                    <?= ucfirst(htmlspecialchars($vehicle['vehicle_type'])) ?>
                                </span>

                            </div>

                            <!-- Price -->
                            <div class="border-top pt-3 mt-auto">

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <div>
                                        <span class="text-muted small">Starting at</span>

                                        <div class="fs-4 fw-bold text-primary">
                                            $<?= number_format((float)$vehicle['daily_rate'], 2) ?>
                                            <small class="fs-6 fw-normal text-muted">/day</small>
                                        </div>
                                    </div>

                                </div>

                                <a href="/?page=vehicle-details&id=<?= (int)$vehicle['id'] ?>"
                                   class="btn btn-primary w-100">
                                    View Details
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>