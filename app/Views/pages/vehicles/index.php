
<?php
?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Vehicle Management</h2>
            <p class="text-muted mb-0">Manage your rental fleet</p>
        </div>

        <a href="/?page=vehicle-create" class="btn btn-primary">
            + Add Vehicle
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <?php if (empty($vehicles)): ?>

                <div class="text-center py-5">
                    <h5>No vehicles found</h5>
                    <p class="text-muted">Start by adding a vehicle to your fleet.</p>

                    <a href="/?page=vehicle-create" class="btn btn-primary">
                        Add Your First Vehicle
                    </a>
                </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>Vehicle</th>
                                <th>Registration</th>
                                <th>Type</th>
                                <th>Seats</th>
                                <th>Daily Rate</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php foreach ($vehicles as $vehicle): ?>

                            <tr>

                                <td>
                                    <div class="d-flex align-items-center">

                                        <?php if (!empty($vehicle['image'])): ?>

                                            <img
                                                src="/<?= htmlspecialchars($vehicle['image']) ?>"
                                                alt="Vehicle"
                                                style="width:70px;height:50px;object-fit:cover"
                                                class="rounded me-3">

                                        <?php else: ?>

                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                 style="width:70px;height:50px">
                                                <span class="text-muted">No image</span>
                                            </div>

                                        <?php endif; ?>

                                        <div>
                                            <strong>
                                                <?= htmlspecialchars($vehicle['name']) ?>
                                            </strong>

                                            <div class="small text-muted">
                                                <?= htmlspecialchars($vehicle['brand']) ?>
                                                <?= htmlspecialchars($vehicle['model']) ?>
                                                <?= htmlspecialchars($vehicle['year']) ?>
                                            </div>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <?= htmlspecialchars($vehicle['registration_number']) ?>
                                </td>

                                <td>
                                    <?= ucfirst(htmlspecialchars($vehicle['vehicle_type'])) ?>
                                </td>

                                <td>
                                    <?= (int)$vehicle['seats'] ?>
                                </td>

                                <td>
                                    $<?= number_format((float)$vehicle['daily_rate'], 2) ?>
                                </td>

                                <td>

                                    <?php
                                    $statusClass = match ($vehicle['status']) {
                                        'available' => 'success',
                                        'maintenance' => 'warning',
                                        default => 'secondary'
                                    };
                                    ?>

                                    <span class="badge bg-<?= $statusClass ?>">
                                        <?= ucfirst(htmlspecialchars($vehicle['status'])) ?>
                                    </span>

                                </td>

                                <td>
                                    <div class="d-flex gap-2">

                                        <a href="/?page=vehicle-create&id=<?= (int)$vehicle['id'] ?>"
                                           class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="/?page=vehicle-delete"
                                              onsubmit="return confirm('Are you sure you want to delete this vehicle?');">

                                            <input type="hidden"
                                                   name="id"
                                                   value="<?= (int)$vehicle['id'] ?>">

                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Delete
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>
