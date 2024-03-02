CREATE TABLE IF NOT EXISTS bookings
(
    id            INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id       INT UNSIGNED NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    vehicle       VARCHAR(255) NOT NULL,
    type          INT NOT NULL,
    date_time     DATETIME NOT NULL,
    comment       TEXT,
    status        INT NOT NULL DEFAULT 0,
    created_at    DATETIME DEFAULT NOW(),
    updated_at    DATETIME DEFAULT NOW(),

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);