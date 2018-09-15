offers
id
from_user_id
to_user_id
request_message
free_message
status (offered, accepted, called, cancelled)
accepted
cancelled
called
created
modified

CREATE TABLE `offers` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `from_user_id` int(11) NOT NULL,
 `to_user_id` int(11) NOT NULL,
 `request_message` text,
 `free_message` text,
 `status` int(11) DEFAULT '0',
 `accepted` datetime DEFAULT NULL,
 `cancelled` datetime DEFAULT NULL,
 `called` datetime DEFAULT NULL,
 `created` datetime DEFAULT NULL,
 `modified` datetime DEFAULT NULL,
 PRIMARY KEY (`id`),
 INDEX idx_offers_1(`from_user_id`),
 INDEX idx_offers_2(`to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user_peers` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `peer_id` int(11) NOT NULL,
 `created` datetime DEFAULT NULL,
 `modified` datetime DEFAULT NULL,
 PRIMARY KEY (`id`),
 INDEX idx_user_peers_1(`user_id`),
 INDEX idx_user_peers_2(`peer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
