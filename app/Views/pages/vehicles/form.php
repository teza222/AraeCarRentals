
<?php
$isEditing = !empty($vehicle);
?>

<div class="container py-4">

    <div class="mb-4">
        <a href="/?page=vehicles" class="text-decoration-none">
            &larr; Back to Vehicles
        </a>

        <h2 class="fw-bold mt-3">
            <?= $isEditing ? 'Edit Vehicle' : 'Add Vehicle' ?>
        </h2>
    </div>

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

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form method="POST" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Vehicle Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               required
                               value="<?= htmlspecialchars($_POST['name'] ?? $vehicle['name'] ?? '') ?>"
                               placeholder="e.g. Toyota Corolla 2022">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Vehicle Type</label>

                        <?php $type = $_POST['vehicle_type'] ?? $vehicle['vehicle_type'] ?? 'car'; ?>

                        <select name="vehicle_type" class="form-select" required>
                            <option value="car" <?= $type === 'car' ? 'selected' : '' ?>>Car</option>
                            <option value="bus" <?= $type === 'bus' ? 'selected' : '' ?>>Bus</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Brand</label>
                        <input type="text"
                               name="brand"
                               class="form-control"
                               required
                               value="<?= htmlspecialchars($_POST['brand'] ?? $vehicle['brand'] ?? '') ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Model</label>
                        <input type="text"
                               name="model"
                               class="form-control"
                               required
                               value="<?= htmlspecialchars($_POST['model'] ?? $vehicle['model'] ?? '') ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Year</label>
                        <input type="number"
                               name="year"
                               class="form-control"
                               required
                               value="<?= htmlspecialchars($_POST['year'] ?? $vehicle['year'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Registration Number</label>
                        <input type="text"
                               name="registration_number"
                               class="form-control"
                               required
                               value="<?= htmlspecialchars($_POST['registration_number'] ?? $vehicle['registration_number'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Number of Seats</label>
                        <input type="number"
                               name="seats"
                               class="form-control"
                               required
                               min="1"
                               value="<?= htmlspecialchars($_POST['seats'] ?? $vehicle['seats'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Daily Rental Rate</label>
                        <input type="number"
                               name="daily_rate"
                               class="form-control"
                               required
                               min="0.01"
                               step="0.01"
                               value="<?= htmlspecialchars($_POST['daily_rate'] ?? $vehicle['daily_rate'] ?? '') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Vehicle Status</label>

                        <?php $status = $_POST['status'] ?? $vehicle['status'] ?? 'available'; ?>

                        <select name="status" class="form-select" required>
                            <option value="available" <?= $status === 'available' ? 'selected' : '' ?>>Available</option>
                            <option value="unavailable" <?= $status === 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
                            <option value="maintenance" <?= $status === 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Vehicle Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="4"><?= htmlspecialchars($_POST['description'] ?? $vehicle['description'] ?? '') ?></textarea>
                    </div>

                    <div class="col-12 mb-3">

                        <label class="form-label">Vehicle Image</label>

                        <input type="file"
                               name="image"
                               class="form-control"
                               accept="image/jpeg,image/png,image/webp">

                        <small class="text-muted">
                            JPG, PNG or WEBP. Maximum size: 5MB.
                        </small>

                        <?php if (!empty($vehicle['image'])): ?>

                            <div class="mt-3">
                                <p>Current Image:</p>

                                <img src="/<?= htmlspecialchars($vehicle['image']) ?>"
                                     alt="Current vehicle image"
                                     class="rounded"
                                     style="max-width:250px">
                            </div>

                        <?php endif; ?>

                    </div>

                </div>

                <div class="d-flex gap-2 mt-3">

                    <button type="submit" class="btn btn-primary px-4">
                        <?= $isEditing ? 'Update Vehicle' : 'Save Vehicle' ?>
                    </button>

                    <a href="/?page=vehicles" class="btn btn-outline-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>
