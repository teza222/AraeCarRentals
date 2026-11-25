
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(30),
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    vehicle_type ENUM('car', 'bus') NOT NULL,
    brand VARCHAR(100),
    model VARCHAR(100),
    year YEAR,
    registration_number VARCHAR(50) UNIQUE,
    seats INT NOT NULL,
    daily_rate DECIMAL(10,2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    status ENUM('available', 'unavailable', 'maintenance')
        DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    vehicle_id INT NOT NULL,
    pickup_date DATETIME NOT NULL,
    return_date DATETIME NOT NULL,
    pickup_location VARCHAR(255),
    dropoff_location VARCHAR(255),
    requires_driver BOOLEAN DEFAULT FALSE,
    home_delivery BOOLEAN DEFAULT FALSE,
    roadside_assistance BOOLEAN DEFAULT FALSE,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM(
        'pending',
        'approved',
        'rejected',
        'cancelled',
        'completed'
    ) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50),
    transaction_reference VARCHAR(150),
    status ENUM('pending', 'paid', 'failed', 'refunded')
        DEFAULT 'pending',
    payment_date TIMESTAMP NULL,

    FOREIGN KEY (booking_id) REFERENCES bookings(id)
);
