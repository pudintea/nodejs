CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_nama` varchar(128) NOT NULL,
  `users_email` varchar(128) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_active` tinyint(1) unsigned NOT NULL,
  `users_level` enum('Admin', 'Sekolah') NOT NULL,
  `users_token` varchar(255) NOT NULL,
  `users_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
--
--

CREATE VIEW v_users
AS
SELECT id_users, users_nama, users_email, users_active, users_level, users_token FROM `users`;