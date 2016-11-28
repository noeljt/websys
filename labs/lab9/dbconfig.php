<?php

$config = array(
   'DB_HOST'     => 'localhost',
   'DB_USERNAME' => 'root',
   'DB_PASSWORD' => 'root',
);

$sql1 = "CREATE DATABASE `noelj-websyslab9`;
         USE `noelj-websyslab9`;
         CREATE TABLE `courses` (
            `crn` int(11) NOT NULL,
            `prefix` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
            `number` smallint(4) NOT NULL,
            `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `section` smallint(2) NOT NULL,
            `year` smallint(4) NOT NULL
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
         CREATE TABLE `grades` (
            `id` int(11) NOT NULL,
            `crn` int(11) NOT NULL,
            `rin` int(11) NOT NULL,
            `grade` int(3) NOT NULL
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
         CREATE TABLE `students` (
            `rin` int(9) NOT NULL,
            `rcisID` char(7) COLLATE utf8_unicode_ci NOT NULL,
            `first name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
            `last name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
            `alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
            `phone` int(10) NOT NULL,
            `street` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
            `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
            `st` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
            `zip` int(6) NOT NULL
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
         ALTER TABLE `courses` ADD PRIMARY KEY (`crn`);
         ALTER TABLE `grades` ADD PRIMARY KEY (`id`);
         ALTER TABLE `students` ADD PRIMARY KEY (`rin`);
         ALTER TABLE `grades` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;";
?>