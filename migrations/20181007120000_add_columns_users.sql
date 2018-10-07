alter table users add column `image1` varchar(255) DEFAULT NULL after `birth`;
alter table users add column `dir1` varchar(255) DEFAULT NULL after `image1`;
alter table users add column `is_katalist` tinyint(1) DEFAULT 0 after `birth`;
