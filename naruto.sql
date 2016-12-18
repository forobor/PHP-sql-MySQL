-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 17 2016 г., 14:40
-- Версия сервера: 10.1.19-MariaDB
-- Версия PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `naruto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bidju`
--

CREATE TABLE `bidju` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `NUM_TAILS` int(11) DEFAULT NULL,
  `SHINOBI` int(11) DEFAULT NULL,
  `DESCRIPTION` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bidju`
--

INSERT INTO `bidju` (`ID`, `NAME`, `NUM_TAILS`, `SHINOBI`, `DESCRIPTION`) VALUES
(1, 'Курама', 9, 1, 'Девятихвостый демон-лис. Он является самым сильным и могучим из всех хвостатых демонов. Он владеет огромным запасом жизненных сил, а также бесконечным количеством чакры. '),
(2, 'Хачиби', 8, 2, 'Гигантский бык-осьминог. Хачиби был заточён в теле Кира Би, брата Четвёртого Райкаге. Во время битвы с командой «Така» был ранен и пожертвовал одним из своих щупальцев чтобы спасти своего джинчуурики. По словам самого Хачиби, он был диким до того, как встретил Кира Би, а затем изменился в лучшую сторону. В настоящее время часть Хачиби запечатана в Наруто, другая часть - перерождена в Шинжу.');

-- --------------------------------------------------------

--
-- Структура таблицы `kage`
--

CREATE TABLE `kage` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `SURNAME` varchar(100) DEFAULT NULL,
  `NUMBER` int(11) DEFAULT NULL,
  `RANK` varchar(100) DEFAULT NULL,
  `VILLAGE` int(11) DEFAULT NULL,
  `DESCRIPTION` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `kage`
--

INSERT INTO `kage` (`ID`, `NAME`, `SURNAME`, `NUMBER`, `RANK`, `VILLAGE`, `DESCRIPTION`) VALUES
(1, 'Цунаде', NULL, 5, 'Хокаге', 1, 'Одна из лучших ниндзя-медиков в мире,является одной из трёх Саннинов и внучкой Первого Хокаге — Хаширамы Сенджу и первого Джинчуурики девятихвостого - Мито Узумаки.'),
(2, 'Эй', NULL, 4, 'Райкаге', 2, 'Здоровый, накачанный, человек, весьма импульсивный, эмоциональный и раздражительный. Несмотря на это, превосходный шиноби и хороший лидер, однако он не особо склонен к дипломатии и предпочитает словам действие. Может пойти ради брата, Кира Би, на многое. Один из сильнейших шиноби в мире, мастер тайдзюцу, использует нинтайдзюцу на основе Стихии Молнии, обладает огромным запасом чакры (по словам Карин, на уровне биджуу). Согласно манге, он является самым быстрым шиноби наравне с Четвёртым Хокаге.');

-- --------------------------------------------------------

--
-- Структура таблицы `shinobi`
--

CREATE TABLE `shinobi` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `SURNAME` varchar(100) DEFAULT NULL,
  `VILLAGE` int(11) DEFAULT NULL,
  `BIDJU` int(11) DEFAULT NULL,
  `DESCRIPTION` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shinobi`
--

INSERT INTO `shinobi` (`ID`, `NAME`, `SURNAME`, `VILLAGE`, `BIDJU`, `DESCRIPTION`) VALUES
(1, 'Наруто', 'Удзумаки', 1, 1, 'Сын Йондайме Хокаге Намиказе Минато. Из-за того, что он был Джинчуурики, жители Конохи презирали его. Желая получить их уважение и признание, у Наруто появилась мечта стать Хокаге и превзойти всех предыдущих правителей Конохи. В течение своей жизни он становится героем Конохи, заслужив признание жителей деревни, а также ключевой фигурой Четвёртой мировой войны Ниндзя. Помимо этого он является реинкарнацией младшего сына Рикудо.'),
(2, 'Кира', 'Би', 2, 2, 'Имеет привычку говорить репом. Невероятно сильный и талантливый ниндзя, способный полностью контролировать своего биджу. Владеет уникальным боевым стилем: сражается сразу семью мечами и использует Стихию Молнии (в основном проводя её через предметы). Если же противник силён, использует силу Восьмихвостого, во много раз повышая свои шансы на победу.');

-- --------------------------------------------------------

--
-- Структура таблицы `village`
--

CREATE TABLE `village` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `SECOND_NAME` varchar(100) DEFAULT NULL,
  `KAGE` int(11) DEFAULT NULL,
  `DESCRIPTION` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `village`
--

INSERT INTO `village` (`ID`, `NAME`, `SECOND_NAME`, `KAGE`, `DESCRIPTION`) VALUES
(1, 'Коноха', 'Деревня Скрытого Листа', 1, 'Деревню Скрытого Листа основал Хаширама Сенджу в сотрудничестве с Учихой Мадарой.\r\n\r\nДеревня имеет огромные размеры, но в манге и аниме показываются только несколько улиц. Позднее деревня была значительно увеличена и приобрела вид крупного города. Главной достопримечательностью Скрытого Листа являются вырезанные на горе лица Хокаге. Внешний вид зданий ничем особенным, в принципе, не выделяется. Ранее уровень развития инфраструктуры и технологий в деревне был незначителен, однако позже мы можем наблюдать, как Нанадайме Хокаге в своём офисе пользуется ноутбуком, из чего можно сделать вывод, что деревня совершила научно-техническую революцию.\r\n\r\nПо словам Пейна, жители Конохи молятся своим предкам и верят в так называемую Волю Огня. Асума Сарутоби описал её как непреодолимое желание защитить свою деревню. Воля Огня даёт жителям Конохи силу бороться со всеми невзгодами и демонстрирует непоколебимость и железную волю каждого в этой деревне.'),
(2, 'Кумогакуре', 'Деревня Скрытого Облака', 2, 'Кумо имеет довольно необычный внешний вид. Вся деревня находится в горах и спрятана в облаках, отчего она и получила своё название. Все здания в Кумо построены в горах и только небольшая их часть выпирает их скал. Цветовая гамма Кумо является жёлто-синей и поэтому все здания носят эти цвета. Ворота деревни также имеют жёлто-синий цвет. На них изображен знак Кумо, символизирующий облако. Резиденция Райкаге выглядит как очень большой воздушный шар, сверху которого много растительности. Кабинет Райкаге окружает коридор. В кабинете стоят различные тренажёры и письменный стол.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bidju`
--
ALTER TABLE `bidju`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SHINOBI` (`SHINOBI`);

--
-- Индексы таблицы `kage`
--
ALTER TABLE `kage`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `VILLAGE` (`VILLAGE`);

--
-- Индексы таблицы `shinobi`
--
ALTER TABLE `shinobi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `VILLAGE` (`VILLAGE`),
  ADD KEY `BIDJU` (`BIDJU`);

--
-- Индексы таблицы `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `KAGE` (`KAGE`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bidju`
--
ALTER TABLE `bidju`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `kage`
--
ALTER TABLE `kage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `shinobi`
--
ALTER TABLE `shinobi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `village`
--
ALTER TABLE `village`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bidju`
--
ALTER TABLE `bidju`
  ADD CONSTRAINT `bidju_ibfk_1` FOREIGN KEY (`SHINOBI`) REFERENCES `shinobi` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `kage`
--
ALTER TABLE `kage`
  ADD CONSTRAINT `kage_ibfk_1` FOREIGN KEY (`VILLAGE`) REFERENCES `village` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shinobi`
--
ALTER TABLE `shinobi`
  ADD CONSTRAINT `shinobi_ibfk_1` FOREIGN KEY (`VILLAGE`) REFERENCES `village` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `shinobi_ibfk_2` FOREIGN KEY (`BIDJU`) REFERENCES `bidju` (`ID`);

--
-- Ограничения внешнего ключа таблицы `village`
--
ALTER TABLE `village`
  ADD CONSTRAINT `village_ibfk_1` FOREIGN KEY (`KAGE`) REFERENCES `kage` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
