CREATE TABLE IF NOT EXISTS bookings
(
    id         INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id    INT UNSIGNED NOT NULL,
    vehicle    VARCHAR(255) NOT NULL,
    type       INT NOT NULL,
    date_time  DATETIME NOT NULL,
    comment    TEXT,
    status     VARCHAR(255) DEFAULT 'pending',
    created_at DATETIME DEFAULT NOW(),

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);