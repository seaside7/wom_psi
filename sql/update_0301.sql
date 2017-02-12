ALTER TABLE admin RENAME adminuser;
alter table adminuser add column userid varchar(50) not null first;
alter table adminuser add column role varchar(5) not null;
alter table adminuser add column regional varchar(10) not null;

DELETE FROM adminuser;
INSERT INTO adminuser (userid, pass, role, regional) VALUES 
('admin', MD5('admin'), '1', 'HO'),
('JATASE_ADMIN', MD5('admin'), '2', 'JATASE'),
('JABAR_ADMIN', MD5('admin'), '2', 'JABAR'),
('JATENG_ADMIN', MD5('admin'), '2', 'JATENG'),
('JATIM_ADMIN', MD5('admin'), '2', 'JATIM'),
('SUMBAGUT_ADMIN', MD5('admin'), '2', 'SUMBAGUT'),
('SUMBAGSEL_ADMIN', MD5('admin'), '2', 'SUMBAGSEL'),
('KALSUL_ADMIN', MD5('admin'), '2', 'KALSUL'),
('JATASE', MD5('admin'), '3', 'JATASE'),
('JABAR', MD5('admin'), '3', 'JABAR'),
('JATENG', MD5('admin'), '3', 'JATENG'),
('JATIM', MD5('admin'), '3', 'JATIM'),
('SUMBAGUT', MD5('admin'), '3', 'SUMBAGUT'),
('SUMBAGSEL', MD5('admin'), '3', 'SUMBAGSEL'),
('KALSUL', MD5('admin'), '3', 'KALSUL');

alter table user add column regional varchar(10) not null;
UPDATE user SET regional = 'HO';