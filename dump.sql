DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `view_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_mark` int(11) DEFAULT 0,
  `views_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_address` (`ip_address`,`user_agent`,`image_mark`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
