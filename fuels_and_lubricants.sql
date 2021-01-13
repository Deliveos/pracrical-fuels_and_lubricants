-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 13 2021 г., 09:34
-- Версия сервера: 8.0.19
-- Версия PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fuels_and_lubricants`
--

-- --------------------------------------------------------

--
-- Структура таблицы `amount_fal`
--

CREATE TABLE `amount_fal` (
  `amount_fal_id` int NOT NULL,
  `bill_position_id` int NOT NULL,
  `fal_id` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `amount_fal`
--

INSERT INTO `amount_fal` (`amount_fal_id`, `bill_position_id`, `fal_id`, `count`) VALUES
(1, 1, 1, 60);

-- --------------------------------------------------------

--
-- Структура таблицы `bill`
--

CREATE TABLE `bill` (
  `bill_id` int NOT NULL,
  `bill_num` int NOT NULL,
  `date` date NOT NULL,
  `refueller_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bill`
--

INSERT INTO `bill` (`bill_id`, `bill_num`, `date`, `refueller_id`) VALUES
(1, 1, '2021-01-01', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `bill_position`
--

CREATE TABLE `bill_position` (
  `bill_position_id` int NOT NULL,
  `bill_id` int NOT NULL,
  `car_id` int NOT NULL,
  `waybill_num` int NOT NULL,
  `motor_depot_id` int NOT NULL,
  `driver_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `car`
--

CREATE TABLE `car` (
  `car_id` int NOT NULL,
  `state_num` varchar(20) NOT NULL,
  `car_model_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `car_model`
--

CREATE TABLE `car_model` (
  `car_model_id` int NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `car_model`
--

-- --------------------------------------------------------

--
-- Структура таблицы `driver`
--

CREATE TABLE `driver` (
  `driver_id` int NOT NULL,
  `surename` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `driver`
--

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `employee_id` int NOT NULL,
  `surename` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `position_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employee`
--

-- --------------------------------------------------------

--
-- Структура таблицы `fal`
--

CREATE TABLE `fal` (
  `fal_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `unit_id` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fal`
--

INSERT INTO `fal` (`fal_id`, `name`, `unit_id`) VALUES
(1, 'бензин', 2),
(2, 'дизтопливо', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `garage`
--

CREATE TABLE `garage` (
  `garage_id` int NOT NULL,
  `motor_depot_id` int NOT NULL,
  `num` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `garage`
--

-- --------------------------------------------------------

--
-- Структура таблицы `motor_depot`
--

CREATE TABLE `motor_depot` (
  `motor_depot_id` int NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `position`
--

CREATE TABLE `position` (
  `position_id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `refueller`
--

CREATE TABLE `refueller` (
  `refueller_id` int NOT NULL,
  `garage_id` int NOT NULL,
  `employee_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `unit`
--

CREATE TABLE `unit` (
  `unit_id` tinyint NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `unit`
--

INSERT INTO `unit` (`unit_id`, `name`) VALUES
(1, 'Килограмм'),
(2, 'Литр');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `amount_fal`
--
ALTER TABLE `amount_fal`
  ADD PRIMARY KEY (`amount_fal_id`),
  ADD KEY `bill_position_id` (`bill_position_id`),
  ADD KEY `fal_id` (`fal_id`);

--
-- Индексы таблицы `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `refueller_id` (`refueller_id`);

--
-- Индексы таблицы `bill_position`
--
ALTER TABLE `bill_position`
  ADD PRIMARY KEY (`bill_position_id`),
  ADD KEY `motor_depot_id` (`motor_depot_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Индексы таблицы `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `car_model_id` (`car_model_id`);

--
-- Индексы таблицы `car_model`
--
ALTER TABLE `car_model`
  ADD PRIMARY KEY (`car_model_id`);

--
-- Индексы таблицы `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Индексы таблицы `fal`
--
ALTER TABLE `fal`
  ADD PRIMARY KEY (`fal_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Индексы таблицы `garage`
--
ALTER TABLE `garage`
  ADD PRIMARY KEY (`garage_id`),
  ADD KEY `motor_depot_id` (`motor_depot_id`);

--
-- Индексы таблицы `motor_depot`
--
ALTER TABLE `motor_depot`
  ADD PRIMARY KEY (`motor_depot_id`);

--
-- Индексы таблицы `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Индексы таблицы `refueller`
--
ALTER TABLE `refueller`
  ADD PRIMARY KEY (`refueller_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `garage_id` (`garage_id`);

--
-- Индексы таблицы `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `amount_fal`
--
ALTER TABLE `amount_fal`
  MODIFY `amount_fal_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `bill_position`
--
ALTER TABLE `bill_position`
  MODIFY `bill_position_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `car_model`
--
ALTER TABLE `car_model`
  MODIFY `car_model_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `fal`
--
ALTER TABLE `fal`
  MODIFY `fal_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `garage`
--
ALTER TABLE `garage`
  MODIFY `garage_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `motor_depot`
--
ALTER TABLE `motor_depot`
  MODIFY `motor_depot_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `refueller`
--
ALTER TABLE `refueller`
  MODIFY `refueller_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `amount_fal`
--
ALTER TABLE `amount_fal`
  ADD CONSTRAINT `amount_fal_ibfk_1` FOREIGN KEY (`bill_position_id`) REFERENCES `bill_position` (`bill_position_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `amount_fal_ibfk_2` FOREIGN KEY (`fal_id`) REFERENCES `fal` (`fal_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`refueller_id`) REFERENCES `refueller` (`refueller_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `bill_position`
--
ALTER TABLE `bill_position`
  ADD CONSTRAINT `bill_position_ibfk_1` FOREIGN KEY (`motor_depot_id`) REFERENCES `motor_depot` (`motor_depot_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bill_position_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bill_position_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bill_position_ibfk_4` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`car_model_id`) REFERENCES `car_model` (`car_model_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `fal`
--
ALTER TABLE `fal`
  ADD CONSTRAINT `fal_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `garage`
--
ALTER TABLE `garage`
  ADD CONSTRAINT `garage_ibfk_1` FOREIGN KEY (`motor_depot_id`) REFERENCES `motor_depot` (`motor_depot_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `refueller`
--
ALTER TABLE `refueller`
  ADD CONSTRAINT `refueller_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `refueller_ibfk_2` FOREIGN KEY (`garage_id`) REFERENCES `garage` (`garage_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
