
<?php

require_once __DIR__ . '/../Models/Vehicle.php';

class VehicleController
{
    private Vehicle $vehicleModel;

    public function __construct()
    {
        $this->vehicleModel = new Vehicle();
    }

    // Restrict access to administrators
    private function requireAdmin()
    {
        if (!isset($_SESSION['user_id']) ||
            ($_SESSION['user_role'] ?? '') !== 'admin') {

            header('Location: /?page=login');
            exit;
        }
    }

    // Display vehicles
    public function index()
    {
        $this->requireAdmin();

        $pageTitle = "Vehicle Management";
        $vehicles = $this->vehicleModel->getAll();

        ob_start();
        require __DIR__ . '/../Views/pages/vehicles/index.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/main.php';
    }

    // Add or edit vehicle
    public function create()
    {
        $this->requireAdmin();

        $pageTitle = "Add Vehicle";
        $errors = [];
        $vehicle = null;

        if (isset($_GET['id'])) {
            $vehicle = $this->vehicleModel->getById($_GET['id']);

            if (!$vehicle) {
                header('Location: /?page=vehicles');
                exit;
            }

            $pageTitle = "Edit Vehicle";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'vehicle_type' => $_POST['vehicle_type'] ?? '',
                'brand' => trim($_POST['brand'] ?? ''),
                'model' => trim($_POST['model'] ?? ''),
                'year' => (int)($_POST['year'] ?? 0),
                'registration_number' => trim($_POST['registration_number'] ?? ''),
                'seats' => (int)($_POST['seats'] ?? 0),
                'daily_rate' => (float)($_POST['daily_rate'] ?? 0),
                'description' => trim($_POST['description'] ?? ''),
                'image' => $vehicle['image'] ?? null,
                'status' => $_POST['status'] ?? 'available'
            ];

            if ($data['name'] === '') {
                $errors[] = 'Vehicle name is required.';
            }

            if ($data['brand'] === '') {
                $errors[] = 'Brand is required.';
            }

            if ($data['model'] === '') {
                $errors[] = 'Model is required.';
            }

            if ($data['year'] < 1900 || $data['year'] > (date('Y') + 1)) {
                $errors[] = 'Please enter a valid vehicle year.';
            }

            if ($data['daily_rate'] <= 0) {
                $errors[] = 'Daily rental rate must be greater than zero.';
            }

            if ($data['seats'] <= 0) {
                $errors[] = 'Seat capacity must be greater than zero.';
            }

            if (!in_array($data['vehicle_type'], ['car', 'bus'])) {
                $errors[] = 'Invalid vehicle type.';
            }

            if (!in_array($data['status'], ['available', 'unavailable', 'maintenance'])) {
                $errors[] = 'Invalid vehicle status.';
            }

            // Upload image
            if (!empty($_FILES['image']['name'])) {

                $uploadDir = __DIR__ . '/../../public/assets/uploads/vehicles/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                $fileType = mime_content_type($_FILES['image']['tmp_name']);

                if (!in_array($fileType, $allowedTypes)) {
                    $errors[] = 'Only JPG, PNG and WEBP images are allowed.';
                } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                    $errors[] = 'Image must be smaller than 5MB.';
                } else {
                    $extension = match ($fileType) {
                        'image/jpeg' => 'jpg',
                        'image/png' => "png",
                        'image/webp' => "webp"
                    };

                    $filename = uniqid('vehicle_', true) . '.' . $extension;
                    $destination = $uploadDir . $filename;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                        $data['image'] = 'assets/uploads/vehicles/' . $filename;
                    } else {
                        $errors[] = 'Unable to upload image.';
                    }
                }
            }

            if (empty($errors)) {
                if ($vehicle) {
                    $this->vehicleModel->update($vehicle['id'], $data);
                } else {
                    $this->vehicleModel->create($data);
                }

                header('Location: /?page=vehicles');
                exit;
            }
        }

        ob_start();
        require __DIR__ . '/../Views/pages/vehicles/form.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/main.php';
    }

    // Delete vehicle
    public function delete()
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /?page=vehicles');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);

        if ($id > 0) {
            $this->vehicleModel->delete($id);
        }

        header('Location: /?page=vehicles');
        exit;
    }
}
