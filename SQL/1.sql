/* 1) Get firstname and email of customers who ordered PRODUCT_1 */

SELECT DISTINCT `c`.`customer_firstname`, `c`.`customer_email` FROM `invoice`
LEFT JOIN `cart` `cc` ON `cc`.`cart_id` = `invoice`.`invoice_cart_id`
LEFT JOIN `customer` `c` ON `c`.`customer_id` = `cc`.`cart_customer_id`
WHERE `invoice_product_id` = 1
