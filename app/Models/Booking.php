
<?php

require_once __DIR__ . '/../../core/database.php';

class Booking
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    /**
     * Check whether a vehicle is available
     * during the requested rental period.
     */
    public function isVehicleAvailable($vehicleId, $pickupDate, $returnDate)
    {
        $sql = "SELECT COUNT(*) FROM bookings
                WHERE vehicle_id = :vehicle_id
                AND status IN ('pending', 'approved')
                AND pickup_date < :return_date
                AND return_date > :pickup_date";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'vehicle_id' => $vehicleId,
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate
        ]);

        return (int)$stmt->fetchColumn() === 0;
    }


    /**
     * Create a new booking.
     */
    public function create($data)
    {
        $sql = "INSERT INTO bookings (
                    user_id,
                    vehicle_id,
                    pickup_date,
                    return_date,
                    pickup_location,
                    dropoff_location,
                    requires_driver,
                    home_delivery,
                    roadside_assistance,
                    total_amount,
                    status
                ) VALUES (
                    :user_id,
                    :vehicle_id,
                    :pickup_date,
                    :return_date,
                    :pickup_location,
                    :dropoff_location,
                    :requires_driver,
                    :home_delivery,
                    :roadside_assistance,
                    :total_amount,
                    :status
                )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }


    /**
     * Get bookings belonging to a customer.
     */
    public function getUserBookings($userId)
    {
        $sql = "SELECT b.*, v.name AS vehicle_name,
                       v.brand, v.model, v.image
                FROM bookings b
                JOIN vehicles v ON b.vehicle_id = v.id
                WHERE b.user_id = :user_id
                ORDER BY b.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll();
    }


    /**
     * Get one booking belonging to a customer.
     */
    public function getUserBookingById($bookingId, $userId)
    {
        $sql = "SELECT b.*, v.name AS vehicle_name,
                       v.brand, v.model, v.image
                FROM bookings b
                JOIN vehicles v ON b.vehicle_id = v.id
                WHERE b.id = :booking_id
                AND b.user_id = :user_id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'booking_id' => $bookingId,
            'user_id' => $userId
        ]);

        return $stmt->fetch();
    }
}
