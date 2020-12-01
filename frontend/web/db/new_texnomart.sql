SELECT * FROM `sklad_lang` WHERE `owner_id` IN (179, 180, 181, 182, 183, 184, 185, 187, 188, 189, 190, 191, 192, 193, 194, 195, 197, 198, 199, 200, 201, 205)

SELECT * FROM `sklad_lang` WHERE `owner_id` IN (179, 180, 181, 182, 183, 184, 185, 187, 188, 189, 190, 191, 192, 193, 194, 195, 197, 198, 199, 200, 201, 205)

SELECT `product`.* FROM `product` LEFT JOIN `product_to_sklad` ON `product`.`id` = `product_to_sklad`.`product_id` LEFT JOIN `sklad` ON `product_to_sklad`.`sklad_id` = `sklad`.`id` WHERE (`sklad`.`region_id`=2) AND (`product_to_sklad`.`quantity` > 0) AND ((`product`.`status`=1) AND (`product`.`deleted`=FALSE)) AND (`product`.`is_new_product` != 1) ORDER BY `order_count` DESC LIMIT 50

ALTER TABLE `sklad`
ADD INDEX `id` (`id`);

DELETE FROM `product_to_category`
WHERE `category_id` IS NULL;

