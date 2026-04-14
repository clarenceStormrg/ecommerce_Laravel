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