-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 7 月 21 日 12:08
-- サーバのバージョン： 5.7.32
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `lunch`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `menue`
--

CREATE TABLE `menue` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `menuename` varchar(30) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `menue`
--

INSERT INTO `menue` (`id`, `store_id`, `menuename`, `price`) VALUES
(1, 1, 'Roastbeef Sand', 400),
(2, 1, 'Smoaksalmon Sand', 400),
(3, 1, 'Roastbeef Bowl', 700),
(4, 1, 'Smoaksalmon Bowl', 700),
(5, 2, 'チャーシュー麺', 1000),
(6, 2, '醤油ラーメン', 600),
(7, 2, 'あんかけラーメン', 800),
(8, 2, '野菜ラーメン', 800),
(9, 3, '天丼', 1200),
(10, 3, '天ぷら', 800),
(11, 3, 'ざるそば', 900),
(12, 3, 'そば', 900);

-- --------------------------------------------------------

--
-- テーブルの構造 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `coupon` varchar(11) NOT NULL,
  `order_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `store_id`, `price`, `coupon`, `order_time`) VALUES
(298, 8, 1, 4000, '500yenOff!!', '2021-07-20 13:50:55'),
(299, 8, 2, 5600, '400yenOff!!', '2021-07-20 13:51:07'),
(300, 8, 3, 14500, '200yenOff', '2021-07-20 13:51:17'),
(301, 8, 1, 2000, '', '2021-07-20 13:51:24'),
(302, 8, 2, 5000, '300yenOff!', '2021-07-20 13:51:30'),
(303, 1, 1, 800, '', '2021-07-20 13:52:03'),
(304, 1, 2, 5800, '200yenOff', '2021-07-20 13:52:12'),
(305, 1, 3, 16200, '500yenOff!!', '2021-07-20 13:52:20'),
(306, 5, 1, 2000, '300yenOff!', '2021-07-20 16:59:34'),
(307, 1, 1, 2000, '300yenOff!', '2021-07-20 20:03:16'),
(308, 1, 2, 6800, '', '2021-07-20 20:03:34'),
(309, 1, 3, 10000, '500yenOff!!', '2021-07-20 20:03:47');

-- --------------------------------------------------------

--
-- テーブルの構造 `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `menu_id`, `quantity`) VALUES
(362, 307, 1, 5),
(363, 308, 5, 2),
(364, 308, 8, 6),
(365, 309, 9, 2),
(366, 309, 10, 5),
(367, 309, 11, 2),
(368, 309, 12, 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `para`
--

CREATE TABLE `para` (
  `id` int(11) NOT NULL,
  `reset_url` varchar(100) NOT NULL,
  `reset_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `store_name` varchar(30) NOT NULL,
  `store_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `store`
--

INSERT INTO `store` (`id`, `store_name`, `store_address`) VALUES
(1, 'cafe owl', '上野稲荷町111'),
(2, '山田ラーメン', '上野稲荷町２２２'),
(3, '天ぷらや', '上野稲荷町３３３');

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `address` varchar(100) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `pass`, `address`, `role`) VALUES
(1, '西', 'ji@gmail.com', '$2y$10$Vgre5qd3dKxjoaM5ejjZ2.wIegw4hz/eytRNc44XwTeHz4DWlUX6u', '東京都　台東区 浅草　1-1-1', 0),
(5, 'cafe owl', 'owl@gmail.com', '$2y$10$Y/9BBmnxj/hDmwu/v4BQE.J/kOgvrwyZZvczuAnyt39GJvNbHUcMe', '東京都　台東区　4-2-10', 1),
(6, '山田ラーメン', 'yamada@gmail.com', '$2y$10$/EJazuRdOc7vwSJ8jky9ROdVweRtG5QjKzwHbdp3D1tEHE.M2rGMq', '東京都　台東区　1-2-301', 2),
(7, '天ぷら', 'tennpura@gmail.com', '$2y$10$9arrddWc8qHn3VxJNpxo4.ez5LKgEhe8tMQWAnZt9hlkeQVTHqGhq', '東京都　台東区　浅草　1-3', 3),
(8, '一般人', 'ippann@gmail.com', '$2y$10$LpUoXx/HODK8ZeonhJHw..BYiBPaNHmFaR/qSdziYNWlKuh579cSy', '東京都　台東区　5-4-3', 100),
(39, '山田太郎', 'yamadataro@gmail.com', '$2y$10$TuN1X3XhFiLxHMR3pWuxg.9TsNSxZZpPYKqOJL83/U5NlH02aKwlS', '東京都　台東区　上野　1-2-3', 100);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `menue`
--
ALTER TABLE `menue`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `para`
--
ALTER TABLE `para`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `menue`
--
ALTER TABLE `menue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- テーブルの AUTO_INCREMENT `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- テーブルの AUTO_INCREMENT `para`
--
ALTER TABLE `para`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- テーブルの AUTO_INCREMENT `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;