-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.20 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных yii_nppk_advanced
CREATE DATABASE IF NOT EXISTS `yii_nppk_advanced` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `yii_nppk_advanced`;

-- Дамп структуры для таблица yii_nppk_advanced.banner
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `FK_banner_image_user_created` (`created_by`),
  KEY `FK_banner_image_user_updated` (`updated_by`),
  CONSTRAINT `FK_banner_image_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_banner_image_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.banner: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` (`id`, `name`, `published`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'main_slider', 1, 1, 1, 0, 1549009047),
	(2, 'new_slider', 0, 1, 1, 1549008949, 1549008949);
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.banner_to_image
CREATE TABLE IF NOT EXISTS `banner_to_image` (
  `banner_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `sort_order` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.banner_to_image: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `banner_to_image` DISABLE KEYS */;
INSERT INTO `banner_to_image` (`banner_id`, `image_id`, `sort_order`) VALUES
	(2, 145, 0),
	(2, 146, 0),
	(2, 147, 0),
	(2, 148, 0),
	(2, 153, 0),
	(2, 154, 0),
	(1, 145, 0);
/*!40000 ALTER TABLE `banner_to_image` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `on_home` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_category_user_created` (`created_by`),
  KEY `FK_category_user_updated` (`updated_by`),
  CONSTRAINT `FK_category_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_category_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.category: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `title`, `description`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `sort_order`, `on_home`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(2, 'Специальности', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'professions', 'Специальности', NULL, NULL, 1, 2, 1, 1, 1, 0, 0),
	(3, 'Мероприятия', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'mp', 'Мероприятия', NULL, NULL, 1, 3, 1, 1, 1, 0, 0),
	(5, 'О нас', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'about', 'О нас', NULL, NULL, 1, 5, 1, 1, 1, 0, 0),
	(6, 'Платное образование', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'platnoye-obrazovaniye', 'Платное образование', NULL, NULL, 1, 1, 0, 1, 1, 0, 0),
	(7, 'Наши достижения', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'nashi-dostzhenia', 'Наши достижения', NULL, NULL, 1, 7, 1, 1, 1, 0, 0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.category_to_post
CREATE TABLE IF NOT EXISTS `category_to_post` (
  `category_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.category_to_post: ~16 rows (приблизительно)
/*!40000 ALTER TABLE `category_to_post` DISABLE KEYS */;
INSERT INTO `category_to_post` (`category_id`, `post_id`) VALUES
	(3, 3),
	(2, 5),
	(7, 12),
	(6, 6),
	(3, 2),
	(5, 2),
	(3, 14),
	(7, 14),
	(5, 14),
	(6, 14),
	(2, 14),
	(3, 13),
	(7, 13),
	(5, 13),
	(6, 13),
	(2, 13),
	(6, 16),
	(3, 17);
/*!40000 ALTER TABLE `category_to_post` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.group
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_group_user_created` (`created_by`),
  KEY `FK_group_user_updated` (`updated_by`),
  CONSTRAINT `FK_group_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_group_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='Список групп учащихся';

-- Дамп данных таблицы yii_nppk_advanced.group: ~30 rows (приблизительно)
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`id`, `name`, `sort_order`, `published`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, '101', 0, 1, 1, 1, 1538454740, 1538454740),
	(2, '121', 0, 1, 1, 1, 1538454740, 1538454740),
	(3, '141', 0, 1, 1, 1, 1538454740, 1538454740),
	(4, '181', 0, 1, 1, 1, 1538454740, 1538454740),
	(5, '201', 0, 1, 1, 1, 1538454740, 1538454740),
	(6, '221', 0, 1, 1, 1, 1538454740, 1538454740),
	(7, '222', 0, 1, 1, 1, 1538454740, 1538454740),
	(8, '241', 0, 1, 1, 1, 1538454740, 1538454740),
	(9, '261', 0, 1, 1, 1, 1538454740, 1538454740),
	(10, '271', 0, 1, 1, 1, 1538454740, 1538454740),
	(11, '281', 0, 1, 1, 1, 1538454740, 1538454740),
	(12, '291', 0, 1, 1, 1, 1538454740, 1538454740),
	(13, '301', 0, 1, 1, 1, 1538454740, 1538454740),
	(14, '321', 0, 1, 1, 1, 1538454740, 1538454740),
	(15, '341', 0, 1, 1, 1, 1538454740, 1538454740),
	(16, '351', 0, 1, 1, 1, 1538454740, 1538454740),
	(17, '361', 0, 1, 1, 1, 1538454740, 1538454740),
	(18, '381', 0, 1, 1, 1, 1538454740, 1538454740),
	(19, '391', 0, 1, 1, 1, 1538454740, 1538454740),
	(20, '401', 0, 1, 1, 1, 1538454740, 1538454740),
	(21, '421', 0, 1, 1, 1, 1538454740, 1538454740),
	(22, '441', 0, 1, 1, 1, 1538454740, 1538454740),
	(23, '442', 0, 1, 1, 1, 1538454740, 1538454740),
	(24, '443', 0, 1, 1, 1, 1538454740, 1538454740),
	(25, '461', 0, 1, 1, 1, 1538454740, 1538454740),
	(26, '481', 0, 1, 1, 1, 1538454740, 1538454740),
	(27, '521', 0, 1, 1, 1, 1538454740, 1538454740),
	(28, '541', 0, 1, 1, 1, 1538454740, 1538454740),
	(29, '542', 0, 1, 1, 1, 1538454740, 1538454740),
	(30, '666', 1001, 1, 1, 1, 1538454740, 1538455022);
/*!40000 ALTER TABLE `group` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.image
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `src` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `src` (`src`),
  KEY `FK_image_user_created` (`created_by`),
  KEY `FK_image_user_updated` (`updated_by`),
  CONSTRAINT `FK_image_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_image_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.image: ~154 rows (приблизительно)
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` (`id`, `title`, `content`, `src`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Гимнастический зал', NULL, '/data/rooms/gym1.JPG', 1, NULL, 0, 0),
	(2, 'Гимнастический зал', NULL, '/data/rooms/gym2.JPG', 1, NULL, 0, 0),
	(3, 'Гимнастический зал', NULL, '/data/rooms/gym3.JPG', 1, NULL, 0, 0),
	(4, 'Спортивный зал', NULL, '/data/rooms/gym1_1.JPG', 1, NULL, 0, 0),
	(5, 'Спортивный зал', NULL, '/data/rooms/gym1_2.JPG', 1, NULL, 0, 0),
	(6, 'Спортивный зал', NULL, '/data/rooms/gym1_3.JPG', 1, NULL, 0, 0),
	(7, 'Спортивный зал', NULL, '/data/rooms/gym1_4.JPG', 1, NULL, 0, 0),
	(8, 'Спортивный зал', NULL, '/data/rooms/gym1_5.JPG', 1, NULL, 0, 0),
	(9, '4 кабинет', NULL, '/data/rooms/kab4_1.JPG', 1, NULL, 0, 0),
	(10, '4 кабинет', NULL, '/data/rooms/kab4_2.JPG', 1, NULL, 0, 0),
	(11, '4 кабинет', NULL, '/data/rooms/kab4_3.JPG', 1, NULL, 0, 0),
	(12, '4 кабинет', NULL, '/data/rooms/kab4_4.JPG', 1, NULL, 0, 0),
	(13, '5 кабинет', NULL, '/data/rooms/kab5_1.JPG', 1, NULL, 0, 0),
	(14, '5 кабинет', NULL, '/data/rooms/kab5_2.JPG', 1, NULL, 0, 0),
	(15, '5 кабинет', NULL, '/data/rooms/kab5_3.JPG', 1, NULL, 0, 0),
	(16, '5 кабинет', NULL, '/data/rooms/kab5_4.JPG', 1, NULL, 0, 0),
	(17, '6 кабинет', NULL, '/data/rooms/kab6_1.JPG', 1, NULL, 0, 0),
	(18, '6 кабинет', NULL, '/data/rooms/kab6_2.JPG', 1, NULL, 0, 0),
	(19, '6 кабинет', NULL, '/data/rooms/kab6_3.JPG', 1, NULL, 0, 0),
	(20, '6 кабинет', NULL, '/data/rooms/kab6_4.JPG', 1, NULL, 0, 0),
	(21, '6 кабинет', NULL, '/data/rooms/kab6_5.JPG', 1, NULL, 0, 0),
	(22, '6 кабинет', NULL, '/data/rooms/kab6_6.JPG', 1, NULL, 0, 0),
	(23, '201 кабинет', NULL, '/data/rooms/kab201_1.JPG', 1, NULL, 0, 0),
	(24, '201 кабинет', NULL, '/data/rooms/kab201_2.JPG', 1, NULL, 0, 0),
	(25, '201 кабинет', NULL, '/data/rooms/kab201_3.JPG', 1, NULL, 0, 0),
	(26, '201 кабинет', NULL, '/data/rooms/kab201_4.JPG', 1, NULL, 0, 0),
	(27, '201 кабинет', NULL, '/data/rooms/kab201_5.JPG', 1, NULL, 0, 0),
	(28, '201 кабинет', NULL, '/data/rooms/kab201_6.JPG', 1, NULL, 0, 0),
	(29, '205 кабинет', NULL, '/data/rooms/kab205_1.JPG', 1, NULL, 0, 0),
	(30, '205 кабинет', NULL, '/data/rooms/kab205_2.JPG', 1, NULL, 0, 0),
	(31, '205 кабинет', NULL, '/data/rooms/kab205_3.JPG', 1, NULL, 0, 0),
	(32, '207 кабинет', NULL, '/data/rooms/kab207_1.JPG', 1, NULL, 0, 0),
	(33, '207 кабинет', NULL, '/data/rooms/kab207_2.JPG', 1, NULL, 0, 0),
	(34, '207 кабинет', NULL, '/data/rooms/kab207_3.JPG', 1, NULL, 0, 0),
	(35, '207 кабинет', NULL, '/data/rooms/kab207_4.JPG', 1, NULL, 0, 0),
	(36, '207 кабинет', NULL, '/data/rooms/kab207_5.JPG', 1, NULL, 0, 0),
	(37, '207 кабинет', NULL, '/data/rooms/kab207_6.JPG', 1, NULL, 0, 0),
	(38, '208 кабинет', NULL, '/data/rooms/kab208_1.JPG', 1, NULL, 0, 0),
	(39, '208 кабинет', NULL, '/data/rooms/kab208_2.JPG', 1, NULL, 0, 0),
	(40, '208 кабинет', NULL, '/data/rooms/kab208_3.JPG', 1, NULL, 0, 0),
	(41, '208 кабинет', NULL, '/data/rooms/kab208_4.JPG', 1, NULL, 0, 0),
	(42, '208 кабинет', NULL, '/data/rooms/kab208_5.JPG', 1, NULL, 0, 0),
	(43, '209 кабинет', NULL, '/data/rooms/kab209_1.JPG', 1, NULL, 0, 0),
	(44, '209 кабинет', NULL, '/data/rooms/kab209_2.JPG', 1, NULL, 0, 0),
	(45, '209 кабинет', NULL, '/data/rooms/kab209_3.JPG', 1, NULL, 0, 0),
	(46, '209 кабинет', NULL, '/data/rooms/kab209_4.JPG', 1, NULL, 0, 0),
	(47, '209 кабинет', NULL, '/data/rooms/kab209_5.JPG', 1, NULL, 0, 0),
	(48, '209 кабинет', NULL, '/data/rooms/kab209_6.JPG', 1, NULL, 0, 0),
	(49, '308 кабинет', NULL, '/data/rooms/kab308_1.JPG', 1, NULL, 0, 0),
	(50, '308 кабинет', NULL, '/data/rooms/kab308_2.JPG', 1, NULL, 0, 0),
	(51, '308 кабинет', NULL, '/data/rooms/kab308_3.JPG', 1, NULL, 0, 0),
	(52, '408 кабинет', NULL, '/data/rooms/kab308_4.JPG', 1, NULL, 0, 0),
	(53, 'Конференцзал', NULL, '/data/rooms/kz1.JPG', 1, NULL, 0, 0),
	(54, 'Конференцзал', NULL, '/data/rooms/kz2.JPG', 1, NULL, 0, 0),
	(55, 'Конференцзал', NULL, '/data/rooms/kz3.JPG', 1, NULL, 0, 0),
	(56, 'Конференцзал', NULL, '/data/rooms/kz4.JPG', 1, NULL, 0, 0),
	(57, 'Конференцзал', NULL, '/data/rooms/kz5.JPG', 1, NULL, 0, 0),
	(58, '4 кабинет', NULL, '/data/rooms/kab4_5.JPG', 1, NULL, 0, 0),
	(60, '107 кабинет', NULL, '/data/rooms/kab107_1.JPG', 1, NULL, 0, 0),
	(61, '107 кабинет', NULL, '/data/rooms/kab107_2.JPG', 1, NULL, 0, 0),
	(62, '107 кабинет', NULL, '/data/rooms/kab107_3.JPG', 1, NULL, 0, 0),
	(63, '107 кабинет', NULL, '/data/rooms/kab107_4.JPG', 1, NULL, 0, 0),
	(64, '107 кабинет', NULL, '/data/rooms/kab107_5.JPG', 1, NULL, 0, 0),
	(65, '111 кабинет', NULL, '/data/rooms/kab111_1.JPG', 1, NULL, 0, 0),
	(66, '111 кабинет', NULL, '/data/rooms/kab111_2.JPG', 1, NULL, 0, 0),
	(67, '111 кабинет', NULL, '/data/rooms/kab111_3.JPG', 1, NULL, 0, 0),
	(68, '111 кабинет', NULL, '/data/rooms/kab111_4.JPG', 1, NULL, 0, 0),
	(69, '111 кабинет', NULL, '/data/rooms/kab111_5.JPG', 1, NULL, 0, 0),
	(70, '111 кабинет', NULL, '/data/rooms/kab111_6.JPG', 1, NULL, 0, 0),
	(71, '111 кабинет', NULL, '/data/rooms/kab111_7.JPG', 1, NULL, 0, 0),
	(72, '112 кабинет', NULL, '/data/rooms/kab112_1.JPG', 1, NULL, 0, 0),
	(73, '112 кабинет', NULL, '/data/rooms/kab112_2.JPG', 1, NULL, 0, 0),
	(74, '112 кабинет', NULL, '/data/rooms/kab112_3.JPG', 1, NULL, 0, 0),
	(75, '112 кабинет', NULL, '/data/rooms/kab112_4.JPG', 1, NULL, 0, 0),
	(76, '204 кабинет', NULL, '/data/rooms/kab204_1.JPG', 1, NULL, 0, 0),
	(77, '204 кабинет', NULL, '/data/rooms/kab204_2.JPG', 1, NULL, 0, 0),
	(78, '204 кабинет', NULL, '/data/rooms/kab204_3.JPG', 1, NULL, 0, 0),
	(79, '204 кабинет', NULL, '/data/rooms/kab204_4.JPG', 1, NULL, 0, 0),
	(80, '204 кабинет', NULL, '/data/rooms/kab204_5.JPG', 1, NULL, 0, 0),
	(81, '204 кабинет', NULL, '/data/rooms/kab204_6.JPG', 1, NULL, 0, 0),
	(82, '305 кабинет', NULL, '/data/rooms/kab305_1.JPG', 1, NULL, 0, 0),
	(83, '305 кабинет', NULL, '/data/rooms/kab305_2.JPG', 1, NULL, 0, 0),
	(84, '305 кабинет', NULL, '/data/rooms/kab305_3.JPG', 1, NULL, 0, 0),
	(85, '305 кабинет', NULL, '/data/rooms/kab305_4.JPG', 1, NULL, 0, 0),
	(86, '307 кабинет', NULL, '/data/rooms/kab307_1.JPG', 1, NULL, 0, 0),
	(87, '307 кабинет', NULL, '/data/rooms/kab307_2.JPG', 1, NULL, 0, 0),
	(88, '307 кабинет', NULL, '/data/rooms/kab307_3.JPG', 1, NULL, 0, 0),
	(89, '307 кабинет', NULL, '/data/rooms/kab307_4.JPG', 1, NULL, 0, 0),
	(90, '307 кабинет', NULL, '/data/rooms/kab307_5.JPG', 1, NULL, 0, 0),
	(91, '7 кабинет', NULL, '/data/rooms/kab7_1.JPG', 1, NULL, 0, 0),
	(92, '7 кабинет', NULL, '/data/rooms/kab7_2.JPG', 1, NULL, 0, 0),
	(93, '7 кабинет', NULL, '/data/rooms/kab7_3.JPG', 1, NULL, 0, 0),
	(94, '7 кабинет', NULL, '/data/rooms/kab7_4.JPG', 1, NULL, 0, 0),
	(95, 'Ануфриева Ольга Юриевна', NULL, '/data/teachers/anufrieva-olga-yuryevna.jpg', 1, NULL, 0, 0),
	(96, 'Артемова Наталья Александровна', NULL, '/data/teachers/artemova-natalia-alexandrovna.jpg', 1, NULL, 0, 0),
	(97, 'Виниченко Елена Петровна', NULL, '/data/teachers/vinichenko-yelena-petrovna.jpg', 1, NULL, 0, 0),
	(98, 'Волкова Надежда Ивановна', NULL, '/data/teachers/volkova-nadezhda-ivanovna.jpg', 1, NULL, 0, 0),
	(99, 'Глебова Любовь Сергеевна', NULL, '/data/teachers/glebova-lyubov-sergeyevna.jpg', 1, NULL, 0, 0),
	(100, 'Ганихина Марина Анатольевна', NULL, '/data/teachers/ganikhina-marina-anatolyevna.jpg', 1, NULL, 0, 0),
	(101, 'Балдина Ирина Петровна', NULL, '/data/teachers/baldina-irina-petrovna.jpg', 1, NULL, 0, 0),
	(102, 'Бордун Елена Александровна', NULL, '/data/teachers/bordun-yelena-aleksandrovna.JPG', 1, NULL, 0, 0),
	(103, 'Горбатых Евгения Александровна', NULL, '/data/teachers/gorbatykh-yevgeniya-aleksandrovna.jpg', 1, NULL, 0, 0),
	(104, 'Дмитриенко Константин Евгеньевич', NULL, '/data/teachers/dmitriyenko-konstantin-yevgenyevich.JPG', 1, NULL, 0, 0),
	(105, 'Шальнов Захар Сергеевич', NULL, '/data/teachers/shalnov-zakhar-sergeyevich.JPG', 1, NULL, 0, 0),
	(106, 'Евтющенко Юлия Александровна', NULL, '/data/teachers/yevtyushchenko-yuliya-aleksandrovna.jpg', 1, NULL, 0, 0),
	(107, 'Ермакова Наталья Владимировна', NULL, '/data/teachers/yermakova-natalya-vladimirovna.jpg', 1, NULL, 0, 0),
	(108, 'Сугоняк Наталья Павловна', NULL, '/data/teachers/sugonyak-natalya-pavlovna.jpg', 1, NULL, 0, 0),
	(109, 'Лапицкая Татьяна Владимировна', NULL, '/data/teachers/lapitskaya-tatyana-vladimirovna.jpg', 1, NULL, 0, 0),
	(110, 'Чекушкина Ольга Олеговна', NULL, '/data/teachers/chekushkina-olga-olegovna.jpg', 1, NULL, 0, 0),
	(111, 'Жигло Инна Владимировна', NULL, '/data/teachers/zhiglo-inna-vladimirovna.jpg', 1, NULL, 0, 0),
	(112, 'Пономарева Татьяна Владимировна', NULL, '/data/teachers/ponomareva-tatyana-vladimirovna.jpg', 1, NULL, 0, 0),
	(113, 'Рузанкин Евгений Александрович', NULL, '/data/teachers/ruzankin-yevgeniy-aleksandrovich.jpg', 1, NULL, 0, 0),
	(114, 'Крумм Татьяна Михайловна', NULL, '/data/teachers/krumm-tatyana-mikhaylovna.jpg', 1, NULL, 0, 0),
	(115, 'Моисеева Татьяна Анатольевна', NULL, '/data/teachers/moiseyeva-tatyana-anatolyevna.jpg', 1, NULL, 0, 0),
	(116, 'Обложкина Ирина Михайловна', NULL, '/data/teachers/oblozhkina-irina-mikhaylovna.jpg', 1, NULL, 0, 0),
	(117, 'Лобенко Юлия Владимировна', NULL, '/data/teachers/lobenko-yuliya-vladimirovna.jpg', 1, NULL, 0, 0),
	(118, 'Назарко Ирина Владимировна', NULL, '/data/teachers/nazarko-irina-vladimirovna.jpg', 1, NULL, 0, 0),
	(119, 'Зильбернагель Яна Геннадьевна', NULL, '/data/teachers/zilbernagel-yana-gennadyevna.jpg', 1, NULL, 0, 0),
	(120, 'Заворин Алекснадр Александрович', NULL, '/data/teachers/zavorin-san-sanich.jpg', 1, NULL, 0, 0),
	(121, 'Пастухова Ольга Николаевна', NULL, '/data/teachers/pastukhova-olga-nikolayeva.JPG', 1, NULL, 0, 0),
	(122, 'Плетнева Ольга Федоровна', NULL, '/data/teachers/pletneva-olga-fedorovna.jpg', 1, NULL, 0, 0),
	(123, 'Волкова Елена Геннадьевна', NULL, '/data/teachers/volkova-yelena-gennadyevna.jpg', 1, NULL, 0, 0),
	(124, 'Сердюк Елена Сергеевна', NULL, '/data/teachers/serduk-svetlana-sergeevna.jpg', 1, NULL, 0, 0),
	(125, 'Скрябина Вера Евгеньевна', NULL, '/data/teachers/scryabina-vera-evgeneevna.JPG', 1, NULL, 0, 0),
	(126, 'Лактионов Юрий Васильевич', NULL, '/data/teachers/laktionov-urii-vasilievich.jpg', 1, NULL, 0, 0),
	(127, 'Царенко Марина Сергеевна', NULL, '/data/teachers/carenko-marina-sergeevna.jpg', 1, NULL, 0, 0),
	(128, 'Кремнёв Евгений Русланович', NULL, 'https://pp.userapi.com/c637923/v637923115/c833/LbPxKeQmi40.jpg', 1, NULL, 0, 0),
	(129, 'Авдеев Андрей Сергеевич', NULL, '/data/teachers/avdeyev-andrey-sergeyevich.jpg', 1, NULL, 0, 0),
	(130, 'Сай Екатерина Валерьевна', NULL, '/data/teachers/say-ekaterina-valerievna.jpg', 1, NULL, 0, 0),
	(131, 'Савоськина Людмила Ивановна', NULL, '/data/teachers/savoskina-ludmila-ivanovna.jpg', 1, NULL, 0, 0),
	(132, 'Парфенова Елена Николаевна', NULL, '/data/teachers/parfenova.jpg', 1, NULL, 0, 0),
	(133, 'Немцева Галина Викторовна', NULL, '/data/teachers/namceva.jpg', 1, NULL, 0, 0),
	(134, 'Константинова Татьяна Георгиевна', NULL, '/data/teachers/konstantinova.jpg', 1, NULL, 0, 0),
	(135, 'Крыгина Роза Михайловна', NULL, '/data/teachers/krygina.jpg', 1, NULL, 0, 0),
	(136, 'Корченица Людмила Александровна', NULL, '/data/teachers/korchenica.jpg', 1, NULL, 0, 0),
	(137, 'Короткова Вероника Валерьевна', NULL, '/data/teachers/korotkova.jpg', 1, NULL, 0, 0),
	(138, 'Коновалова Олеся Викторовна', NULL, '/data/teachers/konovalova.jpg', 1, NULL, 0, 0),
	(139, 'Иконникова Людмила Викторовна', NULL, '/data/teachers/ikonnikova.jpg', 1, NULL, 0, 0),
	(140, 'Заварзина Любовь Геннадьевна', NULL, '/data/teachers/zavarzina.jpg', 1, NULL, 0, 0),
	(141, 'Евдокимова Алена Андреевна', NULL, '/data/teachers/evdokimova.jpg', 1, NULL, 0, 0),
	(142, 'Лузан Светлана Сергеевна', NULL, '/data/teachers/luzan.jpg', 1, NULL, 0, 0),
	(143, 'Селиванова Светлана Александровна', NULL, '/data/teachers/selivanova.jpg', 1, NULL, 0, 0),
	(144, 'Симонова Людмила Владимировна', NULL, '/data/teachers/simonova.jpg', 1, NULL, 0, 0),
	(145, 'Инклюзивное образование', NULL, '/data/banner/1.jpg', 1, NULL, 0, 0),
	(146, 'title', NULL, '/data/banner/2.jpg', 1, NULL, 0, 0),
	(147, 'title', NULL, '/data/banner/3.jpg', 1, NULL, 0, 0),
	(148, 'title', NULL, '/data/banner/4.jpg', 1, NULL, 0, 0),
	(149, 'title', NULL, '/data/timetable/date_20_03_2018_group101.png', 1, NULL, 0, 0),
	(150, 'Расписание', NULL, '/data/timetable/date_20_03_2018_group121.png', 1, NULL, 0, 0),
	(151, 'Белина Светлана Владимировна', NULL, '/data/teachers/belina-svetlana-vladimirovna.jpg', 1, NULL, 0, 0),
	(152, 'Безгеймер Андрей Викторович', NULL, '/data/teachers/bezgeymer-andrey-viktorovich.jpg', 1, NULL, 0, 0),
	(153, 'День открытых дверей', NULL, '/data/banner/den-otkrytykh-dverey.jpg', 1, NULL, 0, 0),
	(154, 'Инклюзивное образование', NULL, '/data/banner/inclusia.png', 1, NULL, 0, 0),
	(155, 'Приёмная комиссия 2017', NULL, '/data/news/priyomnaya-komissiya.jpg', 1, NULL, 0, 0),
	(156, NULL, NULL, 'img004.jpg', 1, 1, 1549614174, 1549614174),
	(157, NULL, NULL, '/data/news/Desert.jpg', 1, 1, 1549614332, 1549614332),
	(158, NULL, NULL, '/data/news/Chrysanthemum.jpg', 1, 1, 1549614616, 1549614616),
	(159, NULL, NULL, '/data/news/Jellyfish.jpg', 1, 1, 1549615379, 1549615379),
	(160, NULL, NULL, '/data/post/Desert.jpg', 1, 1, 1549616022, 1549616022),
	(161, NULL, NULL, '/data/post/', 1, 1, 1549616176, 1549616176),
	(162, NULL, NULL, '/data/post/Tulips.jpg', 1, 1, 1549616488, 1549616488),
	(163, NULL, NULL, '/data/post/Hydrangeas.jpg', 1, 1, 1549617598, 1549617598);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.lesson
CREATE TABLE IF NOT EXISTS `lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_lesson_user_created` (`created_by`),
  KEY `FK_lesson_user_updated` (`updated_by`),
  CONSTRAINT `FK_lesson_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_lesson_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.lesson: ~118 rows (приблизительно)
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
INSERT INTO `lesson` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Русский язык', 1, 1, NULL, 0, 0),
	(2, 'Литература', 1, 1, NULL, 0, 0),
	(3, 'Математика', 1, 1, NULL, 0, 0),
	(4, 'Теория вероятностей', 1, 1, NULL, 0, 0),
	(5, 'Биология', 1, 1, NULL, 0, 0),
	(6, 'Физ. культура', 1, 1, NULL, 0, 0),
	(7, 'Химия', 1, 1, NULL, 0, 0),
	(8, 'История', 1, 1, NULL, 0, 0),
	(9, 'Философия', 1, 1, NULL, 0, 0),
	(10, 'Иностранный язык', 1, 1, NULL, 0, 0),
	(12, 'Информатика', 1, 1, NULL, 0, 0),
	(13, 'География', 1, 1, NULL, 0, 0),
	(14, 'Физика', 1, 1, NULL, 0, 0),
	(15, 'Обществознание', 1, 1, NULL, 0, 0),
	(16, 'Инженерная графика', 1, 1, NULL, 0, 0),
	(17, 'ОБЖ', 1, 1, NULL, 0, 0),
	(18, 'Экология', 1, 1, NULL, 0, 0),
	(19, 'ОСПИ', 1, 1, NULL, 0, 0),
	(20, 'Технология выполнения работ', 1, 1, NULL, 0, 0),
	(21, 'Стр. матер. и изделия', 1, 1, NULL, 0, 0),
	(22, 'Информатика и ИКТвПД', 1, 1, NULL, 0, 0),
	(23, 'Геодезия', 1, 1, NULL, 0, 0),
	(24, 'Высшая математика', 1, 1, NULL, 0, 0),
	(25, 'ТСИ', 1, 1, NULL, 0, 0),
	(26, 'Графика', 1, 1, NULL, 0, 0),
	(27, 'Электроника ', 1, 1, NULL, 0, 0),
	(28, 'БД', 1, 1, NULL, 0, 0),
	(29, 'Геология и геоморофлог', 1, 1, NULL, 0, 0),
	(30, 'ПОПД', 1, 1, NULL, 0, 0),
	(31, 'Топография', 1, 1, NULL, 0, 0),
	(32, 'ОТИ', 1, 1, NULL, 0, 0),
	(33, 'Классный час', 1, 1, NULL, 0, 0),
	(34, 'Бухгалтер. учет', 1, 1, NULL, 0, 0),
	(35, 'Топографич. графика', 1, 1, NULL, 0, 0),
	(36, 'ООЗИ', 1, 1, NULL, 0, 0),
	(37, 'Ботаника', 1, 1, NULL, 0, 0),
	(38, 'Фитодизайн', 1, 1, NULL, 0, 0),
	(39, 'Озеленение интерьеров', 1, 1, NULL, 0, 0),
	(40, 'Программное обеспечение', 1, 1, NULL, 0, 0),
	(41, 'Операцион.системы', 1, 1, NULL, 0, 0),
	(42, 'Алгоритмиризация', 1, 1, NULL, 0, 0),
	(43, 'Алгоритмиризация', 1, 1, NULL, 0, 0),
	(44, 'Информац. технологии', 1, 1, NULL, 0, 0),
	(45, 'МДК 02.01', 1, 1, NULL, 0, 0),
	(46, 'Экономичес. теория', 1, 1, NULL, 0, 0),
	(47, 'МДК 03.01', 1, 1, NULL, 0, 0),
	(48, 'Экономика организации', 1, 1, NULL, 0, 0),
	(49, 'ТОСП', 1, 1, NULL, 0, 0),
	(50, 'Архитектура зданий', 1, 1, NULL, 0, 0),
	(51, 'Дендрология', 1, 1, NULL, 0, 0),
	(52, 'Тренинг', 1, 1, NULL, 0, 0),
	(53, 'Веб-програм', 1, 1, NULL, 0, 0),
	(54, 'Анимация', 1, 1, NULL, 0, 0),
	(55, 'Строительн. материалы', 1, 1, NULL, 0, 0),
	(56, 'Теория оценки', 1, 1, NULL, 0, 0),
	(57, 'ПСД', 1, 1, NULL, 0, 0),
	(58, 'ПОСПС', 1, 1, NULL, 0, 0),
	(59, 'Психология', 1, 1, NULL, 0, 0),
	(60, 'Основы почвоведения', 1, 1, NULL, 0, 0),
	(61, 'Техническая механика', 1, 1, NULL, 0, 0),
	(62, 'Программирование', 1, 1, NULL, 0, 0),
	(63, 'Информ. безопасность', 1, 1, NULL, 0, 0),
	(64, 'Мультимедиа технол.', 1, 1, NULL, 0, 0),
	(65, 'Менеджем. и маркетинг', 1, 1, NULL, 0, 0),
	(66, 'ИТПД', 1, 1, NULL, 0, 0),
	(67, 'Строительн. конструкции', 1, 1, NULL, 0, 0),
	(69, 'Графика', 1, 1, NULL, 0, 0),
	(70, 'Видео', 1, 1, NULL, 0, 0),
	(71, 'Строительн. машины', 1, 1, NULL, 0, 0),
	(72, 'БЖ', 1, 1, NULL, 0, 0),
	(73, 'ДОУ', 1, 1, NULL, 0, 0),
	(74, 'Производственная практика', 1, 1, NULL, 0, 0),
	(75, 'МДК 04.02', 1, 1, NULL, 0, 0),
	(76, 'Градостроительство', 1, 1, NULL, 0, 0),
	(77, 'ТПР', 1, 1, NULL, 0, 0),
	(78, 'Философия', 1, 1, NULL, 0, 0),
	(79, 'Охрана труда', 1, 1, NULL, 0, 0),
	(80, 'ТКС', 1, 1, NULL, 0, 0),
	(81, 'Деф-смета', 1, 1, NULL, 0, 0),
	(82, 'Компас', 1, 1, NULL, 0, 0),
	(83, 'Современ. технологии', 1, 1, NULL, 0, 0),
	(84, 'ТЭЗС', 1, 1, NULL, 0, 0),
	(85, 'ТРПП', 1, 1, NULL, 0, 0),
	(86, 'Компьютер. графика ', 1, 1, NULL, 0, 0),
	(87, 'МПО', 1, 1, NULL, 0, 0),
	(88, 'Метрология', 1, 1, NULL, 0, 0),
	(89, 'РС И ППО', 1, 1, NULL, 0, 0),
	(90, 'Цветоводство', 1, 1, NULL, 0, 0),
	(91, 'СПСХ', 1, 1, NULL, 0, 0),
	(92, 'Сметная документац.', 1, 1, NULL, 0, 0),
	(93, 'Педагодика', 1, 1, NULL, 0, 0),
	(94, 'Компьютерные сети', 1, 1, NULL, 0, 0),
	(95, 'Сетевые технологии', 1, 1, NULL, 0, 0),
	(96, 'ПАПП', 1, 1, NULL, 0, 0),
	(97, 'АСУ', 1, 1, NULL, 0, 0),
	(98, 'ИСОГД', 1, 1, NULL, 0, 0),
	(99, 'ГОГиКР', 1, 1, NULL, 0, 0),
	(100, 'Государст. кадастр', 1, 1, NULL, 0, 0),
	(101, 'Практикум', 1, 1, NULL, 0, 0),
	(102, 'ПМ.05', 1, 1, NULL, 0, 0),
	(103, 'Архитектура и ЭВМ', 1, 1, NULL, 0, 0),
	(104, 'Дискретная математика', 1, 1, NULL, 0, 0),
	(105, 'Статистика', 1, 1, NULL, 0, 0),
	(106, 'Учебная пратика', 1, 1, NULL, 0, 0),
	(107, 'ПМ.04', 1, 1, NULL, 0, 0),
	(108, 'Теория алгоритмов', 1, 1, NULL, 0, 0),
	(109, 'Анатомия', 1, 1, NULL, 0, 0),
	(110, 'Менеджемент', 1, 1, NULL, 0, 0),
	(111, 'Автокад', 1, 1, NULL, 0, 0),
	(112, 'Маркетинг', 1, 1, NULL, 0, 0),
	(113, 'Фотограмметрия', 1, 1, NULL, 0, 0),
	(114, 'Психология общения', 1, 1, NULL, 0, 0),
	(115, 'Ценообразование', 1, 1, NULL, 0, 0),
	(116, 'Типология зданий', 1, 1, NULL, 0, 0),
	(117, 'ТСО', 1, 1, NULL, 0, 0),
	(118, 'МДК 01.01 Раздел 1', 1, 1, NULL, 0, 0),
	(119, 'УП по ПМ.05', 1, 1, NULL, 0, 0),
	(120, 'УП по ПМ.04 до 05.10', 1, 1, NULL, 0, 0);
/*!40000 ALTER TABLE `lesson` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.migration: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `image_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_news_image` (`image_id`),
  KEY `FK_news_user` (`created_by`),
  KEY `FK_news_user_2` (`updated_by`),
  CONSTRAINT `FK_news_image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_news_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_news_user_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.news: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `title`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `slug`, `status`, `image_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Приёмная кампания 2017', '<p align="center"><span style="font-size: 24px;font-family: \'Open Sans\', sans-serif;"><b>Уважаемые абитуриенты!</b></span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Каждый из вас сейчас стоит перед выбором – куда поступить учиться, с какой профессией связать свое ближайшее будущее. Это очень ответственный выбор. Именно поэтому принятие решения должно быть обдуманным и взвешенным.</span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Наш колледж, имеет многолетнюю историю и славные традиции. Мы предоставляем своим студентам все возможное для полноценного личностного развития и профессионального роста, проявить себя в спорте и творчестве.</span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Преподаватели и сотрудники нашего колледжа сделают все, чтобы период учебы запомнился вам не только сложностями, связанными с овладеванием новой профессией, но и оставил в памяти яркие впечатления о студенческих годах как лучшей поре в жизни.</span></p><p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;"><br></span></p>\r\n<p style="text-align: right;"><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Приемная комиссия</span></p>', 'Приёмная кампания 2017', ' ', ' ', 'admission-campaign', 1, 155, 1, 1, 1538104254, 1538104254),
	(3, 'Приёмная кампания 2017', '<p align="center"><span style="font-size: 24px;font-family: \'Open Sans\', sans-serif;"><b>Уважаемые абитуриенты!</b></span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Каждый из вас сейчас стоит перед выбором – куда поступить учиться, с какой профессией связать свое ближайшее будущее. Это очень ответственный выбор. Именно поэтому принятие решения должно быть обдуманным и взвешенным.</span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Наш колледж, имеет многолетнюю историю и славные традиции. Мы предоставляем своим студентам все возможное для полноценного личностного развития и профессионального роста, проявить себя в спорте и творчестве.</span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Преподаватели и сотрудники нашего колледжа сделают все, чтобы период учебы запомнился вам не только сложностями, связанными с овладеванием новой профессией, но и оставил в памяти яркие впечатления о студенческих годах как лучшей поре в жизни.</span></p><p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;"><br></span></p>\r\n<p style="text-align: right;"><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Приемная комиссия</span></p>', 'Приёмная кампания 2017', ' ', ' ', 'admission-campaign-2', 1, 60, 1, 1, 1538104254, 1538104254),
	(4, 'Приёмная кампания 2017', '<p align="center"><span style="font-size: 24px;font-family: \'Open Sans\', sans-serif;"><b>Уважаемые абитуриенты!</b></span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Каждый из вас сейчас стоит перед выбором – куда поступить учиться, с какой профессией связать свое ближайшее будущее. Это очень ответственный выбор. Именно поэтому принятие решения должно быть обдуманным и взвешенным.</span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Наш колледж, имеет многолетнюю историю и славные традиции. Мы предоставляем своим студентам все возможное для полноценного личностного развития и профессионального роста, проявить себя в спорте и творчестве.</span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Преподаватели и сотрудники нашего колледжа сделают все, чтобы период учебы запомнился вам не только сложностями, связанными с овладеванием новой профессией, но и оставил в памяти яркие впечатления о студенческих годах как лучшей поре в жизни.</span></p><p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;"><br></span></p>\r\n<p style="text-align: right;"><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Приемная комиссия</span></p>', 'Приёмная кампания 2017', ' ', ' ', 'admission-campaign-3', 1, 66, 1, 1, 1538104254, 1538104254),
	(5, 'Приёмная кампания 2017', '<p align="center"><span style="font-size: 24px;font-family: \'Open Sans\', sans-serif;"><b>Уважаемые абитуриенты!</b></span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Каждый из вас сейчас стоит перед выбором – куда поступить учиться, с какой профессией связать свое ближайшее будущее. Это очень ответственный выбор. Именно поэтому принятие решения должно быть обдуманным и взвешенным.</span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Наш колледж, имеет многолетнюю историю и славные традиции. Мы предоставляем своим студентам все возможное для полноценного личностного развития и профессионального роста, проявить себя в спорте и творчестве.</span></p>\r\n<p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Преподаватели и сотрудники нашего колледжа сделают все, чтобы период учебы запомнился вам не только сложностями, связанными с овладеванием новой профессией, но и оставил в памяти яркие впечатления о студенческих годах как лучшей поре в жизни.</span></p><p><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;"><br></span></p>\r\n<p style="text-align: right;"><span style="font-size: 18px;font-family: \'Open Sans\', sans-serif;">Приемная комиссия</span></p>', 'Приёмная кампания 2017', ' ', ' ', 'admission-campaign-4', 1, 31, 1, 1, 1538104254, 1538104254),
	(6, 'asdasd', 'asdasd', 'asdasd', '', '', 'asdasd', 1, 158, 1, 1, 1549613688, 1549614616),
	(7, 'dasdasdasd', 'asdasd', 'asdasdas', '', '', 'dasdasdasd', 1, 159, 1, 1, 1549615379, 1549615379);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_post_user_created` (`created_by`),
  KEY `FK_post_user_updated` (`updated_by`),
  KEY `FK_post_image` (`image_id`),
  CONSTRAINT `FK_post_image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_post_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_post_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='Система объявлений';

-- Дамп данных таблицы yii_nppk_advanced.post: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `title`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `slug`, `status`, `created_by`, `updated_by`, `image_id`, `created_at`, `updated_at`) VALUES
	(2, 'О колледже', '<p style="font-size: 16px;"><b>Новосибирский профессионально-педагогический колледж основан в 1956 году и на протяжении всего периода ведёт подготовку специалистов, востребованных на рынке труда. Воспитательно-образовательный процесс в колледже осуществляется на русском языке.</b></p>', 'О колледже', '', '', 'about-college', 1, 1, 1, 60, 1538104254, 1538104254),
	(3, 'Мероприятия', '<h2>Абилимпикс</h2>\r\n\r\n<p>Региональный отборочный этап Национального чемпионата профмастерства среди граждан с инвалидностью «Абилимпикс».</p>\r\n\r\n<p><a href="/data/adverts/DSC_0281.JPG" class="thumbnail" title="Абилимпикс" style="width: 650px;margin: 15px auto;"><img src="/data/adverts/DSC_0281.JPG" title="Абилимпикс" /></a></p>\r\n\r\n<p>Он проводится в целях развития профессионального мастерства граждан с инвалидностью, содействия трудоустройству молодых специалистов с инвалидностью, выявления и поддержки талантливых детей и молодежи из числа граждан с инвалидностью.</p>\r\n\r\n<p>Участие в соревнованиях примут молодые специалисты, признанные в установленном порядке инвалидами, либо имеющие ограниченные возможности здоровья, не более как 5 лет завершившие освоение профессиональных образовательных программ.</p>\r\n\r\n<p><b>Региональный отборочный этап пройдет по 6 компетенциям:</b></p>\r\n\r\n<ul>\r\n	<li>Ремонт и обслуживание автомобилей;</li>\r\n	<li>Малярное дело;</li>\r\n	<li>Фотография;</li>\r\n	<li>Поварское дело;</li>\r\n	<li>Массажист;</li>\r\n	<li>Инженерный дизайн (CAD) САПР.</li>\r\n</ul>\r\n\r\n<p>Победители регионального этапа примут участие во втором Национальном чемпионате «Абилимпикс», который состоится в ноябре этого года.</p>\r\n\r\n<p>Узнать больше о региональном отборочном этапе Национального Чемпионата профессионального мастерства среди граждан с инвалидностью "Абилимпикс"</p>\r\n\r\n<p><b>Абилимпикс</b> — название соревнований по профессиональному мастерству среди инвалидов.</p>\r\n\r\n<p><b>История</b></p>\r\n\r\n<p>Впервые соревнования по профессиональному мастерству среди инвалидов прошли в Японии в 1953 году. Впоследствии эти соревнования стали международными. Соревнования проводятся Международной Федерации Абилимпикс (InternationalAbilympicFederation) с 1972 года и объединяют уже 46 стран.</p>\r\n\r\n<p><b>Абилимпикс в России</b></p>\r\n\r\n<p>C 2014 года соревнования по профессиональному мастерству среди инвалидов проводятся и в России . 1 национальный чемпионат Абилимпикс прошел в 2015 .</p>\r\n\r\n<p>Конкурс проводится в 45 компетенциях для школьников и молодых специалистов, а также в 6 компетенциях для школьников В городах России создаются региональные центры движения Абилимпикс.</p>\r\n\r\n<p>Основной организатор соревнований - Российский государственный социальный университет. В качестве экспертов-работодателей выступают различные организации.</p>', 'Мероприятия', NULL, NULL, 'events', 1, 1, 1, 60, 1538104254, 1538104254),
	(5, 'Специальности', '&lt;div class=&quot;panel-group&quot; id=&quot;accordion&quot; role=&quot;tablist&quot; aria-multiselectable=&quot;true&quot;&gt;\r\n  &lt;div class=&quot;panel panel-primary&quot;&gt;\r\n	&lt;div class=&quot;panel-heading&quot; role=&quot;tab&quot; id=&quot;headingOne&quot;&gt;\r\n	  &lt;h4 class=&quot;panel-title&quot;&gt;\r\n		&lt;a role=&quot;button&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapseOne&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;collapseOne&quot; class=&quot;collapsed&quot;&gt;\r\n		  Прикладная информатика (по отраслям)\r\n		&lt;/a&gt;\r\n	  &lt;/h4&gt;\r\n	&lt;/div&gt;\r\n	&lt;div id=&quot;collapseOne&quot; class=&quot;panel-collapse collapse&quot; role=&quot;tabpanel&quot; aria-labelledby=&quot;headingOne&quot; aria-expanded=&quot;false&quot;&gt;\r\n	  &lt;div class=&quot;panel-body&quot;&gt;\r\n		Основная профессиональная образовательная программа базовой подготовки специалистов среднего звена специальности 09.02.05 Прикладная информатика (по отраслям) квалификация техник-программист\r\n	  &lt;/div&gt;\r\n	&lt;/div&gt;\r\n  &lt;/div&gt;\r\n  &lt;div class=&quot;panel panel-primary&quot;&gt;\r\n	&lt;div class=&quot;panel-heading&quot; role=&quot;tab&quot; id=&quot;headingTwo&quot;&gt;\r\n	  &lt;h4 class=&quot;panel-title&quot;&gt;\r\n		&lt;a class=&quot;collapsed&quot; role=&quot;button&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapseTwo&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;collapseTwo&quot;&gt;\r\n		  Земельно-имущественные отношения\r\n		&lt;/a&gt;\r\n	  &lt;/h4&gt;\r\n	&lt;/div&gt;\r\n	&lt;div id=&quot;collapseTwo&quot; class=&quot;panel-collapse collapse&quot; role=&quot;tabpanel&quot; aria-labelledby=&quot;headingTwo&quot; aria-expanded=&quot;false&quot;&gt;\r\n	  &lt;div class=&quot;panel-body&quot;&gt;\r\n		Основная профессиональная образовательная программа базовой подготовки специалистов среднего звена специальности 21.02.05 Земельно-имущественные отношения квалификация Специалист по земельно-имущественным отношениям\r\n	  &lt;/div&gt;\r\n	&lt;/div&gt;\r\n  &lt;/div&gt;\r\n  &lt;div class=&quot;panel panel-primary&quot;&gt;\r\n	&lt;div class=&quot;panel-heading&quot; role=&quot;tab&quot; id=&quot;heading3&quot;&gt;\r\n	  &lt;h4 class=&quot;panel-title&quot;&gt;\r\n		&lt;a class=&quot;collapsed&quot; role=&quot;button&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapse3&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;collapse3&quot;&gt;\r\n		  Информационные системы обеспечения градостроительной деятельности\r\n		&lt;/a&gt;\r\n	  &lt;/h4&gt;\r\n	&lt;/div&gt;\r\n	&lt;div id=&quot;collapse3&quot; class=&quot;panel-collapse collapse&quot; role=&quot;tabpanel&quot; aria-labelledby=&quot;heading3&quot; aria-expanded=&quot;false&quot;&gt;\r\n	  &lt;div class=&quot;panel-body&quot;&gt;\r\n		Основная профессиональная образовательная программа базовой подготовки специалистов среднего звена специальности 21.02.06 Информационные системы обеспечения градостроительной деятельности квалификация техник\r\n	  &lt;/div&gt;\r\n	&lt;/div&gt;\r\n  &lt;/div&gt;\r\n  &lt;div class=&quot;panel panel-primary&quot;&gt;\r\n	&lt;div class=&quot;panel-heading&quot; role=&quot;tab&quot; id=&quot;heading4&quot;&gt;\r\n	  &lt;h4 class=&quot;panel-title&quot;&gt;\r\n		&lt;a class=&quot;collapsed&quot; role=&quot;button&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapse4&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;collapse4&quot;&gt;\r\n		  Садово-парковое и ландшафтное строительство\r\n		&lt;/a&gt;\r\n	  &lt;/h4&gt;\r\n	&lt;/div&gt;\r\n	&lt;div id=&quot;collapse4&quot; class=&quot;panel-collapse collapse&quot; role=&quot;tabpanel&quot; aria-labelledby=&quot;heading4&quot; aria-expanded=&quot;false&quot;&gt;\r\n	  &lt;div class=&quot;panel-body&quot;&gt;\r\n		Основная профессиональная образовательная программа базовой подготовки специалистов среднего звена специальности 35.02.12 Садово-парковое и ландшафтное строительство квалификация - техник\r\n	  &lt;/div&gt;\r\n	&lt;/div&gt;\r\n  &lt;/div&gt;\r\n  &lt;div class=&quot;panel panel-primary&quot;&gt;\r\n	&lt;div class=&quot;panel-heading&quot; role=&quot;tab&quot; id=&quot;heading5&quot;&gt;\r\n	  &lt;h4 class=&quot;panel-title&quot;&gt;\r\n	    &lt;a class=&quot;collapsed&quot; role=&quot;button&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapse5&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;collapse5&quot;&gt;\r\n		  Профессиональное обучение (по отраслям) - мастер производственного обучения (техник программист)\r\n		&lt;/a&gt;\r\n	  &lt;/h4&gt;\r\n	&lt;/div&gt;\r\n	&lt;div id=&quot;collapse5&quot; class=&quot;panel-collapse collapse&quot; role=&quot;tabpanel&quot; aria-labelledby=&quot;heading5&quot; aria-expanded=&quot;false&quot;&gt;\r\n	  &lt;div class=&quot;panel-body&quot;&gt;\r\n		Основная профессиональная образовательная программа по углубленной подготовке специалистов среднего звена специальности 44.02.06 Профессиональное обучение (по отраслям) квалификация мастер производственного обучения (техник-программист)\r\n	  &lt;/div&gt;\r\n	&lt;/div&gt;\r\n  &lt;/div&gt;\r\n  &lt;div class=&quot;panel panel-primary&quot;&gt;\r\n	&lt;div class=&quot;panel-heading&quot; role=&quot;tab&quot; id=&quot;heading6&quot;&gt;\r\n	  &lt;h4 class=&quot;panel-title&quot;&gt;\r\n		&lt;a class=&quot;collapsed&quot; role=&quot;button&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapse6&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;collapse6&quot;&gt;\r\n		  Профессиональное обучение (по отраслям) - Мастер производственного обучения (техник)\r\n		&lt;/a&gt;\r\n	  &lt;/h4&gt;\r\n	&lt;/div&gt;\r\n	&lt;div id=&quot;collapse6&quot; class=&quot;panel-collapse collapse&quot; role=&quot;tabpanel&quot; aria-labelledby=&quot;heading6&quot; aria-expanded=&quot;false&quot;&gt;\r\n	  &lt;div class=&quot;panel-body&quot;&gt;\r\n		Основная профессиональная образовательная программа по углубленной подготовке специалистов среднего звена специальности 44.02.06 Профессиональное обучение (по отраслям) квалификация мастер производственного обучения (техник)\r\n	  &lt;/div&gt;\r\n	&lt;/div&gt;\r\n  &lt;/div&gt;\r\n  &lt;div class=&quot;panel panel-primary&quot;&gt;\r\n	&lt;div class=&quot;panel-heading&quot; role=&quot;tab&quot; id=&quot;heading7&quot;&gt;\r\n	  &lt;h4 class=&quot;panel-title&quot;&gt;\r\n		&lt;a class=&quot;collapsed&quot; role=&quot;button&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapse7&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;collapse7&quot;&gt;\r\n		  Право и организация социального обеспечения\r\n		&lt;/a&gt;\r\n	  &lt;/h4&gt;\r\n	&lt;/div&gt;\r\n	&lt;div id=&quot;collapse7&quot; class=&quot;panel-collapse collapse&quot; role=&quot;tabpanel&quot; aria-labelledby=&quot;heading7&quot; aria-expanded=&quot;false&quot;&gt;\r\n	  &lt;div class=&quot;panel-body&quot;&gt;\r\n		Основная профессиональная образовательная программа базовой  подготовки специалистов среднего звена специальности 40.02.01 Право и организация социального обеспечения квалификация  - юрист\r\n	  &lt;/div&gt;\r\n	&lt;/div&gt;\r\n  &lt;/div&gt;\r\n  &lt;div class=&quot;panel panel-primary&quot;&gt;\r\n	&lt;div class=&quot;panel-heading&quot; role=&quot;tab&quot; id=&quot;heading8&quot;&gt;\r\n	  &lt;h4 class=&quot;panel-title&quot;&gt;\r\n		&lt;a class=&quot;collapsed&quot; role=&quot;button&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapse8&quot; aria-expanded=&quot;false&quot; aria-controls=&quot;collapse8&quot;&gt;\r\n		  Информационная  безопасность автоматизированных систем\r\n		&lt;/a&gt;\r\n	  &lt;/h4&gt;\r\n	&lt;/div&gt;\r\n	&lt;div id=&quot;collapse8&quot; class=&quot;panel-collapse collapse&quot; role=&quot;tabpanel&quot; aria-labelledby=&quot;heading8&quot; aria-expanded=&quot;false&quot;&gt;\r\n	  &lt;div class=&quot;panel-body&quot;&gt;\r\n		Основная профессиональная образовательная программа базовой  подготовки специалистов среднего звена специальности 10.02.03 Информационная  безопасность автоматизированных систем квалификация  - техник по защите информации\r\n	  &lt;/div&gt;\r\n	&lt;/div&gt;\r\n  &lt;/div&gt;\r\n&lt;/div&gt;', 'Специальности', NULL, NULL, 'specialties', 1, 1, 1, NULL, 1538104254, 1538104254),
	(6, 'Стоимость платных образовательных услуг', '<table class="table table-bordered" width="1898" height="531">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<span style="font-size: 18px;">Перечень услуг</span>\r\n			</td>\r\n			<td>\r\n				<span style="font-size: 18px;">Стоимость</span>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<p><b>Образовательные услуги очной формы обучения по программам среднего профессионального образования</b></p>\r\n				<ul>\r\n					<li>09.02.05 Прикладная информатика (по отраслям)</li>\r\n					<li>21.02.05 Земельно-имущественные отношения</li>\r\n					<li>35.02.12 Садово-парковое и ландшафтное строительство</li>\r\n					<li>10.02.03 Информационная безопасность автоматизированных систем</li>\r\n					<li>40.02.01 Право и организация социального обеспечения</li>\r\n					<li>44.02.06 Профессиональное обучение по отраслям</li>\r\n				</ul>\r\n			</td>\r\n			<td rowspan="3" align="center">\r\n				<b>т. 314-94-66</b>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td><p><b>Образовательные услуги заочной формы обучения по программам среднего профессионального образования</b></p>\r\n				<ul>\r\n					<li>40.02.01 Право и организация социального обеспечения</li>\r\n					<li>21.02.05 Земельно-имущественные отношения</li>\r\n					<li>44.02.06 Профессиональное обучение по отраслям</li>\r\n				</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<p><b>Образовательные услуги заочной формы обучения в соответствии с индивидуальными планами обучения по программам среднего профессионального образования</b></p>\r\n				<ul>\r\n					<li>44.02.06 Профессиональное обучение по отраслям</li>\r\n					<li>21.02.05 Земельно-имущественные отношения</li>\r\n					<li>40.02.01 Право и организация социального обеспечения</li>\r\n				</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 'Стоимость платных образовательных услуг', NULL, NULL, 'the-cost-of-paid-educational-services', 1, 1, 1, NULL, 1538104254, 1538104254),
	(12, 'Наши достижения', '<div class="clearfix">\r\n	<div class="main-news-single__image">\r\n	    <a class="thumbnail" href="/data/adverts/71.png"><img src="/data/adverts/71.png" width="140" alt=""></a>\r\n	</div>\r\n	<p class="text-align-justify">Золотая медаль «Европейское качество» в номинации «100 лучших ССУЗов России»</p>\r\n</div>\r\n\r\n<div class="clearfix">\r\n	<div class="main-news-single__image">\r\n	    <a class="thumbnail" href="/data/adverts/72.jpg"><img src="/data/adverts/72.jpg" width="140" alt=""></a>\r\n	</div>\r\n	<p class="text-align-justify">Медаль «Новосибирская марка» в сфере образовательной деятельности в номинации «За устойчивое развитие на рынке образовательных услуг»</p>\r\n	<p class="text-align-justify">Медаль «Новосибирская марка» в сфере образовательной деятельности в номинации «Современные образовательные технологии»</p>\r\n</div>\r\n\r\n<div class="clearfix">\r\n	<div class="main-news-single__image">\r\n	    <a class="thumbnail" href="/data/adverts/31_12_08.jpg"><img src="/data/adverts/31_12_08.jpg" width="140" alt=""></a>\r\n	</div>\r\n	<p class="text-align-justify">Орден «За профессиональную честь, достоинство и почетную деловую репутацию» III степени</p>\r\n</div>\r\n\r\n<div class="clearfix">\r\n	<div class="main-news-single__image">\r\n	    <a class="thumbnail" href="/data/adverts/wGYkUZewk1E.jpg"><img src="/data/adverts/wGYkUZewk1E.jpg" width="140" alt=""></a>\r\n	</div>\r\n	<p class="text-align-justify">Наградной знак по итогам V Регионального чемпионата «Молодые профессионалы» (WorldSkills Russia-2018)»  «Лучшая команда чемпионата»</p>\r\n</div>', 'Наши достижения', NULL, NULL, 'our-achievements', 1, 1, 1, NULL, 1538104254, 1538104254),
	(13, 'Тестовая запись', 'Какой то контЕнтЬ', 'Какая то тестовая запись1', '', '', '', 1, 1, 1, 45, 1549602478, 1549602789),
	(17, 'asdasdasd', 'sdfsdfsdfsdf', 'sfsdfsdfsdf', '', '', 'asdasdasd', 1, 1, 1, 163, 1549617598, 1549617598);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.room
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `image_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_room_user_created` (`created_by`),
  KEY `FK_room_user_updated` (`updated_by`),
  KEY `FK_room_image` (`image_id`),
  CONSTRAINT `FK_room_image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_room_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_room_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='Кабинеты проведений занятий';

-- Дамп данных таблицы yii_nppk_advanced.room: ~26 rows (приблизительно)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` (`id`, `title`, `content`, `sort_order`, `published`, `image_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, '4 кабинет', 'Кабинет теории информации, операционных систем и сред<br>\r\nЛаборатория технических средств обучения, компьютеризации профессиональной деятельности', 1, 1, 9, 1, NULL, 0, 0),
	(2, '5 кабинет', 'Кабинет архитектуры электронно-вычислительных машин и вычислительных систем<br>\r\nЛаборатория обработки информации отраслевой направлинности', 2, 1, 13, 1, NULL, 0, 0),
	(3, 'Гимнастический зал', 'Гимнастический зал', 18, 1, 1, 1, NULL, 0, 0),
	(4, '6 кабинет', 'Кабинет информатики. Лаборатория геоинформационных систем и автоматизированных систем ведения казастра', 3, 1, 17, 1, NULL, 0, 0),
	(5, '209 кабинет', 'Кабинет топографической графики. Лаборатория технологии кадастровой съёмки; геодезии и прикладной фотограмметрики', 16, 1, 43, 1, NULL, 0, 0),
	(6, '208 кабинет', 'Кабинет русского языка и литературы', 15, 1, 38, 1, NULL, 0, 0),
	(7, '207 кабинет', 'Кабинет безопасности жизнидеятельности и охраны труда. Стрелковый Тир', 14, 1, 32, 1, NULL, 0, 0),
	(8, '111 кабинет', 'Кабинет основ алгоритмизации и программирования. Лаборатория информационных технологий в профессиональной деятельности', 6, 1, 65, 1, NULL, 0, 0),
	(9, '7 кабинет', 'Кабинет операционных систем и сред, архитектуры электронно-вычислительных машин и вычислительных систем. Лаборатория информационных технологий и профессиональной деятельности', 4, 1, 91, 1, NULL, 0, 0),
	(10, '112 кабинет', 'Кабинет Операционных систем и сред, архитектуры электронно-вычислительных машин и вычислительных систем<br>Лаборатория Информационных технологий и профессиональной деятельности', 7, 1, 72, 1, NULL, 0, 0),
	(11, '107 кабинет', 'Кабинет физики и электротехники', 5, 1, 60, 1, NULL, 0, 0),
	(12, 'Библиотека', 'Библиотечно-информационный центр', 8, 0, 38, 1, NULL, 0, 0),
	(13, 'Конференцзал', 'Конференцзал', 9, 1, 54, 1, NULL, 0, 0),
	(14, '201 кабинет', 'Кабинет разработки, внедрения и адаптации программного обеспечения отраслевой направленности', 10, 1, 23, 1, NULL, 0, 0),
	(15, '204 кабинет', 'Кабинет информатики<br>Лаборатория информатики и информационно-коммуникационных технологий', 11, 1, 76, 1, NULL, 0, 0),
	(16, '205 кабинет', 'Кабинет иностранного языка (Англиский)', 12, 1, 29, 1, NULL, 0, 0),
	(17, '206 кабинет', 'Кабинет ботаники и физиологии растений; почвоведения, земледелия и агрохимии, экологических основ природопользования<br>Лаборатория экологии и безопасности жизнедеятельности', 13, 0, 38, 1, NULL, 0, 0),
	(18, 'Спортзал', 'Спортивный зал', 17, 1, 4, 1, NULL, 0, 0),
	(19, '301 кабинет', 'Кабинет инженерной графики', 19, 0, 38, 1, NULL, 0, 0),
	(20, '302 кабинет', 'Кабинет основ философии, истории, организационно-правового обеспечения информационной безопасности. Теории государства и права', 20, 0, 38, 1, NULL, 0, 0),
	(21, '303 кабинет', 'Кабинет документационного обеспечения управления, экономики организации, статистики, бугалтерского учёта, налогообложения и аудита, менеджмента, маркетинга, финансов, денежного обращения и кредита', 21, 0, 38, 1, NULL, 0, 0),
	(22, '304 кабинет', 'Кабинет иностранного языка (Немецкий)', 22, 0, 38, 1, NULL, 0, 0),
	(23, '305 кабинет', 'Кабинет междисциплинарных курсов', 23, 1, 82, 1, NULL, 0, 0),
	(24, '306 кабинет', 'Кабинет основ геологии и геоморфологии, типологии зданий и строительных конструкций', 24, 0, 38, 1, NULL, 0, 0),
	(25, '307 кабинет', 'Кабинет педагогики и психологии, методики профессионального обучения (по отраслям)', 25, 1, 86, 1, NULL, 0, 0),
	(26, '308 кабинет', 'Кабинет математики, математической обработки результатов геодезических измерений', 26, 1, 49, 1, NULL, 0, 0);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.room_to_image
CREATE TABLE IF NOT EXISTS `room_to_image` (
  `room_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.room_to_image: ~92 rows (приблизительно)
/*!40000 ALTER TABLE `room_to_image` DISABLE KEYS */;
INSERT INTO `room_to_image` (`room_id`, `image_id`) VALUES
	(1, 9),
	(1, 10),
	(1, 11),
	(1, 12),
	(1, 58),
	(2, 13),
	(2, 14),
	(2, 15),
	(2, 16),
	(3, 1),
	(3, 2),
	(3, 3),
	(4, 17),
	(4, 18),
	(4, 19),
	(4, 20),
	(4, 21),
	(4, 22),
	(5, 43),
	(5, 44),
	(5, 45),
	(5, 46),
	(5, 47),
	(5, 48),
	(6, 38),
	(6, 39),
	(6, 40),
	(6, 41),
	(6, 42),
	(7, 32),
	(7, 33),
	(7, 34),
	(7, 35),
	(7, 36),
	(7, 37),
	(8, 65),
	(8, 66),
	(8, 67),
	(8, 68),
	(8, 69),
	(8, 70),
	(8, 71),
	(9, 91),
	(9, 92),
	(9, 93),
	(9, 94),
	(10, 72),
	(10, 73),
	(10, 74),
	(10, 75),
	(11, 60),
	(11, 61),
	(11, 63),
	(11, 64),
	(13, 53),
	(13, 54),
	(13, 55),
	(13, 56),
	(13, 57),
	(14, 23),
	(14, 24),
	(14, 25),
	(14, 26),
	(14, 27),
	(14, 28),
	(15, 76),
	(15, 77),
	(15, 78),
	(15, 79),
	(15, 80),
	(15, 81),
	(16, 29),
	(16, 30),
	(16, 31),
	(18, 4),
	(18, 5),
	(18, 6),
	(18, 7),
	(18, 8),
	(23, 82),
	(23, 83),
	(23, 84),
	(23, 85),
	(25, 86),
	(25, 87),
	(25, 88),
	(25, 89),
	(25, 90),
	(26, 49),
	(26, 50),
	(26, 51),
	(26, 52);
/*!40000 ALTER TABLE `room_to_image` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.teacher
CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text,
  `room_id` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `teacher_group_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_teacher_image` (`image_id`),
  KEY `FK_teacher_user_created` (`created_by`),
  KEY `FK_teacher_user_updated` (`updated_by`),
  KEY `FK_teacher_teacher_group` (`teacher_group_id`),
  CONSTRAINT `FK_teacher_image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_teacher_teacher_group` FOREIGN KEY (`teacher_group_id`) REFERENCES `teacher_group` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_teacher_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_teacher_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='Список преподавателей';

-- Дамп данных таблицы yii_nppk_advanced.teacher: ~52 rows (приблизительно)
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` (`id`, `title`, `content`, `room_id`, `published`, `sort_order`, `teacher_group_id`, `image_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Ануфриева Ольга Юриевна', '&lt;p&gt;Должность: Преподаватель&lt;/p&gt;\r\n&lt;p&gt;Уровень образования: высшее&lt;/p&gt;\r\n&lt;p&gt;Высшая квалификационная категория&lt;/p&gt;', 9, 1, 1, 2, 95, 1, NULL, 0, 0),
	(2, 'Артемова Наталья Александровна', '<p>Должность: Воспитатель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Первая квалификационная категория</p>', 0, 1, 2, 2, 96, 1, NULL, 0, 0),
	(3, 'Виниченко Елена Петровна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Высшая квалификационная категория</p>', 16, 1, 3, 2, 97, 1, NULL, 0, 0),
	(4, 'Волкова Надежда Ивановна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Высшая квалификационная категория</p>', 15, 1, 4, 2, 98, 1, NULL, 0, 0),
	(5, 'Глебова Любовь Сергеевна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: Высшее</p>\r\n<p>Высшая квалификационная категория</p>', 26, 1, 5, 2, 99, 1, NULL, 0, 0),
	(6, 'Ганихина Марина Анатольевна', '<p>Должность: Педагог-библиотекарь</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Первая квалификационная категория</p> ', 12, 1, 6, 2, 100, 1, NULL, 0, 0),
	(7, 'Балдина Ирина Петровна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Высшая квалификационная категория</p>', 22, 1, 7, 2, 101, 1, NULL, 0, 0),
	(8, 'Бордун Елена Александровна', '<p>Должность: Мастер производственного обучения</p>\r\n<p>Уровень образования: среднее</p>\r\n<p>Без квалифекационной категории</p>', 0, 1, 8, 2, 102, 1, NULL, 0, 0),
	(9, 'Горбатых Евгения Александровна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Высшая квалификационная категория</p>', 8, 0, 9, 2, 103, 1, NULL, 0, 0),
	(10, 'Дмитриенко Константин Евгеньевич', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Высшая квалификационная категория</p>', 0, 1, 10, 2, 104, 1, NULL, 0, 0),
	(11, 'Шальнов Захар Сергеевич', '<p>Должность: Мастер производственного обучения</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Без квалификационной категории</p>\r\n', 2, 1, 11, 2, 105, 1, NULL, 0, 0),
	(12, 'Евтющенко Юлия Александровна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: Высшее</p>\r\n<p>Первая квалификационная категория</p>', 14, 1, 12, 2, 106, 1, NULL, 0, 0),
	(13, 'Ермакова Наталья Владимировна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Высшая квалификационная</p>', 5, 1, 13, 2, 107, 1, NULL, 0, 0),
	(14, 'Сугоняк Наталья Павловна', '<p>Должность: Социальный Педагог</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Первая квалификационная категория</p>', 0, 1, 14, 2, 108, 1, NULL, 0, 0),
	(15, 'Лапицкая Татьяна Владимировна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Высшая квалификационная категория</p>', 17, 1, 15, 2, 109, 1, NULL, 0, 0),
	(16, 'Чекушкина Ольга Олеговна', '&lt;p&gt;Должность: Преподаватель&lt;/p&gt;\r\n&lt;p&gt;Уровень образования: высшее&lt;/p&gt;\r\n&lt;p&gt;Первая квалификационная категория&lt;/p&gt;', 0, 0, 16, 2, 110, 1, NULL, 0, 0),
	(17, 'Жигло Инна Владимировна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Первая квалификационная категория </p>', 20, 1, 17, 2, 111, 1, NULL, 0, 0),
	(18, 'Пономарева Татьяна Владимировна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Первая квалификационная категория</p>', 0, 1, 18, 2, 112, 1, NULL, 0, 0),
	(19, 'Рузанкин Евгений Александрович', '<p>Должность: Мастер производственного обучения</p>\r\n<p>Уровень образования: среднее</p>\r\n<p>Без квалификационной категории</p>', 0, 1, 19, 2, 113, 1, NULL, 0, 0),
	(20, 'Крумм Татьяна Михайловна', '&lt;p&gt;Должность: Преподаватель&lt;/p&gt;\r\n&lt;p&gt;Уровень образования: высшее&lt;/p&gt;\r\n&lt;p&gt;Первая квалификационная категория&lt;/p&gt;', 0, 0, 20, 2, 114, 1, NULL, 0, 0),
	(21, 'Моисеева Татьяна Анатольевна', '&lt;p&gt;Должность: Преподаватель&lt;/p&gt;\r\n&lt;p&gt;Уровень образования: высшее&lt;/p&gt;\r\n&lt;p&gt;Первая квалификационная категория&lt;/p&gt;', 0, 0, 21, 2, 115, 1, NULL, 0, 0),
	(22, 'Обложкина Ирина Михайловна', '<p>Должность: Мастер производственного обучения</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Без квалификационной категории</p>', 1, 1, 22, 2, 116, 1, NULL, 0, 0),
	(23, 'Лобенко Юлия Владимировна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Первая квалификационная категория </p>', 11, 1, 23, 2, 117, 1, NULL, 0, 0),
	(24, 'Назарко Ирина Владимировна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Первая квалификационная категория</p>', 19, 1, 24, 2, 118, 1, NULL, 0, 0),
	(25, 'Зильбернагель Яна Геннадьевна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Высшая квалификационная категория</p>', 21, 1, 25, 2, 119, 1, NULL, 0, 0),
	(26, 'Заворин Алекснадр Александрович', '<p>Должность: Руководитель физического воспитания</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Высшая квалификационная категория</p> \r\n\r\n', 18, 1, 26, 2, 120, 1, NULL, 0, 0),
	(27, 'Пастухова Ольга Николаевна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Высшая квалификационная категория</p>', 0, 1, 27, 2, 121, 1, NULL, 0, 0),
	(28, 'Плетнева Ольга Федоровна', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Первая квалификационная категория</p>', 24, 1, 28, 2, 122, 1, NULL, 0, 0),
	(29, 'Волкова Елена Геннадьевна', '<p>Должность: Методист</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Без квалификационной категории</p>', 10, 1, 29, 2, 123, 1, NULL, 0, 0),
	(30, 'Сердюк Елена Сергеевна', '<p>Должность: Воспитатель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Без квалификационной категории</p>', 0, 0, 30, 2, 124, 1, NULL, 0, 0),
	(31, 'Скрябина Вера Евгеньевна', '<p>Должность: Мастер производственного обучения</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Первая квалификационная категория</p>', 0, 1, 31, 2, 125, 1, NULL, 0, 0),
	(32, 'Лактионов Юрий Васильевич', '<p>Должность: Преподаватель</p>\r\n<p>Уровень образования: высшее</p>\r\n<p>Без квалификациооной категории</p>', 7, 1, 32, 2, 126, 1, NULL, 0, 0),
	(33, 'Царенко Марина Сергеевна', '&lt;p&gt;Должность: Преподаватель&lt;/p&gt;\r\n&lt;p&gt;Уровень образования: высшее&lt;/p&gt;\r\n&lt;p&gt;Высшая квалификационная категория&lt;/p&gt;', 0, 1, 33, 2, 127, 1, NULL, 0, 0),
	(34, 'Кремнёв Евгений Русланович', '&lt;p&gt;Чувак из третьего кабинета, сучки&lt;br&gt;&lt;/p&gt;', 0, 0, 0, 2, 128, 1, NULL, 0, 0),
	(36, 'Сай Екатерина Валерьевна', '&lt;p&gt;Должность: Преподаватель&lt;/p&gt;&lt;p&gt;Уровень образования: высшее&lt;/p&gt;&lt;p&gt;Без квалификационной категории&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 7, 0, 0, 2, 130, 1, NULL, 0, 0),
	(37, 'Савоськина Людмила Ивановна', '&lt;p&gt;Должность: Преподаватель&lt;/p&gt;&lt;p&gt;Уровень образования: высшее&lt;/p&gt;&lt;p&gt;Без квалификационной категории&lt;/p&gt;', 11, 1, 0, 2, 131, 1, NULL, 0, 0),
	(38, 'Парфенова Елена Николаевна', '&lt;p data-mce-style=&quot;margin-bottom: 0.0001pt;&quot;&gt;Должность:Преподаватель&lt;/p&gt;&lt;p data-mce-style=&quot;margin-bottom: 0.0001pt;&quot;&gt;Уровень образования:высшее&lt;/p&gt;&lt;p data-mce-style=&quot;margin-bottom: 0.0001pt;&quot;&gt;Без квалификационной категории&lt;/p&gt;', 25, 1, 0, 2, 132, 1, NULL, 0, 0),
	(39, 'Немцева Галина Викторовна', '&lt;p&gt;Должность: Преподаватель&lt;/p&gt;&lt;p&gt;Уровень образования: высшее&lt;/p&gt;&lt;p&gt;\r\nВысшая квалификационная категория&lt;br&gt;&lt;/p&gt;', 23, 1, 0, 2, 133, 1, NULL, 0, 0),
	(40, 'Константинова Татьяна Георгиевна', '&lt;p&gt;Должность: Заведующий заочным отделением&lt;/p&gt;&lt;p&gt;Уровень образования: высшее&lt;/p&gt;&lt;p&gt;Высшая квалификационная категория&lt;/p&gt;', 8, 1, 0, 2, 134, 1, NULL, 0, 0),
	(41, 'Крыгина Роза Михайловна', '&lt;p&gt;Должность: Преподаватель&lt;/p&gt;&lt;p&gt;Уровень образования: высшее&lt;/p&gt;&lt;p&gt;Высшая квалификационная категория&lt;/p&gt;', 6, 1, 0, 2, 135, 1, NULL, 0, 0),
	(42, 'Корченица Людмила Александровна', '&lt;p&gt;Должность: Педагог-дополнительного образования&lt;/p&gt;&lt;p&gt;Уровень образования: высшее&lt;/p&gt;&lt;p&gt;Первая квалификационная категория&lt;/p&gt;', 0, 1, 0, 2, 136, 1, NULL, 0, 0),
	(43, 'Короткова Вероника Валерьевна', '&lt;p&gt;Должность: Преподаватель&lt;/p&gt;&lt;p&gt;Уровень образования: высшее&lt;/p&gt;&lt;p&gt;Без квалификационной категории&lt;/p&gt;', 4, 0, 0, 2, 137, 1, NULL, 0, 0),
	(44, 'Коновалова Олеся Викторовна', '&lt;p&gt;Должность: Методист&lt;/p&gt;&lt;p&gt;Уровень образования: высшее&lt;/p&gt;&lt;p&gt;Первая квалификационная категория&lt;/p&gt;', 0, 1, 0, 2, 138, 1, NULL, 0, 0),
	(45, 'Иконникова Людмила Викторовна', '&lt;p&gt;Должность: Педагог-психолог&lt;/p&gt;&lt;p&gt;Уровень образования: высшее&lt;/p&gt;&lt;p&gt;Без квалификационная категория&lt;/p&gt;', 10, 0, 0, 2, 139, 1, NULL, 0, 0),
	(46, 'Заварзина Любовь Геннадьевна', '&lt;p&gt;Должность: Преподаватель&amp;nbsp;&lt;/p&gt;&lt;p&gt;Уровень образования:высшее&lt;/p&gt;&lt;p&gt;Высшая квалификационная категория&lt;/p&gt;', 0, 1, 0, 2, 140, 1, NULL, 0, 0),
	(47, 'Евдокимова Алена Андреевна', '&lt;p&gt;Должность: Преподаватель&amp;nbsp;&lt;/p&gt;&lt;p&gt;Уровень образования: высшее&lt;/p&gt;&lt;p&gt;Без квалификационной категории&lt;/p&gt;', 0, 1, 0, 2, 141, 1, NULL, 0, 0),
	(48, 'Лузан Светлана Сергеевна', '&lt;p&gt;Должность: Директор колледжа, кандидат педагогических наук&lt;/p&gt;&lt;p&gt;Телефон: 8 (383) 344-49-76&lt;/p&gt;&lt;p&gt;luzanss@mail.ru&lt;/p&gt;&lt;p&gt;Кабинет: 102&lt;/p&gt;&lt;p&gt;Режим работы: Пн-Вт 8.00-17.00&lt;/p&gt;&lt;p&gt;Обед:&amp;nbsp;12.30-13.00&lt;/p&gt;&lt;p&gt;Прием по личным вопросам: Пятница 15.00-17.00&lt;/p&gt;', 0, 1, 1, 1, 142, 1, NULL, 0, 0),
	(49, 'Селиванова Светлана Александровна', '&lt;p&gt;Должность: Заместитель директора по учебной работе&lt;/p&gt;&lt;p&gt;Телефон: 8 (383) 314-93-58&lt;/p&gt;&lt;p&gt;Эл. почта: ppk54@yandex.ru&lt;/p&gt;', 0, 0, 5, 1, 143, 1, NULL, 0, 0),
	(50, 'Симонова Людмила Владимировна', '&lt;p&gt;Должность: Главный бухгалтер&lt;/p&gt;&lt;p&gt;Телефон: 8 (383) 314-93-58&lt;/p&gt;&lt;p&gt;Эл. почта: ppk54@yandex.ru&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;http://www.nppk54.ru/sites/default/files/%D0%94%D0%BE%D0%BA%D1%83%D0%BC%D0%B5%D0%BD%D1%82%D1%8B/%D0%B1%D1%83%D1%85%D0%B3%D0%B0%D0%BB%D1%82%D0%B5%D1%80%D0%B8%D0%B8.doc&quot; class=&quot;btn btn-link&quot;&gt;Положение о бухгалтерии&lt;/a&gt;&lt;br&gt;&lt;/p&gt;', 0, 1, 4, 1, 144, 1, NULL, 0, 0),
	(52, 'Авдеев Андрей Сергеевич', '&lt;p data-mce-style=&quot;margin-bottom: 0.0001pt;&quot;&gt;Должность: Преподаватель&lt;/p&gt;&lt;p data-mce-style=&quot;margin-bottom: 0.0001pt;&quot;&gt;Уровень образования:высшее&lt;/p&gt;&lt;p data-mce-style=&quot;margin-bottom: 0.0001pt;&quot;&gt;Первая квалификационная категория&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 18, 1, 0, 2, 129, 1, NULL, 0, 0),
	(53, 'Белина Светлана Владимировна', '<p>Должность: Заместитель директора по учебной работе</p>\r\n<p>телефон: 8(383) 314-93-58</p>\r\n<p>ppk54@yandex.ru</p>', 0, 1, 2, 1, 151, 1, NULL, 0, 0),
	(54, 'Безгеймер Андрей Викторович', '<p>Position: Deputy Director for General Affairs</p>\r\n<p>phone: 8 (383) 314 93 54</p>\r\n<p>dsr08@mail.ru</p>', 0, 1, 3, 1, 152, 1, NULL, 0, 0);
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.teacher_group
CREATE TABLE IF NOT EXISTS `teacher_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_teachers_group_users_created` (`created_by`),
  KEY `FK_teachers_group_users_updated` (`updated_by`),
  CONSTRAINT `FK_teachers_group_users_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_teachers_group_users_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.teacher_group: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `teacher_group` DISABLE KEYS */;
INSERT INTO `teacher_group` (`id`, `name`, `slug`, `sort_order`, `published`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Администрация', 'administration', 1000, 1, 1, 1, 0, 0),
	(2, 'Преподаватели', 'teachers', 2000, 1, 1, 1, 0, 0);
/*!40000 ALTER TABLE `teacher_group` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.timetable
CREATE TABLE IF NOT EXISTS `timetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_timetable_groups` (`group_id`),
  KEY `FK_timetable_user_updated` (`updated_by`),
  KEY `FK_timetable_user_created` (`created_by`),
  CONSTRAINT `FK_timetable_groups` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_timetable_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_timetable_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.timetable: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `timetable` DISABLE KEYS */;
INSERT INTO `timetable` (`id`, `date`, `group_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, '2019-01-12', 2, 1, 1, 0, 0),
	(2, '2019-02-06', 1, 1, 1, 0, 0),
	(3, '2019-02-22', 8, 1, 1, 1549003886, 1549004826),
	(4, '2019-02-02', 9, 1, 1, 1549009312, 1549009343);
/*!40000 ALTER TABLE `timetable` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.timetable_lesson
CREATE TABLE IF NOT EXISTS `timetable_lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timetable_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_timetable_lesson_timetable` (`timetable_id`),
  KEY `FK_timetable_lesson_lesson` (`lesson_id`),
  KEY `FK_timetable_lesson_room` (`room_id`),
  CONSTRAINT `FK_timetable_lesson_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_timetable_lesson_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_timetable_lesson_timetable` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.timetable_lesson: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `timetable_lesson` DISABLE KEYS */;
INSERT INTO `timetable_lesson` (`id`, `timetable_id`, `lesson_id`, `room_id`, `sort_order`) VALUES
	(1, 1, 111, 11, 1),
	(2, 1, 111, 11, 2),
	(3, 1, 98, 10, 3),
	(4, 1, 104, 6, 0);
/*!40000 ALTER TABLE `timetable_lesson` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.timetable_lesson_beta
CREATE TABLE IF NOT EXISTS `timetable_lesson_beta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timetable_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `lesson` varchar(255) DEFAULT NULL,
  `room` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_timetable_lesson_beta_timetable` (`timetable_id`),
  CONSTRAINT `FK_timetable_lesson_beta_timetable` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.timetable_lesson_beta: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `timetable_lesson_beta` DISABLE KEYS */;
INSERT INTO `timetable_lesson_beta` (`id`, `timetable_id`, `sort_order`, `lesson`, `room`) VALUES
	(1, 1, 0, 'География', '4 кабинет'),
	(2, 1, 0, 'Русский язык', '205 кабинет'),
	(3, 1, 0, 'аар', 'вапвап'),
	(4, 2, 0, '123', '123'),
	(5, 3, 0, 'Русский язык', '5 кабинет'),
	(6, 3, 0, 'Математика', '123'),
	(7, 4, 0, 'Русский язык', '5 кабинет');
/*!40000 ALTER TABLE `timetable_lesson_beta` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `user_group_id` int(11) DEFAULT NULL,
  `user_permission_id` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `FK_users_users_permission` (`user_permission_id`),
  KEY `FK_user_user_group` (`user_group_id`),
  CONSTRAINT `FK_user_user_group` FOREIGN KEY (`user_group_id`) REFERENCES `user_group` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii_nppk_advanced.user: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `first_name`, `last_name`, `status`, `user_group_id`, `user_permission_id`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '299v5ZuUC8pEuutIiMZWcx4o3bQwP3jW', '$2y$13$mdPzIjveSaiTtoRywvpJVuMOVKXelTTu2bg0/iPwFFanmMxC.JXTa', NULL, 'admin@localhost', 'Super', 'Administrator', 10, 1, NULL, 0, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Дамп структуры для таблица yii_nppk_advanced.user_group
CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_group_user_created` (`created_by`),
  KEY `FK_user_group_user_updated` (`updated_by`),
  CONSTRAINT `FK_user_group_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_user_group_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_nppk_advanced.user_group: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` (`id`, `name`, `sort_order`, `published`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Администратор', 10, 1, 1, NULL, 0, 0),
	(2, 'Редактор', 11, 1, 1, NULL, 0, 0),
	(3, 'Редактор расписания', 12, 1, 1, NULL, 0, 0);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
