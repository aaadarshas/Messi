CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    book_name VARCHAR(150) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(15) NOT NULL,
    complaint TEXT NOT NULL,
    image VARCHAR(255),
    submitted_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
