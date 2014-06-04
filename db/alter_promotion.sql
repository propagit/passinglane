ALTER TABLE `promotion_conditions` ADD `actual_usages` INT NOT NULL , ADD `allowed_usages` INT NOT NULL ;
ALTER TABLE `promotion_conditions` CHANGE `allowed_usages` `allowed_usages` INT(11) NOT NULL DEFAULT '1';
