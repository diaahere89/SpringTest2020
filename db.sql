CREATE SCHEMA springtest20;
USE springtest20;
CREATE USER 'springuser'@'localhost' IDENTIFIED BY 'FgU%WyOIQPn*y63mSy';
GRANT ALL PRIVILEGES ON springtest20.* TO 'springuser'@'localhost';

CREATE TABLE
IF NOT EXISTS products
(
	id INT
(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    prod_name VARCHAR
(255),
    prod_descr TEXT,
    prod_price DECIMAL
(12, 2)
);

CREATE TABLE
IF NOT EXISTS customers
(
	id INT
(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	fullname VARCHAR
(70),
    username VARCHAR
(70),
    email VARCHAR
(70),
    phone VARCHAR
(20),
    website VARCHAR
(70)
);

CREATE TABLE
IF NOT EXISTS wishlists
(
	id INT
(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    title VARCHAR
(170),
    cust_id INT
(11),
    CONSTRAINT wishCustomer
    FOREIGN KEY
(cust_id) REFERENCES customers
(id)
    ON
DELETE CASCADE
);

CREATE TABLE
IF NOT EXISTS wishproducts
(
    wish_id INT
(11),
    prod_id INT
(11),
    CONSTRAINT wishOperation
    FOREIGN KEY
(wish_id) REFERENCES wishlists
(id)
    ON
DELETE CASCADE,
    CONSTRAINT prodOperation
    FOREIGN KEY
(prod_id) REFERENCES products
(id)
    ON
DELETE CASCADE,
    PRIMARY KEY (wish_id, prod_id)
);


--------------------------------------

CSV Query

--------------------------------------


SELECT customers.id AS 'Customer ID', customers.fullname AS 'Customer fullname',
    customers.username AS 'Customer username', subq.wtitle AS 'Wishlist title', subq.items AS 'No. of items'
FROM customers LEFT JOIN

    (SELECT wishproducts.wish_id AS wid, wishlists.cust_id AS cid,
        wishlists.title AS wtitle, COUNT(*) AS items
    FROM wishproducts
        LEFT JOIN wishlists
        ON wishproducts.wish_id = wishlists.id
    GROUP BY wishproducts.wish_id
    ORDER BY wishproducts.wish_id) AS subq
    ON customers.id = subq.cid
GROUP BY subq.wid
ORDER BY customers.fullname;