<div class="container py-5">

    <a href="/?page=browse-vehicles"
       class="text-decoration-none mb-4 d-inline-block">
        &larr; Back to Vehicles
    </a>

    <div class="row g-4">

        <!-- Vehicle Image -->
        <div class="col-lg-7">

            <?php if (!empty($vehicle['image'])): ?>

                <img src="/<?= htmlspecialchars($vehicle['image']) ?>"
                     class="img-fluid rounded shadow-sm w-100"
                     alt="<?= htmlspecialchars($vehicle['name']) ?>"
                     style="max-height:500px;object-fit:cover">

            <?php else: ?>

                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                     style="height:400px">

                    <span class="text-muted">
                        No vehicle image available
                    </span>

                </div>

            <?php endif; ?>

        </div>

        <!-- Vehicle Information -->
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <span class="badge bg-success mb-3">
                        Available for Rent
                    </span>

                    <h1 class="fw-bold">
                        <?= htmlspecialchars($vehicle['name']) ?>
                    </h1>

                    <p class="text-muted fs-5">
                        <?= htmlspecialchars($vehicle['brand']) ?>
                        <?= htmlspecialchars($vehicle['model']) ?>
                        <?= (int)$vehicle['year'] ?>
                    </p>

                    <hr>

                    <div class="display-6 fw-bold text-primary">
                        $<?= number_format((float)$vehicle['daily_rate'], 2) ?>
                        <span class="fs-6 fw-normal text-muted">per day</span>
                    </div>

                    <hr>

                    <h5 class="fw-bold">Vehicle Specifications</h5>

                    <div class="row g-3 mb-4">

                        <div class="col-6">
                            <div class="bg-light rounded p-3">
                                <small class="text-muted">Vehicle Type</small>
                                <div class="fw-semibold">
                                    <?= ucfirst(htmlspecialchars($vehicle['vehicle_type'])) ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="bg-light rounded p-3">
                                <small class="text-muted">Seats</small>
                                <div class="fw-semibold">
                                    <?= (int)$vehicle['seats'] ?> Passengers
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="bg-light rounded p-3">
                                <small class="text-muted">Year</small>
                                <div class="fw-semibold">
                                    <?= (int)$vehicle['year'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="bg-light rounded p-3">
                                <small class="text-muted">Registration</small>
                                <div class="fw-semibold">
                                    <?= htmlspecialchars($vehicle['registration_number']) ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <h5 class="fw-bold">Description</h5>

                    <p class="text-muted">
                        <?= !empty($vehicle['description'])
                            ? nl2br(htmlspecialchars($vehicle['description']))
                            : 'Contact us for more information about this vehicle.' ?>
                    </p>

                    <div class="alert alert-light border mt-4">
                        <strong>Rental Information</strong>
                        <p class="small mb-0 mt-1">
                            Rental prices are calculated based on the number of rental days.
                            Additional services may affect the final cost.
                        </p>
                    </div>

                    <!-- Booking Button -->
                    <?php if (!empty($_SESSION['user_id'])): ?>

                        <a href="/?page=booking-create&vehicle_id=<?= (int)$vehicle['id'] ?>"
                           class="btn btn-primary btn-lg w-100">
                            Book This Vehicle
                        </a>

                    <?php else: ?>

                        <a href="/?page=login"
                           class="btn btn-primary btn-lg w-100">
                            Sign In to Book
                        </a>

                        <p class="text-center text-muted small mt-2">
                            You need an account to book this vehicle.
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>