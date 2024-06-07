-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-06-06 14:21
-- 서버 버전: 10.4.32-MariaDB
-- PHP 버전: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `music`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `dibs`
--

CREATE TABLE `dibs` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) DEFAULT NULL,
  `item_num` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `dibs`
--

INSERT INTO `dibs` (`id`, `userid`, `item_num`, `created_at`) VALUES
(24, '관리자', 11, '2024-06-06 12:20:40');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `dibs`
--
ALTER TABLE `dibs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `dibs`
--
ALTER TABLE `dibs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `dibs`
--
ALTER TABLE `dibs`
  ADD CONSTRAINT `dibs_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `members` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
