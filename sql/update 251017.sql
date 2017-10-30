ALTER TABLE `user` ADD `sumber` VARCHAR(10) NULL DEFAULT NULL AFTER `posisi`;
UPDATE user SET sumber = 'Internal' WHERE LENGTH(no_ktp) <= 10;
UPDATE user SET sumber = 'Eksternal' WHERE LENGTH(no_ktp) > 10;