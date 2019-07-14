

/* 2) Get all the products name and quantity of products sold for the last 7 days. */

SELECT SUM(`invoice`.`invoice_product_amount`) as `product_amount`, `invoice`.`invoice_product_id`, `p`.`product_name` FROM `invoice`
LEFT JOIN `product` `p` ON `p`.`product_id` = `invoice`.`invoice_product_id`
LEFT JOIN `cart` `c` ON `c`.`cart_id` = `invoice`.`invoice_cart_id`
WHERE `c`.`cart_date` >= (CURRENT_TIMESTAMP() - 604800)
GROUP BY `invoice`.`invoice_product_id`
