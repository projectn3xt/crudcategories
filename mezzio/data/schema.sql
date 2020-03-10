SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime not null,
  `updated_at` datetime null,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
BEGIN;
INSERT INTO `categories` VALUES (1, 'Medicamentos', NULL, now(), NULL);
INSERT INTO `categories` VALUES (2, 'Dermocosméticos', NULL, now(), NULL);
INSERT INTO `categories` VALUES (3, 'Estética', NULL, now(), NULL);
INSERT INTO `categories` VALUES (4, 'Higiene', NULL, now(), NULL);
INSERT INTO `categories` VALUES (5, 'Maquiagem', NULL, now(), NULL);
INSERT INTO `categories` VALUES (6, 'Nutrição', NULL, now(), NULL);
COMMIT;


SET FOREIGN_KEY_CHECKS = 1;