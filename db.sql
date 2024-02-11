CREATE TABLE customers (
                           id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                           name VARCHAR(255) NOT NULL,
                           phone VARCHAR(255)
);

CREATE TABLE parks (
                       id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       address VARCHAR(255) NOT NULL
);

CREATE TABLE cars (
                      id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                      park_id INT NOT NULL,
                      model VARCHAR(255) NOT NULL,
                      price FLOAT NOT NULL,
                      FOREIGN KEY (park_id) REFERENCES parks(id)
);

CREATE TABLE drivers (
                         id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                         car_id INT NOT NULL,
                         name VARCHAR(255) NOT NULL,
                         phone VARCHAR(255),
                         FOREIGN KEY (car_id) REFERENCES cars(id)
);

CREATE TABLE orders (
                        id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                        driver_id INT NOT NULL,
                        customer_id INT NOT NULL,
                        start TEXT NOT NULL,
                        finish TEXT NOT NULL,
                        total FLOAT NOT NULL,
                        FOREIGN KEY (driver_id) REFERENCES drivers(id),
                        FOREIGN KEY (customer_id) REFERENCES customers(id)
);