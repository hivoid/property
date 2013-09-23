SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

USE `property_management`;

ALTER TABLE  `payment_record` ADD  `property_costs` FLOAT( 9, 2 ) NOT NULL DEFAULT  '0.00' COMMENT  '物业费' AFTER  `waste_collection` ,
ADD  `catv_costs` FLOAT( 9, 2 ) NOT NULL DEFAULT  '0.00' COMMENT  '有线电视费' AFTER  `property_costs`;