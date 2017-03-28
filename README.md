Тестовое задание

CREATE TABLE `users`(
`id` SERIAL,
`fio` VARCHAR(255),
`salary` BIGINT(20) UNSIGNED COMMENT 'store in copecks, at a conclusion we divide on 100',
`bonus_id` int UNSIGNED,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `bonuses`(
`id` int  UNSIGNED NOT NULL AUTO_INCREMENT,
`condition` ENUM ('val <= 100','100 < val && val <= 200','val >= 300'),
`category` varchar(255),
`bonus` BIGINT(20) UNSIGNED COMMENT 'store in copecks, at a conclusion we divide on 100',
    PRIMARY KEY(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `type_days`(
`id` int  UNSIGNED NOT NULL AUTO_INCREMENT,
`title` varchar(255),
    PRIMARY KEY(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `statistics`(
`id` SERIAL,
`user_id` BIGINT(20) UNSIGNED NOT NULL,
`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`count_calls` int UNSIGNED DEFAULT 0,
`type_day` int UNSIGNED,
     PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

# На эту таблицу повешен триггер, который срабатывает на изменение ЗП
CREATE TABLE `history`(
`id` bigint(20)  UNSIGNED NOT NULL,
`old_salary`BIGINT(20) UNSIGNED COMMENT 'store in copecks, at a conclusion we divide on 100',
`new_salary` BIGINT(20) UNSIGNED COMMENT 'store in copecks, at a conclusion we divide on 100',
`bonus_id` int UNSIGNED,
`date` timestamp DEFAULT NOW()
);

DELIMITER $$
CREATE TRIGGER history_bonus
AFTER UPDATE ON `users`
FOR EACH ROW
BEGIN
INSERT INTO `history` (`id`, `old_salary`,`new_salary`,`bonus_id` )
VALUES (NEW.id, OLD.salary ,NEW.salary, NEW.bonus_id);
END; $$
DELIMITER ;


INSERT INTO `users` (
`id` ,
`fio` ,
`salary` ,
`bonus_id`
)
VALUES
(NULL ,  'Хельга Браун',  '2000000', NULL),
(NULL ,  'Барак Обама',  '3000000', NULL),
(NULL ,  'Денис Козлов',  '4000000', NULL);

INSERT INTO `bonuses` (
`id` ,
`condition` ,
`category` ,
`bonus`
)
VALUES
(NULL ,  'val <= 100',        'Начальная',  '100'),
(NULL ,  '100 < val && val <= 200',  'Средняя',  '200'),
(NULL ,  'val >= 300',        'Высшая',  '300');

INSERT INTO `type_days` (
`id` ,
`title`
)
VALUES
(NULL ,  'Рабочий'),
(NULL ,  'Выходной'),
(NULL ,  'Не работал');

INSERT INTO  `statistics` (
`id` ,
`user_id` ,
`date` ,
`count_calls` ,
`type_day`
)
VALUES
(NULL ,  '1', '2017-01-01 00:00:00' ,  '10',  '1'),
(NULL ,  '2', '2017-01-01 00:00:00' ,  '10',  '1'),
(NULL ,  '3', '2017-01-01 00:00:00' ,  '10',  '1'),

(NULL ,  '1', '2017-01-02 00:00:00' ,  '40',  '1'),
(NULL ,  '2', '2017-01-02 00:00:00' ,  '20',  '1'),
(NULL ,  '3', '2017-01-02 00:00:00' ,  '10',  '1'),

(NULL ,  '1', '2017-01-03 00:00:00' ,  '40',  '1'),
(NULL ,  '2', '2017-01-03 00:00:00' ,  '10',  '1'),
(NULL ,  '3', '2017-01-03 00:00:00' ,  '10',  '1'),

(NULL ,  '1', '2017-01-04 00:00:00' ,  '30',  '1'),
(NULL ,  '2', '2017-01-04 00:00:00' ,  '30',  '1'),
(NULL ,  '3', '2017-01-04 00:00:00' ,  '30',  '1'),

(NULL ,  '1', '2017-01-05 00:00:00' ,  '10',  '1'),
(NULL ,  '2', '2017-01-05 00:00:00' ,  '10',  '1'),
(NULL ,  '3', '2017-01-05 00:00:00' ,  '10',  '1'),

(NULL ,  '1', '2017-01-06 00:00:00' ,  '0',  '2'),
(NULL ,  '2', '2017-01-06 00:00:00' ,  '0',  '2'),
(NULL ,  '3', '2017-01-06 00:00:00' ,  '0',  '2'),

(NULL ,  '1', '2017-01-07 00:00:00' ,  '0',  '2'),
(NULL ,  '2', '2017-01-07 00:00:00' ,  '0',  '2'),
(NULL ,  '3', '2017-01-07 00:00:00' ,  '0',  '2'),

(NULL ,  '1', '2017-01-08 00:00:00' ,  '10',  '1'),
(NULL ,  '2', '2017-01-08 00:00:00' ,  '10',  '1'),
(NULL ,  '3', '2017-01-08 00:00:00' ,  '10',  '1'),

(NULL ,  '1', '2017-01-09 00:00:00' ,  '20',  '1'),
(NULL ,  '2', '2017-01-09 00:00:00' ,  '0',  '3'),
(NULL ,  '3', '2017-01-09 00:00:00' ,  '10',  '1'),

(NULL ,  '1', '2017-01-10 00:00:00' ,  '30',  '1'),
(NULL ,  '2', '2017-01-10 00:00:00' ,  '0',  '3'),
(NULL ,  '3', '2017-01-10 00:00:00' ,  '30',  '1'),

(NULL ,  '1', '2017-01-11 00:00:00' ,  '20',  '1'),
(NULL ,  '2', '2017-01-11 00:00:00' ,  '0',  '3'),
(NULL ,  '3', '2017-01-11 00:00:00' ,  '20',  '1'),

(NULL ,  '1', '2017-01-12 00:00:00' ,  '20',  '1'),
(NULL ,  '2', '2017-01-12 00:00:00' ,  '0',  '3'),
(NULL ,  '3', '2017-01-12 00:00:00' ,  '20',  '1'),

(NULL ,  '1', '2017-01-13 00:00:00' ,  '0',  '2'),
(NULL ,  '2', '2017-01-13 00:00:00' ,  '0',  '2'),
(NULL ,  '3', '2017-01-13 00:00:00' ,  '0',  '2'),

(NULL ,  '1', '2017-01-14 00:00:00' ,  '0',  '2'),
(NULL ,  '2', '2017-01-14 00:00:00' ,  '0',  '2'),
(NULL ,  '3', '2017-01-14 00:00:00' ,  '0',  '2')
;