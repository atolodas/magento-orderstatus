<?php
$installer = $this;
$installer->startSetup();
$installer->run("
	-- DROP TABLE IF EXISTS `orderstatus_history`;
	CREATE TABLE `orderstatus_history` (
		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`order_id` int(11) DEFAULT NULL,
		`user` varchar(255) DEFAULT NULL,
		`old_status` varchar(255) DEFAULT NULL,
		`new_status` varchar(255) DEFAULT NULL,
		`date` datetime DEFAULT NULL,
		PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$installer->endSetup();