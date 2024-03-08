CREATE TABLE IF NOT EXISTS masters
(
    id            INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name          VARCHAR(255) NOT NULL,
    surname       VARCHAR(255) NOT NULL,
    level         INT NOT NULL DEFAULT 0,
    created_at    DATETIME DEFAULT NOW(),
    updated_at    DATETIME DEFAULT NOW()
);