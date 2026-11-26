
<?php

require_once __DIR__ . '/../../core/database.php';

class Vehicle
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Get all vehicles
    public function getAll()
    {
        $sql = "SELECT * FROM vehicles ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    // Get one vehicle
    public function getById($id)
    {
        $sql = "SELECT * FROM vehicles WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    // Create vehicle
    public function create($data)
    {
        $sql = "INSERT INTO vehicles
        (name, vehicle_type, brand, model, year, registration_number,
         seats, daily_rate, description, image, status)
        VALUES
        (:name, :vehicle_type, :brand, :model, :year, :registration_number,
         :seats, :daily_rate, :description, :image, :status)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }

    // Update vehicle
    public function update($id, $data)
    {
        $sql = "UPDATE vehicles SET
            name = :name,
            vehicle_type = :vehicle_type,
            brand = :brand,
            model = :model,
            year = :year,
            registration_number = :registration_number,
            seats = :seats,
            daily_rate = :daily_rate,
            description = :description,
            image = :image,
            status = :status
            WHERE id = :id";

        $data['id'] = $id;

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }

    // Delete vehicle
    public function delete($id)
    {
        $sql = "DELETE FROM vehicles WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
}
