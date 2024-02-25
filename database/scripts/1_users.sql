CREATE TABLE IF NOT EXISTS users
(
    id               INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    email            VARCHAR(255) NOT NULL UNIQUE,
    password         TEXT         NOT NULL,
    token            TEXT,
    token_expired_at DATETIME,
    created_at       DATETIME DEFAULT NOW()
);