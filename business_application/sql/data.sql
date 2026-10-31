CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    contact_number VARCHAR(30),
    address VARCHAR(255),
    age INT,
    date_of_birth DATE,
    gender VARCHAR(20),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE instructors
    ADD COLUMN added_by INT NULL,
    ADD COLUMN last_updated_by INT NULL,
    ADD COLUMN last_updated TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ADD CONSTRAINT fk_instructors_added_by FOREIGN KEY (added_by) REFERENCES users(user_id) ON DELETE SET NULL,
    ADD CONSTRAINT fk_instructors_updated_by FOREIGN KEY (last_updated_by) REFERENCES users(user_id) ON DELETE SET NULL;

ALTER TABLE classes
    ADD COLUMN added_by INT NULL,
    ADD COLUMN last_updated_by INT NULL,
    ADD COLUMN last_updated TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ADD CONSTRAINT fk_classes_added_by FOREIGN KEY (added_by) REFERENCES users(user_id) ON DELETE SET NULL,
    ADD CONSTRAINT fk_classes_updated_by FOREIGN KEY (last_updated_by) REFERENCES users(user_id) ON DELETE SET NULL;

CREATE TABLE activity_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    action VARCHAR(20) NOT NULL,
    table_name VARCHAR(50) NOT NULL,
    record_id INT NULL,
    description VARCHAR(255),
    date_logged TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);