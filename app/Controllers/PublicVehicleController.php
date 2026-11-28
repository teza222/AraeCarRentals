<?php

require_once __DIR__ . '/../Models/Vehicle.php';

class PublicVehicleController
{
    private Vehicle $vehicleModel;

    public function __construct()
    {
        $this->vehicleModel = new Vehicle();
    }

    // Display available vehicles
    public function index()
    {
        $pageTitle = 'Available Vehicles';

        $type = $_GET['type'] ?? '';
        $search = trim($_GET['search'] ?? '');

        $vehicles = $this->vehicleModel->getAvailableVehicles(
            $type,
            $search
        );

        ob_start();
        require __DIR__ . '/../Views/pages/vehicles/browse.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/main.php';
    }

    // Display vehicle details
    public function details()
    {
        $id = (int)($_GET['id'] ?? 0);

        $vehicle = $this->vehicleModel->getAvailableVehicleById($id);

        if (!$vehicle) {
            header('Location: /?page=browse-vehicles');
            exit;
        }

        $pageTitle = $vehicle['name'];

        ob_start();
        require __DIR__ . '/../Views/pages/vehicles/details.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/main.php';
    }
}

