INSERT INTO `DBNAME_`.`PREFIX_specific_price_rule` (`id_specific_price_rule`, `name`, `id_shop`, `id_currency`, `id_country`, `id_group`, `from_quantity`, `price`, `reduction`, `reduction_type`, `from`, `to`)
VALUES (NULL, 'Deposit', '1', '0', '0', '0', '1', -1.00, '50.00', 'percentage', '', '');
UPDATE `DBNAME_`.`PREFIX_configuration` SET `value` = '1' WHERE `PREFIX_configuration`.`name` = 'PS_ORDER_PROCESS_TYPE';
UPDATE `DBNAME_`.`PREFIX_configuration` SET `value` = '0' WHERE `PREFIX_configuration`.`name` = 'PS_REGISTRATION_PROCESS_TYPE';
UPDATE `DBNAME_`.`PREFIX_configuration` SET `value` = '1' WHERE `PREFIX_configuration`.`name` = 'PS_ORDER_OUT_OF_STOCK';
UPDATE `DBNAME_`.`PREFIX_configuration` SET `value` = '0' WHERE `PREFIX_configuration`.`name` = 'PS_DISPLAY_QTIES';
UPDATE `DBNAME_`.`PREFIX_configuration` SET `value` = '0' WHERE `PREFIX_configuration`.`name` = 'PS_CONDITIONS';
UPDATE `DBNAME_`.`PREFIX_configuration` SET `value` = '0' WHERE `PREFIX_configuration`.`name` = 'PS_SHIPPING_HANDLING';
