-- --------------------------------------------------------
-- Host:                         IntraWeb.lts
-- Versión del servidor:         5.7.25-0ubuntu0.16.04.2 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla admin_intraweb.accounts_clients
CREATE TABLE IF NOT EXISTS `accounts_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `address` text,
  `observations` text,
  `geo_address` text,
  `address_invoices` text,
  `geo_address_invoices` text,
  `create` datetime DEFAULT CURRENT_TIMESTAMP,
  `update` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_accounts_clients_clients` (`client`),
  KEY `FK_accounts_clients_contacts` (`contact`),
  CONSTRAINT `accounts_clients_ibfk_1` FOREIGN KEY (`client`) REFERENCES `clients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `accounts_clients_ibfk_2` FOREIGN KEY (`contact`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.actions_performances_employees
CREATE TABLE IF NOT EXISTS `actions_performances_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.arls
CREATE TABLE IF NOT EXISTS `arls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`),
  KEY `code_key` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.attributes
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `type_medition` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_attributes_types_meditions` (`type_medition`),
  CONSTRAINT `FK_attributes_types_meditions` FOREIGN KEY (`type_medition`) REFERENCES `types_meditions` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.attributes_services_clients
CREATE TABLE IF NOT EXISTS `attributes_services_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) DEFAULT NULL,
  `attribute` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `iva` int(11) DEFAULT '0',
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_attributes_services_clients_attributes` (`attribute`),
  KEY `account` (`account`),
  CONSTRAINT `attributes_services_clients_ibfk_1` FOREIGN KEY (`account`) REFERENCES `accounts_clients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `attributes_services_clients_ibfk_2` FOREIGN KEY (`attribute`) REFERENCES `attributes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.auditors_clients
CREATE TABLE IF NOT EXISTS `auditors_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_auditors_clients_contacts` (`contact`),
  KEY `FK_auditors_clients_clients` (`client`),
  CONSTRAINT `auditors_clients_ibfk_1` FOREIGN KEY (`client`) REFERENCES `clients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `auditors_clients_ibfk_2` FOREIGN KEY (`contact`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `identification_type` int(11) NOT NULL,
  `identification_number` varchar(50) DEFAULT NULL,
  `social_reason` varchar(100) DEFAULT NULL,
  `tradename` varchar(100) DEFAULT NULL,
  `society_type` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `geo_address` varchar(100) DEFAULT NULL,
  `legal_representative` int(11) NOT NULL,
  `contact_principal` int(11) NOT NULL,
  `enable_audit` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_clients_types_clients` (`type`),
  KEY `FK_clients_types_identifications` (`identification_type`),
  KEY `FK_clients_geo_departments` (`department`),
  KEY `FK_clients_contacts` (`legal_representative`),
  KEY `FK_clients_contacts_2` (`contact_principal`),
  KEY `FK_clients_types_societys` (`society_type`),
  KEY `FK_clients_geo_citys` (`city`),
  CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`legal_representative`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`contact_principal`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `clients_ibfk_3` FOREIGN KEY (`city`) REFERENCES `geo_citys` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `clients_ibfk_4` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `clients_ibfk_5` FOREIGN KEY (`type`) REFERENCES `types_clients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `clients_ibfk_6` FOREIGN KEY (`identification_type`) REFERENCES `types_identifications` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `clients_ibfk_7` FOREIGN KEY (`society_type`) REFERENCES `types_societys` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.config_options
CREATE TABLE IF NOT EXISTS `config_options` (
  `name` varchar(50) NOT NULL,
  `result` text NOT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identification_type` int(11) DEFAULT NULL,
  `identification_number` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) NOT NULL,
  `second_surname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `phone_mobile` varchar(20) DEFAULT NULL,
  `mail` varchar(200) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `geo_address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_contacts_types_identifications` (`identification_type`),
  KEY `FK_contacts_geo_departments` (`department`),
  KEY `FK_contacts_geo_citys` (`city`),
  CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`city`) REFERENCES `geo_citys` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `contacts_ibfk_2` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `contacts_ibfk_3` FOREIGN KEY (`identification_type`) REFERENCES `types_identifications` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.contracts_clients
CREATE TABLE IF NOT EXISTS `contracts_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_contracts_clients_quotations_clients` (`quotation`),
  KEY `FK_contracts_clients_clients` (`client`),
  CONSTRAINT `contracts_clients_ibfk_1` FOREIGN KEY (`client`) REFERENCES `clients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `contracts_clients_ibfk_2` FOREIGN KEY (`quotation`) REFERENCES `quotations_clients` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.crew_clients
CREATE TABLE IF NOT EXISTS `crew_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  `type_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_crew_clients_clients` (`client`),
  KEY `FK_crew_clients_contacts` (`contact`),
  KEY `FK_crew_clients_types_contacts` (`type_contact`),
  CONSTRAINT `crew_clients_ibfk_1` FOREIGN KEY (`client`) REFERENCES `clients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `crew_clients_ibfk_2` FOREIGN KEY (`contact`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `crew_clients_ibfk_3` FOREIGN KEY (`type_contact`) REFERENCES `types_contacts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.crew_employees
CREATE TABLE IF NOT EXISTS `crew_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  `type_contact` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_contacts_employees_employees` (`employee`),
  KEY `FK_contacts_employees_contacts` (`contact`),
  KEY `FK_crew_employees_types_contacts` (`type_contact`),
  CONSTRAINT `crew_employees_ibfk_1` FOREIGN KEY (`contact`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `crew_employees_ibfk_2` FOREIGN KEY (`employee`) REFERENCES `employees` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `crew_employees_ibfk_3` FOREIGN KEY (`type_contact`) REFERENCES `types_contacts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.crew_vehicles
CREATE TABLE IF NOT EXISTS `crew_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charge` int(11) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_drivers_vehicles_persons` (`employee`),
  KEY `FK_drivers_vehicles_vehicles` (`vehicle`),
  KEY `id` (`id`),
  KEY `FK_crew_vehicles_employee_charges` (`charge`),
  CONSTRAINT `crew_vehicles_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employees` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `crew_vehicles_ibfk_2` FOREIGN KEY (`charge`) REFERENCES `types_charges` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `crew_vehicles_ibfk_3` FOREIGN KEY (`vehicle`) REFERENCES `vehicles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `second_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `second_surname` varchar(50) DEFAULT NULL,
  `identification_type` int(11) DEFAULT NULL,
  `identification_number` varchar(50) DEFAULT NULL,
  `identification_date_expedition` date DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `blood_type` int(11) DEFAULT NULL,
  `blood_rh` int(11) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `number_phone` varchar(50) DEFAULT NULL,
  `number_mobile` varchar(50) DEFAULT NULL,
  `company_date_entry` date DEFAULT NULL,
  `company_date_out` date DEFAULT NULL,
  `company_mail` varchar(50) DEFAULT NULL,
  `company_number_phone` varchar(50) DEFAULT NULL,
  `company_number_mobile` varchar(50) DEFAULT NULL,
  `avatar` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `eps` int(11) DEFAULT NULL,
  `arl` int(11) DEFAULT NULL,
  `pension_fund` int(11) DEFAULT NULL,
  `compensation_fund` int(11) DEFAULT NULL,
  `severance_fund` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `geo_address` varchar(100) DEFAULT NULL,
  `observations` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_persons_arl` (`arl`),
  KEY `FK_persons_blood_rhs` (`blood_rh`),
  KEY `FK_persons_blood_types` (`blood_type`),
  KEY `FK_persons_compensation_funds` (`compensation_fund`),
  KEY `FK_persons_eps` (`eps`),
  KEY `FK_persons_identification_types` (`identification_type`),
  KEY `FK_persons_pension_funds` (`pension_fund`),
  KEY `FK_persons_status_employee` (`status`),
  KEY `FK_persons_severance_funds` (`severance_fund`),
  KEY `FK_employees_geo_departments` (`department`),
  KEY `FK_employees_geo_citys` (`city`),
  KEY `FK_employees_pictures` (`avatar`),
  CONSTRAINT `FK_employees_arls` FOREIGN KEY (`arl`) REFERENCES `arls` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_pictures` FOREIGN KEY (`avatar`) REFERENCES `pictures_2` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`eps`) REFERENCES `eps` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `employees_ibfk_10` FOREIGN KEY (`identification_type`) REFERENCES `types_identifications` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`compensation_fund`) REFERENCES `funds_compensations` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`pension_fund`) REFERENCES `funds_pensions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `employees_ibfk_4` FOREIGN KEY (`severance_fund`) REFERENCES `funds_severances` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `employees_ibfk_5` FOREIGN KEY (`city`) REFERENCES `geo_citys` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `employees_ibfk_6` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `employees_ibfk_7` FOREIGN KEY (`status`) REFERENCES `status_employees` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `employees_ibfk_8` FOREIGN KEY (`blood_type`) REFERENCES `types_bloods` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `employees_ibfk_9` FOREIGN KEY (`blood_rh`) REFERENCES `types_bloods_rhs` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.eps
CREATE TABLE IF NOT EXISTS `eps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`),
  KEY `code_key` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.funds_compensations
CREATE TABLE IF NOT EXISTS `funds_compensations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.funds_pensions
CREATE TABLE IF NOT EXISTS `funds_pensions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.funds_severances
CREATE TABLE IF NOT EXISTS `funds_severances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.galery_vehicles
CREATE TABLE IF NOT EXISTS `galery_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` int(11) NOT NULL,
  `vehicle` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_galery_vehicles_images` (`picture`),
  KEY `FK_galery_vehicles_vehicles` (`vehicle`),
  CONSTRAINT `FK_galery_vehicles_vehicles` FOREIGN KEY (`vehicle`) REFERENCES `vehicles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `galery_vehicles_ibfk_1` FOREIGN KEY (`picture`) REFERENCES `pictures` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.geo_citys
CREATE TABLE IF NOT EXISTS `geo_citys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `department` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `departamento_id` (`department`),
  KEY `id` (`id`),
  CONSTRAINT `FK_geo_citys_geo_departments` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1102 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.geo_departments
CREATE TABLE IF NOT EXISTS `geo_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.log_auth
CREATE TABLE IF NOT EXISTS `log_auth` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `host` text NOT NULL,
  `real_ip` text NOT NULL,
  `forwarded_for` text NOT NULL,
  `user_agent` text NOT NULL,
  `accept` text,
  `referer` text,
  `cookie` text,
  `server_address` text,
  `server_name` text,
  `server_port` text,
  `remote_address` text,
  `script_filename` text,
  `redirect_url` varchar(50) DEFAULT NULL,
  `request_method` varchar(10) DEFAULT NULL,
  `request_uri` varchar(50) DEFAULT NULL,
  `time` text,
  `time_float` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `redirect_url` (`redirect_url`),
  KEY `request_uri` (`request_uri`),
  KEY `request_method` (`request_method`)
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `data` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.pictures
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `size` int(32) NOT NULL,
  `data` mediumtext NOT NULL,
  `type` varchar(50) NOT NULL,
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.pictures_2
CREATE TABLE IF NOT EXISTS `pictures_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.quotations_clients
CREATE TABLE IF NOT EXISTS `quotations_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  `values` text NOT NULL,
  `status` int(1) DEFAULT '0',
  `create` datetime DEFAULT CURRENT_TIMESTAMP,
  `update` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `validity` int(4) DEFAULT '0',
  `accept` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_quotations_clients_clients` (`client`),
  KEY `FK_quotations_clients_accounts_clients` (`account`),
  CONSTRAINT `quotations_clients_ibfk_1` FOREIGN KEY (`account`) REFERENCES `accounts_clients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `quotations_clients_ibfk_2` FOREIGN KEY (`client`) REFERENCES `clients` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.reasons_performances_employees
CREATE TABLE IF NOT EXISTS `reasons_performances_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.redicated_clients
CREATE TABLE IF NOT EXISTS `redicated_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `consecutive` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `object` text NOT NULL,
  `description_service` text NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `additional_notes` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_redicated_clients` (`client`),
  CONSTRAINT `redicated_clients_ibfk_1` FOREIGN KEY (`client`) REFERENCES `clients` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `type_medition` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`),
  KEY `FK_services_payments_types` (`type_medition`),
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`type_medition`) REFERENCES `types_meditions` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.status_employees
CREATE TABLE IF NOT EXISTS `status_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.status_services
CREATE TABLE IF NOT EXISTS `status_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `color` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`color`),
  KEY `id` (`id`),
  KEY `code_key` (`color`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.status_vehicles
CREATE TABLE IF NOT EXISTS `status_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.types_bloods
CREATE TABLE IF NOT EXISTS `types_bloods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.types_bloods_rhs
CREATE TABLE IF NOT EXISTS `types_bloods_rhs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.types_charges
CREATE TABLE IF NOT EXISTS `types_charges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.types_clients
CREATE TABLE IF NOT EXISTS `types_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.types_contacts
CREATE TABLE IF NOT EXISTS `types_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.types_fuels
CREATE TABLE IF NOT EXISTS `types_fuels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.types_identifications
CREATE TABLE IF NOT EXISTS `types_identifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.types_meditions
CREATE TABLE IF NOT EXISTS `types_meditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.types_societys
CREATE TABLE IF NOT EXISTS `types_societys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.types_vehicles
CREATE TABLE IF NOT EXISTS `types_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.url_redirects
CREATE TABLE IF NOT EXISTS `url_redirects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `module` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `module` (`module`),
  KEY `section` (`section`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `names` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `second_surname` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `registered` datetime DEFAULT CURRENT_TIMESTAMP,
  `avatar` int(11) DEFAULT NULL,
  `mail` varchar(150) NOT NULL,
  `hash` text NOT NULL,
  `permissions` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id` (`id`),
  KEY `FK_users_permissions` (`permissions`),
  KEY `FK_users_pictures` (`avatar`),
  CONSTRAINT `FK_users_permissions` FOREIGN KEY (`permissions`) REFERENCES `permissions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_users_pictures` FOREIGN KEY (`avatar`) REFERENCES `pictures_2` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_intraweb.vehicles
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `license_plate` varchar(50) NOT NULL COMMENT 'Placa',
  `brand` varchar(150) DEFAULT NULL COMMENT 'Marca',
  `model` varchar(150) DEFAULT NULL COMMENT 'Modelo',
  `type_vehicle` int(11) NOT NULL COMMENT 'Tipo de vehiculo',
  `passangers_capacity` int(11) DEFAULT NULL COMMENT 'Capacidad de pasajeros',
  `type_fuel` int(11) NOT NULL COMMENT 'Combustible',
  `cilindraje` varchar(50) DEFAULT NULL COMMENT 'Cilindraje',
  `holder` int(11) NOT NULL COMMENT 'Titular',
  `propietary` int(11) NOT NULL COMMENT 'Propietario',
  `card_propiety_number` varchar(250) DEFAULT NULL COMMENT 'Numero Tarjeta Propiedad',
  `chassis_number` varchar(100) DEFAULT NULL COMMENT 'Numero chasis',
  `soat_number` varchar(100) DEFAULT NULL COMMENT 'Numero SOAT',
  `third_party_number` varchar(100) DEFAULT NULL COMMENT 'Numero Poliza Terceros',
  `soat_date_expiration` date DEFAULT NULL COMMENT 'Fecha Vencimiento SOAT',
  `third_party_date_expiration` date DEFAULT NULL COMMENT 'Fecha Vencimiento Poliza Terceros',
  `capacity_with_enhancement` varchar(100) DEFAULT NULL COMMENT 'Capacidad con Realce',
  `capacity_without_enhancement` varchar(100) DEFAULT NULL COMMENT 'Capacidad sin Realce',
  `base_weight` varchar(100) DEFAULT NULL COMMENT 'Peso Base Vehiculo',
  `rent_cost` varchar(100) DEFAULT NULL COMMENT 'Costo de renta',
  `status` int(11) NOT NULL COMMENT 'Estado',
  PRIMARY KEY (`id`),
  UNIQUE KEY `license_plate` (`license_plate`),
  KEY `id` (`id`),
  KEY `FK_vehicles_categorys_vehicles` (`type_vehicle`),
  KEY `FK_vehicles_fuel_types` (`type_fuel`),
  KEY `FK_vehicles_status_vehicles` (`status`),
  KEY `FK_vehicles_contacts` (`holder`),
  KEY `FK_vehicles_contacts_2` (`propietary`),
  CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`type_vehicle`) REFERENCES `types_vehicles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `vehicles_ibfk_2` FOREIGN KEY (`holder`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `vehicles_ibfk_3` FOREIGN KEY (`propietary`) REFERENCES `contacts` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `vehicles_ibfk_4` FOREIGN KEY (`status`) REFERENCES `status_vehicles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `vehicles_ibfk_5` FOREIGN KEY (`type_fuel`) REFERENCES `types_fuels` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
