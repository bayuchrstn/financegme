INSERT INTO `gmd_usergroup` (`up`, `name`, `code`, `regional`, `area`) VALUES
('0',	'Ts & Noc',	'tks',	'03',	'bali'),
('0',	'Management',	'mng',	'03',	'bali'),
('0',	'Wharehouse',	'gdg',	'03',	'bali'),
('0',	'Super User',	'su',	'03',	'bali'),
('0',	'Marketing',	'mkt',	'03',	'bali'),
('0',	'NOC',	'noc',	'03',	'bali'),
('0',	'Admin',	'adm',	'03',	'bali'),
('0',	'tester',	'tes',	'03',	'bali'),
('0',	'Root',	'root',	'03',	'bali'),
('0',	'Spv Teknis',	'svv',	'03',	'bali'),
('0',	'Sekretaris',	'skt',	'03',	'bali'),
('0',	'Finance',	'fn',	'03',	'bali'),
('0',	'Manajer Teknis',	'mntek',	'03',	'bali'),
('0',	'Manager Marketing',	'mnket',	'03',	'bali'),
('0',	'Sales Admin',	'mkt_admin',	'03',	'bali'),
('0',	'Marketing Communications',	'mkc',	'03',	'bali'),
('0',	'HRD',	'hrd',	'03',	'bali'),
('0',	'General',	'general',	'03',	'bali'),
('0',	'Ujicoba',	'uji',	'03',	'bali'),
('0',	'Customer Experience',	'ce',	'03',	'bali'),
('0',	'Admin teknis',	'at',	'03',	'bali');

INSERT INTO `gmd_usergroup` (`up`, `name`, `code`, `regional`, `area`) VALUES
('0',	'Ts & Noc',	'tks',	'02',	'semarang'),
('0',	'Management',	'mng',	'02',	'semarang'),
('0',	'Wharehouse',	'gdg',	'02',	'semarang'),
('0',	'Super User',	'su',	'02',	'semarang'),
('0',	'Marketing',	'mkt',	'02',	'semarang'),
('0',	'NOC',	'noc',	'02',	'semarang'),
('0',	'Admin',	'adm',	'02',	'semarang'),
('0',	'tester',	'tes',	'02',	'semarang'),
('0',	'Root',	'root',	'02',	'semarang'),
('0',	'Spv Teknis',	'svv',	'02',	'semarang'),
('0',	'Sekretaris',	'skt',	'02',	'semarang'),
('0',	'Finance',	'fn',	'02',	'semarang'),
('0',	'Manajer Teknis',	'mntek',	'02',	'semarang'),
('0',	'Manager Marketing',	'mnket',	'02',	'semarang'),
('0',	'Sales Admin',	'mkt_admin',	'02',	'semarang'),
('0',	'Marketing Communications',	'mkc',	'02',	'semarang'),
('0',	'HRD',	'hrd',	'02',	'semarang'),
('0',	'General',	'general',	'02',	'semarang'),
('0',	'Ujicoba',	'uji',	'02',	'semarang'),
('0',	'Customer Experience',	'ce',	'02',	'semarang'),
('0',	'Admin teknis',	'at',	'02',	'semarang');

INSERT INTO `gmd_usergroup` (`up`, `name`, `code`, `regional`, `area`) VALUES
('0',	'Ts & Noc',	'tks',	'01',	'jogja'),
('0',	'Management',	'mng',	'01',	'jogja'),
('0',	'Wharehouse',	'gdg',	'01',	'jogja'),
('0',	'Super User',	'su',	'01',	'jogja'),
('0',	'Marketing',	'mkt',	'01',	'jogja'),
('0',	'NOC',	'noc',	'01',	'jogja'),
('0',	'Admin',	'adm',	'01',	'jogja'),
('0',	'tester',	'tes',	'01',	'jogja'),
('0',	'Root',	'root',	'01',	'jogja'),
('0',	'Spv Teknis',	'svv',	'01',	'jogja'),
('0',	'Sekretaris',	'skt',	'01',	'jogja'),
('0',	'Finance',	'fn',	'01',	'jogja'),
('0',	'Manajer Teknis',	'mntek',	'01',	'jogja'),
('0',	'Manager Marketing',	'mnket',	'01',	'jogja'),
('0',	'Sales Admin',	'mkt_admin',	'01',	'jogja'),
('0',	'Marketing Communications',	'mkc',	'01',	'jogja'),
('0',	'HRD',	'hrd',	'01',	'jogja'),
('0',	'General',	'general',	'01',	'jogja'),
('0',	'Ujicoba',	'uji',	'01',	'jogja'),
('0',	'Customer Experience',	'ce',	'01',	'jogja'),
('0',	'Admin teknis',	'at',	'01',	'jogja');

UPDATE gmd_usergroup SET code=CONCAT(code, '_', regional) WHERE regional='02'
UPDATE gmd_usergroup SET code=CONCAT(code, '_', regional) WHERE regional='03'

UPDATE gmd_users set view_scope='area';
UPDATE gmd_users set level=level_old;
UPDATE gmd_users set view_scope='regional' where level='sr';
UPDATE gmd_users set view_scope='global' where level='su';

UPDATE gmd_users set departement='teknis' where level='tks';
