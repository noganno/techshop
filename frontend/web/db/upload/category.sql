-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Окт 20 2020 г., 10:43
-- Версия сервера: 5.5.55
-- Версия PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `new_texnomart`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` bigint(20) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` smallint(5) NOT NULL,
  `name_uz` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_kr` varchar(255) DEFAULT NULL,
  `menu_image` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `icon_type` smallint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1',
  `removable` tinyint(1) NOT NULL DEFAULT '1',
  `removable_all` tinyint(1) NOT NULL DEFAULT '0',
  `child_allowed` tinyint(1) NOT NULL DEFAULT '1',
  `slug` varchar(255) NOT NULL,
  `position` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `root`, `lft`, `rgt`, `lvl`, `name_uz`, `name`, `name_kr`, `menu_image`, `image`, `status`, `icon`, `icon_type`, `active`, `selected`, `disabled`, `readonly`, `visible`, `collapsed`, `movable_u`, `movable_d`, `movable_l`, `movable_r`, `removable`, `removable_all`, `child_allowed`, `slug`, `position`) VALUES
(1, 1, 1, 414, 0, 'Kategoriyalar', 'Категории', 'Категориялар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, '', 0),
(2, 1, 8, 31, 1, 'Uy uchun texnika', 'Техника для дома', 'Уй учун техника', '/files/global/Kategoriyalar/bg-img_1.png', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tehnika-dlya-doma', 0),
(4, 1, 9, 24, 2, 'Малая техника ', 'Малая техника ', 'Малая техника ', '', '/files/global/Kategoriyalar/malaya-texnika.jpg', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'malaya-tehnika', 0),
(5, 1, 25, 30, 2, 'Katta texnika', 'Крупная техника', 'Катта техника', '', '/files/global/Kategoriyalar/krupnaya-texnika.jpg', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'krupnaya-tehnika', 1),
(6, 1, 10, 11, 3, 'Changyutkichlar', 'Пылесосы', 'Чангюткичлар', '', '/files/global/Kategoriyalar/pilesosi.jpg', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'pylesosy', 0),
(7, 1, 12, 13, 3, 'Dazmol', 'Утюги', 'Дазмол', '', '/files/global/Kategoriyalar/utyugi.jpg', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'utyugi', 0),
(8, 1, 26, 27, 3, 'Kir yuvish mashinalari', 'Стиральные машины', 'Кир ювиш машиналари', '', '/files/global/Kategoriyalar/strilanie-mashini.png', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'stiralnye-mashiny', 0),
(9, 1, 28, 29, 3, 'Suv uchun sovutish', 'Кулеры для воды', 'Сув учун совутиш', '', '/files/global/Kategoriyalar/kuleri-dlya-vodi.jpg', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kulery-dlya-vody', 0),
(10, 1, 234, 283, 1, 'Kompyuter texnikasi', 'Компьютерная техника', 'Компютер техникаси', '/files/global/Kategoriyalar/bg-img_7.png', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kompyuternaya-tehnika', 0),
(11, 1, 235, 256, 2, 'Аксессуары для компьютеров', 'Аксессуары для компьютеров', 'Аксессуары для компьютеров', '', '/files/global/Kategoriyalar/akssessuari-dlya-kompyuterov.jpg', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'aksessuary-dlya-kompyuterov', 0),
(12, 1, 257, 264, 2, 'Компьютеры', 'Компьютеры', 'Компьютеры', '', '/files/global/Kategoriyalar/kompyuteri.png', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kompyutery', 1),
(13, 1, 236, 237, 3, 'Wi-Fi Router', 'Wi-Fi Роутер', 'Wi-Fi Роутер', '', '/files/global/Kategoriyalar/wifi.jpg', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'wi-fi', 0),
(14, 1, 238, 239, 3, 'Batareya quvvati', 'Батарейки', 'Батарея қуввати', '', '/files/global/Kategoriyalar/batareyki.png', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'batareiki', 0),
(18, 1, 284, 293, 1, 'Audiotexnika va Hi - Fi', 'Аудиотехника и Hi-Fi', 'Аудиотехника ва Hi - Fi', '/files/global/Kategoriyalar/bg-img_8.png', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'audiotehnika-i-hi-fi', 0),
(19, 1, 180, 233, 1, 'Telefonlar va gadjetlar', 'Телефоны и гаджеты', 'Телефонлар ва Гаджетлар', '/files/global/Kategoriyalar/bg-img_1.png', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'bytovaya-tehnika-dlya-doma-i-kuhni', 0),
(20, 1, 324, 325, 1, 'Газовае и электр плиты', 'Газовае и электр плиты', 'Газовае и электр плиты', '/files/global/Kategoriyalar/bg-img_5.png', '', 1, NULL, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'gazovae-i-elektr-plity', 0),
(21, 1, 326, 327, 1, 'Стиральные машины', 'Стиральные машины', 'Стиральные машины', '/files/global/Kategoriyalar/bg-img_1.png', '', 1, NULL, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'stiralnye-mashiny-2', 0),
(22, 1, 328, 329, 1, 'Встраиваемая бытовая техника', 'Встраиваемая бытовая техника', 'Встраиваемая бытовая техника', '/files/global/Kategoriyalar/bg-img_13.png', '', 1, NULL, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'vstraivaemaya-bytovaya-tehnika', 0),
(23, 1, 168, 179, 1, ' Televizorlar va telekartalar', 'Телевизоры и телекарты', 'Телевизорлар ва телекарталар', '/files/global/Kategoriyalar/bg-img_5.png', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'televizory-tv-tyunery-i-telekarty', 0),
(24, 1, 330, 331, 1, 'Климатическая техника', 'Климатическая техника', 'Климатическая техника', '/files/global/Kategoriyalar/bg-img_11.png', '', 1, NULL, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'klimaticheskaya-tehnika', 0),
(25, 1, 332, 333, 1, 'Холодильники и морозильники', 'Холодильники и морозильники', 'Холодильники и морозильники', '/files/global/Kategoriyalar/bg-img_1.png', '', 1, NULL, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'holodilniki-i-morozilniki', 0),
(26, 1, 342, 343, 1, 'Компьютерная техника', 'Компьютерная техника', 'Компьютерная техника', '/files/global/Kategoriyalar/bg-img_6.png', '', 1, NULL, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kompyuternaya-tehnika-2', 0),
(27, 1, 334, 341, 1, 'Rasmlar va videolar', 'Фото и видео', 'Расмлар ва видеолар', '/files/global/Kategoriyalar/bg-img_10.png', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'foto-i-video', 0),
(28, 1, 294, 311, 1, 'Go\'zallik va salomatlik', 'Красота и здоровье', 'Гўзаллик ва саломатлик', '/files/global/Kategoriyalar/bg-img_6.png', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'krasota-i-zdorove', 0),
(29, 1, 404, 409, 1, 'O\'yin konsollari', 'Игровые приставки', 'Ўйин консоллари', '/files/global/Kategoriyalar/bg-img_13.png', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'gnggn', 0),
(32, 1, 32, 53, 1, 'Ofis jihozlari', 'Техника для офиса', 'Офис жиҳозлари', '/files/global/Kategoriyalar/bg-img_7.png', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tehnika-dlya-ofisa', 0),
(33, 1, 22, 23, 3, 'Швейные машины', 'Швейные машины', 'Швейные машины', '', '/files/global/Kategoriyalar/shveynie-mashini.jpg', 0, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'shveinye-mashiny', 0),
(34, 1, 14, 15, 3, 'Chim kesuvchi mashina', 'Газонокосилка', 'Чим кесувчи машина', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'gazonokosilka', 0),
(35, 1, 16, 17, 3, 'Dazmol taxtalari', 'Гладильные доски', 'Дазмол тахталари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'gladilnye-doski', 0),
(36, 1, 18, 19, 3, 'Yuvish vositasi', 'Моющее средство', 'Ювиш воситаси', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'moyushchee-sredstvo', 0),
(37, 1, 20, 21, 3, ' Kir yuvish mashinasi', 'Сушилки для белья', 'Кир ювиш машинаси', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'sushilki-dlya-belya', 0),
(38, 1, 240, 241, 3, 'Kompyuter mebellari', 'Компьютерная мебель', 'Компютер мебеллари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'noutbuki-dlya-ofisa', 0),
(39, 1, 242, 243, 3, 'Simsiz sichqoncha', 'Мышь беспроводная', 'Симсиз сичқонча', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kompyutery-2', 0),
(40, 1, 244, 245, 3, 'Yorqin ko\'zoynaklar', 'Очки антибликовые', 'Ёрқин кўзойнаклар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'printery-i-mfu', 0),
(41, 1, 246, 247, 3, 'Klaviatura va sichqoncha', 'Клавиатура и мышь ', 'Клавиатура ва сичқонча', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'klaviatura-i-mysh', 0),
(42, 1, 248, 249, 3, 'Adapter', 'Переходник', 'Адаптер', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'monitor', 0),
(43, 1, 250, 251, 3, 'Xalta', 'Рюкзак', 'Халта', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'proektor', 0),
(44, 1, 252, 253, 3, 'Hub kengaytmasi', 'Хаб-удлинитель', 'Ҳуб кенгайтмаси', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kuler-dlya-vody', 0),
(45, 1, 254, 255, 3, 'Ofis mebeli', 'Мебель для офиса', 'Офис мебели', '', '', 1, NULL, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'mebel-dlya-ofisa', 0),
(46, 1, 265, 266, 2, 'Noutbuklar', 'Ноутбуки', 'Ноутбуклар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'noutbuki', 0),
(47, 1, 267, 268, 2, 'tashqi HD-lar', 'Внешние жесткие диски', 'ташқи ҲД-лар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'vneshnie-zhestkie-diski', 0),
(48, 1, 269, 270, 2, 'Fleshli disklar', 'Флеш накопители', 'Флешли дисклар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'flesh-nakopiteli', 0),
(49, 1, 271, 272, 2, 'Monitorlar', 'Мониторы', 'Мониторлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'monitory', 0),
(50, 1, 273, 274, 2, 'Printerlar va MFPlar', 'Принтеры и МФУ', 'Принтерлар ва МФУлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'printery-i-mfu-2', 0),
(51, 1, 275, 276, 2, 'Spikerlar', 'Компьютерные колонки', 'Спикерлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kompyuternye-kolonki', 1),
(52, 1, 277, 278, 2, 'Dasturiy ta\'minot', 'Программное обеспечение', 'Дастурий таъминот', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'programmnoe-obespechenie', 0),
(53, 1, 279, 280, 2, 'Proektor', 'Проектор', 'Проектор', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'proektor-2', 0),
(54, 1, 281, 282, 2, 'Stabilizatorlar', 'Стабилизаторы', 'Стабилизаторлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'stabilizatory', 0),
(55, 1, 33, 34, 2, 'Office noutbuklari', 'Ноутбуки для офиса', 'Оффиcе ноутбуклари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'noutbuki-dlya-ofisa-2', 0),
(56, 1, 35, 36, 2, 'Kompyuterlar', 'Компьютеры', 'Компютерлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kompyutery-3', 0),
(57, 1, 37, 38, 2, 'Printerlar va MFPlar', 'Принтеры и МФУ', 'Принтерлар ва МФПлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'printery-i-mfu-3', 0),
(58, 1, 39, 40, 2, 'Klaviatura va sichqoncha', 'Клавиатура и мышь', 'Клавиатура ва сичқонча', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'klaviatura-i-mysh-2', 0),
(59, 1, 41, 42, 2, 'Monitor', 'Монитор', 'Монитор', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'monitor-2', 0),
(60, 1, 43, 44, 2, 'Proektor', 'Проектор', 'Проектор', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'proektor-3', 0),
(61, 1, 45, 46, 2, 'Suv sovutgichi', 'Кулер для воды', 'Сув совутгичи', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kuler-dlya-vody-2', 0),
(62, 1, 47, 48, 2, 'Ofis mebeli', 'Мебель для офиса', 'Офис мебели', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'mebel-dlya-ofisa-2', 0),
(63, 1, 49, 50, 2, 'Wi-Fi router', 'Wi-Fi Роутер', 'Wi-Fi роутер', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'wi-fi-router', 0),
(64, 1, 51, 52, 2, 'Hub kengaytmasi', 'Хаб-удлинитель', 'Ҳуб кенгайтмаси', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'hab-udlinitel', 0),
(65, 1, 56, 141, 1, 'Oshxona jihozlari', 'Техника для кухни', 'Ошхона жиҳозлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tehnika-dlya-kuhni', 0),
(66, 1, 57, 98, 2, 'Kichik uskunalar', 'Малая техника', 'Кичик ускуналар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'malaya-tehnika-2', 0),
(67, 1, 99, 122, 2, 'Idish-tovoq', 'Посуда', 'Идиш-товоқ', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'posuda', 1),
(68, 1, 123, 132, 2, 'Katta texnika', 'Крупная техника', 'Катта техника', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'krupnaya-tehnika-2', 1),
(69, 1, 133, 140, 2, 'O\'rnatilgan maishiy texnika', 'Встраиваемая техника', 'Ўрнатилган маиший техника', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'vstraivaemaya-tehnika', 0),
(70, 1, 58, 59, 3, 'Blenderlar', 'Блендеры', 'Блендерлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'blendery', 0),
(71, 1, 60, 61, 3, 'Chang yutgich', 'Вакууматор', 'Чанг ютгич', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'vakuumator', 0),
(72, 1, 62, 63, 3, 'Vafli ishlab chiqaruvchilar', 'Вафельницы', 'Вафли ишлаб чиқарувчилар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'vafelnicy', 0),
(73, 1, 64, 65, 3, 'Izgaralar', 'Грили', 'Изгаралар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'grili', 0),
(74, 1, 66, 67, 3, 'Yogurt ishlab chiqaruvchilar', 'Йогуртницы', 'Ёгурт ишлаб чиқарувчилар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'iogurtnicy', 0),
(75, 1, 68, 69, 3, 'Kofe qaynatgichlar va kofe qaynatgichlar', 'Кофемашины и кофеварки', 'Кофе қайнатгичлар ва кофе қайнатгичлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kofemashiny-i-kofevarki', 0),
(76, 1, 70, 71, 3, 'Oshxona tarozisi', 'Кухонные весы', 'Ошхона тарозиси', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kuhonnye-vesy', 0),
(77, 1, 72, 73, 3, 'Oshxona kombayn', 'Кухонные комбайны', 'Ошхона комбайн', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kuhonnye-kombainy', 0),
(78, 1, 74, 75, 3, 'Mikroto\'lqinli pechlar', 'Микроволновые печи', 'Микротўлқинли печлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'mikrovolnovye-pechi', 0),
(79, 1, 76, 77, 3, 'Mikserlar', 'Миксеры', 'Миксерлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'miksery', 0),
(80, 1, 78, 79, 3, 'Mini-pechlar', 'Мини-печи', 'Мини-печлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'mini-pechi', 0),
(81, 1, 80, 81, 3, 'Multivarki', 'Мультиварки', 'Мултиварки', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'multivarki', 0),
(82, 1, 82, 83, 3, 'Go\'sht maydalagichlari', 'Мясорубки', 'Гўшт майдалагичлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'myasorubki', 0),
(83, 1, 84, 85, 3, 'Bug`da pishirgich', 'Пароварки', 'Буг`да пиширгич', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'parovarki', 0),
(84, 1, 86, 87, 3, 'Шарбат чикаргич', 'Соковыжималки', 'Шарбат чикаргич', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'sokovyzhimalki', 0),
(85, 1, 88, 89, 3, 'Sandvich ishlab chiqaruvchilar', 'Сэндвичницы', 'Сандвич ишлаб чиқарувчилар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'sendvichnicy', 0),
(86, 1, 90, 91, 3, 'Tosterlar', 'Тостеры', 'Тостерлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tostery', 0),
(87, 1, 92, 93, 3, 'Havo fritözlari', 'Фритюрницы', 'Ҳаво фритöзлари', '', '', 0, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'frityurnicy', 0),
(88, 1, 94, 95, 3, 'Elektr choynaklar', 'Электрочайники', 'Электр чойнаклар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'elektrochainiki', 0),
(89, 1, 96, 97, 3, 'Non pishiruvchi', 'Хлебопечи', 'Нон пиширувчи', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'hlebopechi', 0),
(90, 1, 100, 101, 3, 'Oshxona to\'plamlari', 'Столовые сервизы', 'Ошхона тўпламлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'stolovye-servizy', 0),
(91, 1, 102, 103, 3, 'Qozonlar', 'Казаны', 'Қозонлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kazany', 0),
(92, 1, 104, 105, 3, 'Kastryulkalar', 'Кастрюли', 'Кастрюлкалар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kastryuli', 0),
(93, 1, 106, 107, 3, 'Oshxona anjomlari', 'Кухонные принадлежности', 'Ошхона анжомлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kuhonnye-prinadlezhnosti', 0),
(94, 1, 108, 109, 3, 'Idish-tovoq to\'plamlari', 'Наборы посуды', 'Идиш-товоқ тўпламлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'nabory-posudy', 0),
(95, 1, 110, 111, 3, 'Pichoqlar va pichoq to\'plamlari', 'Ножи и наборы ножей', 'Пичоқлар ва пичоқ тўпламлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'nozhi-i-nabory-nozhei', 0),
(96, 1, 112, 113, 3, 'Tovalar', 'Сковородки', 'Товалар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'skovorodki', 0),
(97, 1, 114, 115, 3, 'Oshxona servisi', 'Столовые наборы', 'Ошхона сервиси', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'stolovye-nabory', 0),
(98, 1, 116, 117, 3, 'Suv filtri', 'Фильтр для воды', 'Сув филтри', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'filtr-dlya-vody', 0),
(99, 1, 118, 119, 3, 'Pishirish uchun shakllar', 'Формы для выпечки', 'Пишириш учун шакллар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'formy-dlya-vypechki', 0),
(100, 1, 120, 121, 3, 'Choynak', 'Чайник', 'Чойнак', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'chainik', 0),
(101, 1, 124, 125, 3, 'Sovutgichlar', 'Холодильники', 'Совутгичлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'holodilniki', 0),
(102, 1, 126, 127, 3, 'Muzlatgichlar', 'Морозильники', 'Музлатгичлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'morozilniki', 0),
(103, 1, 128, 129, 3, 'Gaz plitalari', 'Газовые плиты', 'Газ плиталари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'gazovye-plity', 0),
(104, 1, 130, 131, 3, 'Idish yuvish mashinalar', 'Посудомоечные машины', 'Идиш ювиш машиналар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'posudomoechnye-mashiny', 0),
(105, 1, 134, 135, 3, 'Pishirish yuzasi', 'Варочные панели', 'Пишириш юзаси', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'varochnye-paneli', 0),
(106, 1, 136, 137, 3, 'Xavo sorgich', 'Вытяжки ', 'Хаво соргич', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'vytyazhki', 0),
(107, 1, 138, 139, 3, 'Pechlar', 'Духовки', 'Печлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'duhovki', 0),
(108, 1, 142, 155, 1, 'Avtomobil uchun mahsulotlar', 'Товары для авто', 'Автомобил учун маҳсулотлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tovary-dlya-avto', 0),
(109, 1, 143, 144, 2, 'Bosim yuvish mashinalari', 'Мойки высокого давления', 'Босим ювиш машиналари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'moiki-vysokogo-davleniya', 0),
(110, 1, 145, 146, 2, 'Avtomobil signalizatsiyalari', 'Автосигнализации', 'Автомобил сигнализатсиялари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'avtosignalizacii', 0),
(111, 1, 147, 148, 2, 'Video yozuvchilar', 'Видеорегистратор', 'Видео ёзувчилар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'videoregistrator', 0),
(112, 1, 149, 150, 2, 'Avtomabil ovozlari', 'Авто звук', 'Автомабил овозлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'avto-zvuk', 0),
(113, 1, 151, 152, 2, 'Avtomabil aksessuarlar', 'Аксессуары для авто', 'Автомабил аксессуарлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'aksessuary-dlya-avto', 0),
(114, 1, 153, 154, 2, 'Radar detektorlar', 'Радар детектор', 'Радар детекторлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'radar-detektor', 0),
(115, 1, 156, 167, 1, 'Iqlim texnikasi', 'Климатическая техника', 'Иқлим техникаси', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'klimaticheskaya-tehnika-2', 0),
(116, 1, 157, 158, 2, 'Xavo sovutgich', 'Кондиционеры', 'Хаво совутгич', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kondicionery', 0),
(117, 1, 159, 160, 2, 'Xavo aylantirgich', 'Вентиляторы', 'Хаво айлантиргич', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'ventilyatory', 0),
(118, 1, 161, 162, 2, 'Isitgich', 'Обогреватели', 'Иситгич', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'obogrevateli', 0),
(119, 1, 163, 164, 2, 'Suv isitgichlari', 'Водонагреватели', 'Сув иситгичлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'vodonagrevateli', 0),
(120, 1, 165, 166, 2, 'Namlagichlar', 'Увлажнители воздуха', 'Намлагичлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'uvlazhniteli-vozduha', 0),
(121, 1, 169, 170, 2, 'Televizorlar', 'Телевизоры', 'Телевизорлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'televizory', 0),
(122, 1, 171, 172, 2, 'Televizor aksessuarlari', 'Аксессуары для телевизоров', 'Телевизор аксессуарлари', '', '', 0, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'aksessuary-dlya-televizorov', 0),
(123, 1, 173, 174, 2, 'Kronshteynlar', 'Кронштейны', 'Кронштейнлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kronshteiny', 0),
(124, 1, 175, 176, 2, 'Televizor tyunerlari', 'ТВ тюнеры', 'Телевизор тюнерлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tv-tyunery', 0),
(125, 1, 177, 178, 2, 'Telekartalar', 'Телекарты', 'Телекарталар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'telekarty', 0),
(126, 1, 181, 200, 2, 'Gadjetlar', 'Гаджеты', 'Гаджетлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'gadzhety', 0),
(127, 1, 201, 222, 2, 'Telefon aksessuarlari', 'Аксессуары для телефонов', 'Телефон аксессуарлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'aksessuary-dlya-telefonov', 1),
(128, 1, 223, 230, 2, 'Telefonlar', 'Телефоны', 'Телефонлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'telefony', 1),
(129, 1, 231, 232, 2, 'Planshetlar', 'Планшеты', 'Планшетлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'planshety', 0),
(130, 1, 182, 183, 3, 'GPS soat', 'GPS часы', 'GPS соат', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'gps-chasy', 0),
(131, 1, 184, 185, 3, 'IP-kamera', 'IP-камера', 'IP-камера', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'ip-kamera', 0),
(132, 1, 186, 187, 3, 'Media-pleer', 'Медиаплеер', 'Медиа-плеер', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'mediapleer', 0),
(133, 1, 188, 189, 3, 'Aqlli soat', 'Смарт часы', 'Ақлли соат', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'smart-chasy', 0),
(134, 1, 190, 191, 3, 'Smart tarozi', 'Умные весы напольные', 'Смарт тарози', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'umnye-vesy-napolnye', 0),
(135, 1, 192, 193, 3, 'Fitness bilaguzuk', 'Фитнес браслет', 'Фитнесс билагузук', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'fitnes-braslet', 0),
(136, 1, 194, 195, 3, 'Tornavida', 'Отвертка', 'Торнавида', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'otvertka', 0),
(137, 1, 196, 197, 3, 'Virtual haqiqat ko\'zoynaklari', 'Очки виртуальной реальности', 'Виртуал ҳақиқат кўзойнаклари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, '-2', 0),
(138, 1, 198, 199, 3, 'Elektron kitoblar', 'Электронные книги', 'Электрон китоблар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'elektronnye-knigi', 0),
(139, 1, 202, 203, 3, 'Simsiz karnaylar', 'Беспроводные колонки', 'Симсиз карнайлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'besprovodnye-kolonki', 0),
(140, 1, 204, 205, 3, 'Tashqi batareyalar', 'Внешние аккумуляторы', 'Ташқи батареялар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'vneshnie-akkumulyatory', 0),
(141, 1, 206, 207, 3, 'Smartfonlar uchun ushlagichlar', 'Держатели для смартфонов', 'Смартфонлар учун ушлагичлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'derzhateli-dlya-smartfonov', 0),
(142, 1, 208, 209, 3, 'Zaryadlovchi moslamalar', 'Зарядные устройства', 'Зарядловчи мосламалар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'zaryadnye-ustroistva', 0),
(143, 1, 210, 211, 3, 'O\'yin aksessuarlari', 'Игровые аксессуары', 'Ўйин аксессуарлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'igrovye-aksessuary', 0),
(144, 1, 212, 213, 3, 'kabellar', 'Кабели', 'кабеллар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kabeli', 0),
(145, 1, 214, 215, 3, 'Xotira kartalari', 'Карты памяти', 'Хотира карталари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'karty-pamyati', 0),
(146, 1, 216, 217, 3, 'Selfi monopodlari', 'Моноподы для селфи', 'Селфи моноподлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'monopody-dlya-selfi', 0),
(147, 1, 218, 219, 3, 'Quloqchin', 'Наушники', 'Қулоқчин', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'naushniki', 0),
(148, 1, 220, 221, 3, 'G\'lof', 'Чехлы', 'Ғлоф', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'chehly', 0),
(149, 1, 224, 225, 3, 'Tugmachali telefonlar', 'Кнопочные телефоны', 'Тугмачали телефонлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'knopochnye-telefony', 0),
(150, 1, 226, 227, 3, 'Smartfonlar', 'Смартфоны', 'Смартфонлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'smartfony', 0),
(151, 1, 228, 229, 3, 'Radiotelefonlar', 'Радиотелефоны', 'Радиотелефонлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'radiotelefony', 0),
(152, 1, 285, 286, 2, 'DVD pleerlar', 'DVD плееры', 'DVD плеерлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'dvd-pleery', 0),
(153, 1, 287, 288, 2, 'Uy kinoteatrlari', 'Домашние кинотеатры', 'Уй кинотеатрлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'domashnie-kinoteatry', 0),
(154, 1, 289, 290, 2, 'Hi-Fi karnaylari', 'Колонки Hi Fi', 'Hi-Fi карнайлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kolonki-hi-fi', 0),
(155, 1, 291, 292, 2, 'Musiqiy markazlar', 'Музыкальные центры', 'Мусиқий марказлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'muzykalnye-centry', 0),
(156, 1, 295, 296, 2, ' Bolalar uchun mahsulotlar', 'Товары для детей', 'Болалар учун маҳсулотлар', '', '', 1, NULL, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tovary-dlya-detei', 0),
(157, 1, 297, 298, 2, 'Massajchilar', 'Массажеры', 'Массажчилар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'massazhery', 0),
(158, 1, 299, 300, 2, 'Tarozilar', 'Напольные весы', 'Тарозилар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'napolnye-vesy', 0),
(159, 1, 301, 302, 2, 'Soch turmaklovchi uskuna', 'Стайлеры', 'Соч турмакловчи ускуна', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'stailery', 0),
(160, 1, 303, 304, 2, 'Tonometrlar', 'Тонометры', 'Тонометрлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tonometry', 0),
(161, 1, 305, 306, 2, 'Soch quritgichlari', 'Фены', 'Соч қуритгичлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'feny', 0),
(162, 1, 307, 308, 2, 'Elektro ustara', 'Электробритвы', 'Электро устара', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'elektrobritvy', 0),
(163, 1, 309, 310, 2, 'Epilatorlar', 'Эпиляторы', 'Эпилаторлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'epilyatory', 0),
(164, 1, 312, 323, 1, 'Bolalar uchun mahsulotlar', 'Товары для детей', 'Болалар учун маҳсулотлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tovary-dlya-detei-2', 0),
(165, 1, 313, 314, 2, 'Video enaga', 'Видеоняни', 'Видео энага', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'videonyani', 0),
(166, 1, 315, 316, 2, 'Bolalar aravachalari', 'Детские коляски', 'Болалар аравачалари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'detskie-kolyaski', 0),
(167, 1, 317, 318, 2, 'Bolalar termometrlari', 'Детские термометры', 'Болалар термометрлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'detskie-termometry', 0),
(168, 1, 319, 320, 2, 'O\'yinchoqlar', 'Игрушки', 'Ўйинчоқлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'igrushki', 0),
(169, 1, 321, 322, 2, 'Radio enaga', 'Радионяни', 'Радио энага', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'radionyani', 0),
(170, 1, 335, 336, 2, 'Raqamli kameralar', 'Цифровые фотоаппараты', 'Рақамли камералар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'cifrovye-fotoapparaty', 0),
(171, 1, 337, 338, 2, 'Raqamli video kameralar', 'Цифровые видеокамеры', 'Рақамли видео камералар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'cifrovye-videokamery', 0),
(172, 1, 339, 340, 2, 'Aksessuarlar', 'Аксессуары', 'Аксессуарлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'aksessuary', 0),
(173, 1, 344, 363, 1, 'Sport va sevimli mashg\'ulot', 'Спорт и увлечение', 'Спорт ва севимли машғулот', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'sport-i-uvlechenie', 0),
(174, 1, 345, 346, 2, 'Gyroskuterlar', 'Гироскутеры', 'Гйроскутерлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'giroskutery', 0),
(175, 1, 347, 348, 2, 'Elektrosamokat', 'Электросамокат', 'Электросамокат', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'elektrosamokat', 0),
(176, 1, 349, 350, 2, 'Hovuzlar', 'Бассейны', 'Ҳовузлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'basseiny', 0),
(177, 1, 351, 352, 2, 'Yugurish yo\'lagi', 'Беговая дорожка', 'Югуриш ёълаги', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'begovaya-dorozhka', 0),
(178, 1, 353, 354, 2, 'Sog\'lom to\'p', 'Велнес мяч', 'Соғлом тўп', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'velnes-myach', 0),
(179, 1, 355, 356, 2, 'Velosipedlar', 'Велосипеды', 'Велосипедлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'velosipedy', 0),
(180, 1, 357, 358, 2, 'Velotrenajer', 'Велотренажер', 'Велотренажер', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'velotrenazher', 0),
(181, 1, 359, 360, 2, 'Teleskop', 'Телескоп', 'Телескоп', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'teleskop', 0),
(182, 1, 361, 362, 2, 'Ellipsoid', 'Эллипсоид', 'Эллипсоид', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'ellipsoid', 0),
(183, 1, 364, 403, 1, 'Maishiy mahsulotlar', 'Товары для дома', 'Маиший маҳсулотлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tovary-dlya-doma', 0),
(184, 1, 365, 370, 2, 'Oshxona', 'Кухня', 'Ошхона', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kuhnya', 0),
(185, 1, 366, 367, 3, ' Modulli oshxonalar', 'Модульные кухни', 'Модулли ошхоналар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'modulnye-kuhni', 0),
(186, 1, 368, 369, 3, 'Dasturxon', 'Скатерть', 'Дастурхон', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'skatert', 0),
(187, 1, 371, 374, 2, 'Gilam mahsulotlari', 'Ковровые изделия', 'Гилам маҳсулотлари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kovrovye-izdeliya', 0),
(188, 1, 372, 373, 3, 'Gilamlar', 'Ковры', 'Гиламлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'kovry', 0),
(189, 1, 375, 382, 2, 'Yotoq xona', 'Спальня', 'Ётоқ хона', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'spalnya', 0),
(190, 1, 376, 377, 3, 'Matraslar', 'Матрасы', 'Матраслар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'matrasy', 0),
(191, 1, 378, 379, 3, 'Adyol va yostiqlar', 'Одеяло и подушки', 'Адёл ва ёстиқлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'odeyalo-i-podushki', 0),
(192, 1, 380, 381, 3, 'Yotoq xonasi uchun to\'qimachilik', 'Текстиль для спальни', 'Ётоқ хонаси учун тўқимачилик', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tekstil-dlya-spalni', 0),
(193, 1, 383, 388, 2, 'Mehmonxona', 'Гостиная', 'Меҳмонхона', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'gostinaya', 1),
(194, 1, 384, 385, 3, 'Komodlar', 'Комоды', 'Комодлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'komody', 0),
(195, 1, 386, 387, 3, 'O\'rindiq va kreslo', 'Стул и кресло', 'Ўриндиқ ва кресло', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'stul-i-kreslo', 0),
(196, 1, 389, 392, 2, 'Bolalar xonasi', 'Детская комната', 'Болалар хонаси', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'detskaya-komnata', 0),
(197, 1, 390, 391, 3, 'To\'shak', 'Кровати', 'Тўшак', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'krovati', 0),
(198, 1, 393, 394, 2, 'Yoritish asboblari', 'Осветительные приборы', 'Ёритиш асбоблари', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'osvetitelnye-pribory', 1),
(199, 1, 395, 396, 2, 'Ilgichlar', 'Вешалки', 'Илгичлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'veshalki', 0),
(200, 1, 397, 398, 2, 'Narvon', 'Стремянка', 'Нарвон', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'stremyanka', 0),
(201, 1, 399, 400, 2, 'To\'qimachilik', 'Текстиль', 'Тўқимачилик', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tekstil', 0),
(202, 1, 401, 402, 2, 'Etajerkalar', 'Этажерка', 'Этажеркалар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'etazherka', 0),
(203, 1, 405, 406, 2, 'Sony PlayStation', 'Sony PlayStation', 'Sony PlayStation', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'sony-playstation', 0),
(204, 1, 407, 408, 2, 'Microsoft XBOX', 'Microsoft XBOX', 'Microsoft XBOX', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'microsoft-xbox', 0),
(205, 1, 2, 7, 1, 'Aktsiyalar va CHegirmalar', 'Акции и Скидки', 'Актсиялар ва Чегирмалар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'akcii-i-skidki', 0),
(206, 1, 3, 4, 2, ' Chegirmali tovarlar', 'Товары со скидкой', ' Чегирмали товарлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tovary-so-skidkoi', 0),
(207, 1, 5, 6, 2, 'Oldindan to\'lovsiz tovarlar', 'Товары без предоплаты', 'Олдиндан тўловсиз товарлар', '', '', 1, NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 'tovary-bez-predoplaty', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tree_NK1` (`root`),
  ADD KEY `tree_NK2` (`lft`),
  ADD KEY `tree_NK3` (`rgt`),
  ADD KEY `tree_NK4` (`lvl`),
  ADD KEY `tree_NK5` (`active`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
