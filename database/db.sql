CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE performers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    instrument VARCHAR(255),
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



INSERT INTO performers (name, instrument, image) VALUES ('MECASM', 'Guitar', 'uploads/john_doe.jpg'),
('MECAF', 'Guitar', 'uploads/john_doe.jpg'),('IEEE', 'Guitar', 'uploads/john_doe.jpg'),
('IEDC', 'Guitar', 'uploads/john_doe.jpg');



CREATE TABLE matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team1 VARCHAR(100) NOT NULL,
    team2 VARCHAR(100) NOT NULL,
    score VARCHAR(50),
    match_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE arts_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    event_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO arts_events (title, artist, description, event_date)
VALUES 
('Art Expo 2024', 'John Doe', 'An exhibition featuring modern art from local artists.', '2024-12-01'),
('Painting Workshop', 'Jane Smith', 'Learn to paint landscapes in this interactive workshop.', '2024-11-15');



CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_type ENUM('sports', 'arts') NOT NULL,
    event_name VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    image_path VARCHAR(255) NOT NULL
);


INSERT INTO events (event_type, event_name, event_date, event_time, image_path) VALUES
('sports', 'Football Match', '2020-02-12', '15:00:00', 'img/program_details/sports1.png'),
('sports', 'Basketball Game', '2020-02-12', '16:00:00', 'img/program_details/sports2.png'),
('arts', 'Art Exhibition', '2020-02-13', '17:00:00', 'img/program_details/arts1.png'),
('arts', 'Dance Performance', '2020-02-13', '18:00:00', 'img/program_details/arts2.png');





CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    user_id INT NOT NULL,
    booking_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
