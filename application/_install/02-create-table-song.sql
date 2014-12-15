CREATE TABLE `rab`.`contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(200) utf8_unicode_ci NOT NULL,
  `firstname` varchar(200) utf8_unicode_ci NOT NULL,
  `lastname` varchar(200) utf8_unicode_ci NOT NULL,
  `email` varchar(200) utf8_unicode_ci NOT NULL,
  `is_volunteer` tinyint(1) NOT NULL,
  `is_customer` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
