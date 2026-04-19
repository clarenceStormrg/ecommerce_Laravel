USE ecommerce;

SELECT * FROM users;
SELECT * FROM categories;
SELECT * FROM brands;
SELECT * FROM products;
SELECT * FROM orders;
SELECT * FROM order_items;
SELECT * FROM payments;
SELECT * FROM wishlists;
SELECT * FROM reviews;
SELECT * FROM shipping_addresses;


UPDATE products SET discount_price = price * 0.80 WHERE id <= 50;

INSERT INTO orders (user_id, total_price, status, created_at, updated_at)
VALUES (42, 487.29, 'paid', NOW(), NOW());

SET @order_id = LAST_INSERT_ID();

INSERT INTO order_items (order_id, product_id, quantity, price, subtotal, created_at, updated_at)
VALUES 
(@order_id, 31, 1, 314.07, 314.07, NOW(), NOW()),
(@order_id, 34, 1, 173.22, 173.22, NOW(), NOW());