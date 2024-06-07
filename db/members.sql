-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-06-06 14:22
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
-- 테이블 구조 `members`
--

CREATE TABLE `members` (
  `id` char(15) NOT NULL,
  `name` char(20) NOT NULL,
  `age` int(3) NOT NULL,
  `pass` char(15) NOT NULL,
  `p_num` char(15) NOT NULL,
  `gender` char(2) NOT NULL,
  `address` char(30) NOT NULL,
  `hobby` char(100) NOT NULL,
  `mq` char(200) NOT NULL,
  `image` text NOT NULL,
  `musician` char(5) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `members`
--

INSERT INTO `members` (`id`, `name`, `age`, `pass`, `p_num`, `gender`, `address`, `hobby`, `mq`, `image`, `musician`, `level`) VALUES
('관리자', '관리하는사람', 14, '12', '01084652659', '여자', '서울', 'POP, 아이돌, JPOP', '관리자입니다!', '2024_06_06_13_57_05_흰둥이.jpg', 'true', 3),
('뮤지션', '뮤지션', 24, '11', '01098653456', '남자', '경기', '발라드', '발라더입니다!', '2024_06_06_13_55_32_훈이.jpg', 'true', 1),
('일반인', '일반인', 43, '11', '01098645325', '남자', '인천', '아이돌', '아이돌을 좋아합니다!', '2024_06_06_13_56_06_맹구.jpg', 'false', 1);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
