CREATE TABLE test (
                      id INT PRIMARY KEY,
                      testname VARCHAR(255) NOT NULL,
                      testphone VARCHAR(255)
);

ALTER TABLE test
    CHANGE COLUMN testname nickname VARCHAR(255) NOT NULL,
    CHANGE COLUMN testphone testphone INT;

DROP TABLE test;

INSERT INTO customers (name, phone) VALUES
                                        ('Valeriia', '1111111'),
                                        ('Mike', '22222'),
                                        ('Alex', '17474'),
                                        ('Den', '95959'),
                                        ('Oleh', '55555');

INSERT INTO parks (address) VALUES
                                ('Odessa'),
                                ('Kyiv'),
                                ('Lviv'),
                                ('Kherson'),
                                ('Kharkiv');

INSERT INTO cars (park_id, model, price) VALUES
                                             (1, 'BMW', 33.2),
                                             (1, 'BMW', 50.7),
                                             (3, 'Ford', 15.3),
                                             (2, 'Mercedes', 27.2),
                                             (4, 'Opel', 33.2);

INSERT INTO drivers (car_id, name, phone) VALUES
                                              (1, 'Dmytro', '53445646'),
                                              (1, 'Arthur', '84758785'),
                                              (4, 'Ben', '9687956'),
                                              (5, 'Sam', '47574547'),
                                              (3, 'Tim', '53445646');

INSERT INTO orders (driver_id, customer_id, start, finish, total) VALUES
                                                                      (1, 1, 'Shevchenko street', 'Vilkovo street', 10.3),
                                                                      (2, 3, 'Filatova street', 'Vilkovo street', 11.5),
                                                                      (2, 2, 'Levitan street', 'Arcadia street', 17.5),
                                                                      (4, 4, 'Victory street', 'Shevchenko street', 13.1),
                                                                      (3, 5, 'Vavilova street', 'Glushko street', 9.1);

UPDATE customers SET phone = '000000' WHERE name = 'Mike';

DELETE FROM drivers WHERE name = 'Tim';

SELECT parks.address, COUNT(cars.id) AS car_count FROM parks
LEFT JOIN cars ON parks.id = cars.park_id
GROUP BY parks.address;

SELECT * FROM cars WHERE price > 20 && model != 'BMW';

SELECT cars.model, drivers.name FROM cars
INNER JOIN drivers ON cars.id = drivers.car_id;

SELECT customers.name, orders.start, orders.finish FROM customers
LEFT JOIN orders ON customers.id = orders.customer_id;

ALTER TABLE customers ADD COLUMN surname VARCHAR(255) NOT NULL;

# customers that have orders from park in Kyiv
SELECT DISTINCT c.name, c.phone FROM customers c
         JOIN orders o ON c.id = o.customer_id
         JOIN drivers d ON o.driver_id = d.id
         JOIN cars cr ON d.car_id = cr.id
         JOIN parks p ON cr.park_id = p.id
WHERE p.address = 'Kyiv';