<?php
$today = date('Y-m-d');
?>

<div class="container py-5">

    <a href="/?page=vehicle-details&id=<?= (int)$vehicle['id'] ?>"
       class="text-decoration-none mb-3 d-inline-block">
        &larr; Back to Vehicle
    </a>

    <h1 class="fw-bold mb-1">Book Your Vehicle</h1>

    <p class="text-muted mb-4">
        Complete the form below to request your rental.
    </p>

    <?php if ($success): ?>

        <div class="alert alert-success">
            <h5 class="alert-heading">Booking Submitted!</h5>

            <p class="mb-0">
                Your rental request has been submitted successfully.
                Your booking is currently pending approval.
            </p>
        </div>

    <?php endif; ?>


    <?php if (!empty($errors)): ?>

        <div class="alert alert-danger">

            <strong>Please correct the following:</strong>

            <ul class="mb-0 mt-2">

                <?php foreach ($errors as $error): ?>

                    <li><?= htmlspecialchars($error) ?></li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>


    <div class="row g-4">

        <!-- Selected Vehicle -->
        <div class="col-lg-4">

            <div class="card shadow-sm border-0">

                <?php if (!empty($vehicle['image'])): ?>

                    <img src="/<?= htmlspecialchars($vehicle['image']) ?>"
                         class="card-img-top"
                         alt="<?= htmlspecialchars($vehicle['name']) ?>"
                         style="height:240px;object-fit:cover">

                <?php endif; ?>

                <div class="card-body">

                    <h4 class="fw-bold">
                        <?= htmlspecialchars($vehicle['name']) ?>
                    </h4>

                    <p class="text-muted">
                        <?= htmlspecialchars($vehicle['brand']) ?>
                        <?= htmlspecialchars($vehicle['model']) ?>
                        <?= (int)$vehicle['year'] ?>
                    </p>

                    <div class="mb-3">
                        <strong><?= (int)$vehicle['seats'] ?></strong>
                        <span class="text-muted">Seats</span>
                    </div>

                    <div class="fs-4 fw-bold text-primary">
                        $<?= number_format((float)$vehicle['daily_rate'], 2) ?>
                        <small class="fs-6 fw-normal text-muted">/ day</small>
                    </div>

                </div>

            </div>

        </div>


        <!-- Booking Form -->
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4">

                    <form method="POST" id="bookingForm">

                        <input type="hidden"
                               name="csrf_token"
                               value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                        <input type="hidden"
                               name="vehicle_id"
                               value="<?= (int)$vehicle['id'] ?>">


                        <h5 class="fw-bold mb-3">Rental Dates</h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Pickup Date
                                </label>

                                <input type="date"
                                       name="pickup_date"
                                       id="pickup_date"
                                       class="form-control"
                                       min="<?= $today ?>"
                                       required
                                       value="<?= htmlspecialchars($pickupDate) ?>">

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Return Date
                                </label>

                                <input type="date"
                                       name="return_date"
                                       id="return_date"
                                       class="form-control"
                                       min="<?= $today ?>"
                                       required
                                       value="<?= htmlspecialchars($returnDate) ?>">

                            </div>

                        </div>


                        <h5 class="fw-bold mt-3 mb-3">Rental Locations</h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Pickup Location
                                </label>

                                <input type="text"
                                       name="pickup_location"
                                       class="form-control"
                                       placeholder="Where should you collect the vehicle?"
                                       required
                                       value="<?= htmlspecialchars($pickupLocation) ?>">

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Drop-off Location
                                </label>

                                <input type="text"
                                       name="dropoff_location"
                                       class="form-control"
                                       placeholder="Where will you return the vehicle?"
                                       required
                                       value="<?= htmlspecialchars($dropoffLocation) ?>">

                            </div>

                        </div>


                        <h5 class="fw-bold mt-3 mb-3">Optional Services</h5>

                        <div class="border rounded p-3 mb-3">

                            <div class="form-check mb-3">

                                <input class="form-check-input service-option"
                                    type="checkbox"
                                    name="requires_driver"
                                    id="requires_driver"
                                    value="1"
                                    data-price="2500"
                                    <?= $requiresDriver ? 'checked' : '' ?>>

                                <label class="form-check-label"
                                       for="requires_driver">

                                    <strong>Driver Service</strong>

                                    <div class="small text-muted">
                                        $2,500 per rental day
                                    </div>

                                </label>

                            </div>


                            <div class="form-check mb-3">

                                <input class="form-check-input service-option"
                                       type="checkbox"
                                       name="home_delivery"
                                       id="home_delivery"
                                       value="1"
                                       data-price="1500"
                                       <?= $homeDelivery ? 'checked' : '' ?>>

                                <label class="form-check-label"
                                       for="home_delivery">

                                    <strong>Home Delivery</strong>

                                    <div class="small text-muted">
                                        $1,500 per booking
                                    </div>

                                </label>

                            </div>


                            <div class="form-check">

                                <input class="form-check-input service-option"
                                       type="checkbox"
                                       name="roadside_assistance"
                                       id="roadside_assistance"
                                       value="1"
                                       data-price="500"
                                       <?= $roadsideAssistance ? 'checked' : '' ?>>

                                <label class="form-check-label"
                                       for="roadside_assistance">

                                    <strong>Roadside Assistance</strong>

                                    <div class="small text-muted">
                                        $500 per rental day
                                    </div>

                                </label>

                            </div>

                        </div>


                        <!-- Price Summary -->
                        <div class="card bg-light border-0 mb-4">

                            <div class="card-body">

                                <h5 class="fw-bold mb-3">
                                    Estimated Rental Cost
                                </h5>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Rental Days</span>
                                    <strong id="rentalDays">0</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Vehicle Rental</span>
                                    <span id="vehicleCost">$0.00</span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Driver</span>
                                    <span id="driverCost">$0.00</span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Home Delivery</span>
                                    <span id="deliveryCost">$0.00</span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Roadside Assistance</span>
                                    <span id="roadsideCost">$0.00</span>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between fs-5 fw-bold">
                                    <span>Total Estimated Cost</span>
                                    <span id="totalCost">$0.00</span>
                                </div>

                                <small class="text-muted d-block mt-2">
                                    Final rental costs may be subject to confirmation.
                                </small>

                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            Submit Booking Request
                        </button>

                        <p class="text-muted small text-center mt-3 mb-0">
                            Your booking will remain pending until approved.
                        </p>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const pickupInput = document.getElementById('pickup_date');
    const returnInput = document.getElementById('return_date');

    const dailyRate = <?= json_encode((float)$vehicle['daily_rate']) ?>;

    // Example service rates
    const driverRate = 2500;
    const deliveryRate = 1500;
    const roadsideRate = 500;

    const driverCheckbox = document.getElementById('requires_driver');
    const deliveryCheckbox = document.getElementById('home_delivery');
    const roadsideCheckbox = document.getElementById('roadside_assistance');

    function money(amount) {
        return '$' + amount.toLocaleString('en-JM', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function calculateTotal() {

        let days = 0;

        if (pickupInput.value && returnInput.value) {

            const pickup = new Date(pickupInput.value + 'T00:00:00');
            const returned = new Date(returnInput.value + 'T00:00:00');

            days = Math.ceil((returned - pickup) / (1000 * 60 * 60 * 24));

            if (days < 0) {
                days = 0;
            }
        }

        const vehicleTotal = days * dailyRate;

        const driverTotal = driverCheckbox.checked
            ? days * driverRate
            : 0;

        const deliveryTotal = deliveryCheckbox.checked
            ? deliveryRate
            : 0;

        const roadsideTotal = roadsideCheckbox.checked
            ? days * roadsideRate
            : 0;

        const total = vehicleTotal
            + driverTotal
            + deliveryTotal
            + roadsideTotal;

        document.getElementById('rentalDays').textContent = days;

        document.getElementById('vehicleCost').textContent =
            money(vehicleTotal);

        document.getElementById('driverCost').textContent =
            money(driverTotal);

        document.getElementById('deliveryCost').textContent =
            money(deliveryTotal);

        document.getElementById('roadsideCost').textContent =
            money(roadsideTotal);

        document.getElementById('totalCost').textContent =
            money(total);
    }


    // Prevent return date from being before pickup date
    pickupInput.addEventListener('change', function () {

        returnInput.min = pickupInput.value;

        if (returnInput.value && returnInput.value <= pickupInput.value) {
            returnInput.value = '';
        }

        calculateTotal();
    });


    returnInput.addEventListener('change', calculateTotal);

    driverCheckbox.addEventListener('change', calculateTotal);
    deliveryCheckbox.addEventListener('change', calculateTotal);
    roadsideCheckbox.addEventListener('change', calculateTotal);

    calculateTotal();

});
</script>