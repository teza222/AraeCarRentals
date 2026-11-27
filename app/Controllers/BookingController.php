<?php

require_once __DIR__ . '/../Models/Vehicle.php';
require_once __DIR__ . '/../Models/Booking.php';

class BookingController
{
    private Vehicle $vehicleModel;
    private Booking $bookingModel;

    // add-on service prices
    private const DRIVER_RATE = 2500;
    private const DELIVERY_FEE = 1500;
    private const ROADSIDE_RATE = 500;

    public function __construct()
    {
        $this->vehicleModel = new Vehicle();
        $this->bookingModel = new Booking();
    }

    /**
     * Ensure the customer is logged in.
     */
    private function requireLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /?page=login');
            exit;
        }
    }

    /**
     * Display booking form and process booking submissions.
     */
    public function create()
    {
        $this->requireLogin();

        $vehicleId = (int)(
            $_GET['vehicle_id']
            ?? $_POST['vehicle_id']
            ?? 0
        );

        $vehicle = $this->vehicleModel->getAvailableVehicleById($vehicleId);

        if (!$vehicle) {
            header('Location: /?page=browse-vehicles');
            exit;
        }

        $pageTitle = 'Book ' . $vehicle['name'];

        $errors = [];
        $success = false;
        $bookingDays = 0;
        $totalAmount = 0;

        $pickupDate = '';
        $returnDate = '';
        $pickupLocation = '';
        $dropoffLocation = '';

        $requiresDriver = 0;
        $homeDelivery = 0;
        $roadsideAssistance = 0;

        $driverCost = 0;
        $deliveryCost = 0;
        $roadsideCost = 0;
        $vehicleCost = 0;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                !isset($_POST['csrf_token']) ||
                !hash_equals(
                    $_SESSION['csrf_token'] ?? '',
                    $_POST['csrf_token']
                )
            ) {
                $errors[] = 'Invalid form submission. Please refresh and try again.';
            }

            $pickupDate = trim($_POST['pickup_date'] ?? '');
            $returnDate = trim($_POST['return_date'] ?? '');

            $pickupLocation = trim($_POST['pickup_location'] ?? '');
            $dropoffLocation = trim($_POST['dropoff_location'] ?? '');

            $requiresDriver = isset($_POST['requires_driver']) ? 1 : 0;
            $homeDelivery = isset($_POST['home_delivery']) ? 1 : 0;
            $roadsideAssistance = isset($_POST['roadside_assistance']) ? 1 : 0;

            // Validate locations
            if ($pickupLocation === '') {
                $errors[] = 'Pickup location is required.';
            }

            if ($dropoffLocation === '') {
                $errors[] = 'Drop-off location is required.';
            }

            // Validate dates
            $pickup = DateTime::createFromFormat('Y-m-d', $pickupDate);
            $return = DateTime::createFromFormat('Y-m-d', $returnDate);

            if (!$pickup || $pickup->format('Y-m-d') !== $pickupDate) {
                $errors[] = 'Please select a valid pickup date.';
            }

            if (!$return || $return->format('Y-m-d') !== $returnDate) {
                $errors[] = 'Please select a valid return date.';
            }

            if ($pickup && $return) {

                $today = new DateTime('today');

                if ($pickup < $today) {
                    $errors[] = 'Pickup date cannot be in the past.';
                }

                if ($return <= $pickup) {
                    $errors[] = 'Return date must be after pickup date.';
                }

                if (empty($errors)) {

                    // Calculate rental duration
                    $bookingDays = (int)$pickup->diff($return)->days;

                    if ($bookingDays < 1) {
                        $errors[] = 'Rental must be at least one day.';
                    } else {

                        // Calculate costs
                        $vehicleCost = $bookingDays * (float)$vehicle['daily_rate'];

                        $driverCost = $requiresDriver
                            ? $bookingDays * self::DRIVER_RATE
                            : 0;

                        $deliveryCost = $homeDelivery
                            ? self::DELIVERY_FEE
                            : 0;

                        $roadsideCost = $roadsideAssistance
                            ? $bookingDays * self::ROADSIDE_RATE
                            : 0;

                        $totalAmount = $vehicleCost
                            + $driverCost
                            + $deliveryCost
                            + $roadsideCost;
                    }
                }
            }

            // Check availability and save booking
            if (empty($errors)) {

                $isAvailable = $this->bookingModel->isVehicleAvailable(
                    $vehicleId,
                    $pickupDate,
                    $returnDate
                );

                if (!$isAvailable) {
                    $errors[] = 'This vehicle is already booked during those dates. Please select different dates.';
                }
            }

            if (empty($errors)) {

                $data = [
                    'user_id' => $_SESSION['user_id'],
                    'vehicle_id' => $vehicleId,
                    'pickup_date' => $pickupDate,
                    'return_date' => $returnDate,
                    'pickup_location' => $pickupLocation,
                    'dropoff_location' => $dropoffLocation,
                    'requires_driver' => $requiresDriver,
                    'home_delivery' => $homeDelivery,
                    'roadside_assistance' => $roadsideAssistance,
                    'total_amount' => $totalAmount,
                    'status' => 'pending'
                ];

                if ($this->bookingModel->create($data)) {

                    $_SESSION['booking_success'] = true;

                    header(
                        'Location: /?page=booking-create&vehicle_id='
                        . $vehicleId
                    );

                    exit;

                } else {
                    $errors[] = 'Unable to save your booking. Please try again.';
                }
            }
        }

        // Create CSRF token if one doesn't exist
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Show success message after redirect
        if (isset($_SESSION['booking_success'])) {
            $success = true;
            unset($_SESSION['booking_success']);
        }

        ob_start();

        require __DIR__ . '/../Views/pages/bookings/create.php';

        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/main.php';
    }
}