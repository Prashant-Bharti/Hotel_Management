-- Users Table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('customer', 'owner') NOT NULL
);

-- Rooms Table
CREATE TABLE rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    availability BOOLEAN NOT NULL DEFAULT TRUE
);

-- Bookings Table
CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    room_id INT,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);




INSERT INTO users (username, password, user_type, name, age, sex, address) VALUES
('user1', 'password1', 'customer', 'John Doe', 30, 'Male', '123 Main St, City, Country'),
('user2', 'password2', 'customer', 'Jane Smith', 25, 'Female', '456 Elm St, Town, Country'),
('user3', 'password3', 'customer', 'Alice Johnson', 35, 'Female', '789 Oak St, Village, Country'),
('owner1', 'ownerpass1', 'owner', 'James Brown', NULL, NULL, NULL),
('owner2', 'ownerpass2', 'owner', 'Emma Wilson', NULL, NULL, NULL);

INSERT INTO rooms (room_type, price, availability) VALUES
('Small', 100.00, TRUE),
('Medium', 150.00, TRUE),
('Large', 200.00, TRUE);

INSERT INTO bookings (user_id, room_id, check_in_date, check_out_date) VALUES
(1, 1, '2024-05-01', '2024-05-05'),
(2, 2, '2024-05-10', '2024-05-15'),
(3, 3, '2024-06-01', '2024-06-03'),
(1, 4, '2024-07-01', '2024-07-10'),
(2, 5, '2024-08-01', '2024-08-05');
