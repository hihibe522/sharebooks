-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.6-MariaDB
-- PHP 版本： 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `sharebook`
--
CREATE DATABASE IF NOT EXISTS `sharebook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sharebook`;

-- --------------------------------------------------------

--
-- 資料表結構 `bookinfo`
--

CREATE TABLE `bookinfo` (
  `bookID` int(20) NOT NULL,
  `bookName` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `bookType` varchar(100) NOT NULL,
  `bookStatus` varchar(100) NOT NULL,
  `wanted` varchar(100) NOT NULL,
  `place` varchar(60) NOT NULL,
  `userID` int(16) NOT NULL,
  `bookImg` varchar(100) NOT NULL,
  `updateTime` date NOT NULL,
  `unable` int(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `bookinfo`
--

INSERT INTO `bookinfo` (`bookID`, `bookName`, `author`, `bookType`, `bookStatus`, `wanted`, `place`, `userID`, `bookImg`, `updateTime`, `unable`) VALUES
(5, '羅蘭自傳', '羅蘭德', '自傳', '全新', '聖經', '中部', 13, 'images/1582817876-312789021_wn.jpg', '2020-06-08', 0),
(6, '哈利波特外傳', '羅琳', '奇幻文學', '好', 'BL相關', '中部', 13, 'images/2015090300011663135.jpg', '2020-06-08', 0),
(8, 'HEBE', '田', '雜誌', '全新', '其他雜誌', '北部', 7, 'images/1494415938-3835021064_l.jpg', '2020-06-10', 0),
(9, ' Democracy', 'Zachary D', '英文', '全新', '科普', '北部', 5, 'images/getImage.jpg', '2020-06-10', 1),
(11, '莎士比亞植物圖鑑', ' 葛芮特・奎利', '植物圖鑑', '好', '雜誌', '中部', 8, 'images/getImage (2).jpg', '2020-06-11', 0),
(14, '黑人梵谷', '馬卡', '大眾文學', '好', '科普', '北部', 8, 'images/635924178437967500.jpg', '2020-06-11', 0),
(20, '蝦蟆的油', '黑澤明', '藝術', '好', 'comic', '中部', 3, 'images/p.jpg', '2020-06-12', 0),
(21, '美麗佳人', ' 國際亞洲', '流行時尚', '良好', '食譜', '南部', 8, 'images/637267785374403750.jpg', '2020-06-12', 1),
(22, '長崎 Nagasaki', 'Éric Faye', '歐美文學', '看完一次', '放鬆系列', '中部', 2, 'images/637243507961427542.jpg', '2020-06-12', 1),
(23, 'Hanako(No.1184)', 'マガジンハウス', '日文雜誌', '好', '插畫集', '中部', 2, 'images/637246122252833792.jpg', '2020-06-12', 1),
(25, '我想躲起來一下', 'LuckyLuLu', '圖文漫畫', '好', '畫冊', '中部', 4, 'images/637272301661805000.jpg', '2020-06-12', 1),
(26, '如何賺進一千萬', '鍋鍋', '理財', '加持過', 'BL相關 姍最愛', '北部', 16, 'images/sql_join.png', '2020-06-12', 0),
(27, '如何賺進一億', '羅蘭德的師傅', '奇幻文學', '很讚 有光芒', '金融', '北部', 16, 'images/1582817876-312789021_wn.jpg', '2020-06-12', 1),
(28, '小確幸-占卜今天的你', 'AllisonChen', '占卜', '限量絕版書', '因為是限量絕版書，希望能一換二謝謝', '中部', 13, 'images/Tarot_3.png', '2020-06-12', 0),
(38, 'Japan Walker', '我傳媒', '旅遊', '六月 其它優惠/消息', '平面設計相關', '中部', 18, 'images/637272895691336250.jpg', '2020-06-13', 1),
(39, 'More Myself: A Journey', 'Flatiron Books', '音樂', '良好', '雜誌', '中部', 18, 'images/637258202005778750.jpg', '2020-06-13', 1),
(40, '[在庸碌的社會中你需要休息]', '愛麗森', '勵志書', '7成新，有被狗咬過', '航海王', '北部', 13, 'images/Tarot_8.png', '2020-06-14', 1),
(41, '一拳超人21', '村田雄介', '漫畫', '9成新', '鬼滅之刃', '北部', 13, 'images/0000059863.jpg', '2020-06-14', 1),
(42, '京都歷史迷走', '胡川安', '人文', '佳', '皆可', '北部', 11, 'images/637272882956805000.jpg', '2020-06-14', 1),
(43, 'Anne Frank', '約瑟芬．普利', '圖畫書', '好', '童書', '中部', 19, 'images/637268840273935000.jpg', '2020-06-14', 1),
(44, 'The Cat and The City', 'Nick Bradley', '西洋文學', '好', '語言學習', '中部', 11, 'images/637244370251115042.jpg', '2020-06-14', 1),
(46, '哈利波特 4: 火盃的考驗', 'J. K. 羅琳', '小說', '好', '第五集', '北部', 17, 'images/633541523243281250.jpg', '2020-06-14', 1),
(47, '我家的貓又在幹怪事了', '卵山玉子', '圖文漫畫', '好', '插畫', '北部', 17, 'images/636622292540918750.jpg', '2020-06-14', 0),
(48, 'The girl with dragon tattoo', 'Larz', 'Crime', 'bRrand nEW', '火盃的考驗', '中部', 21, 'images/The-Girl-With-The-Dragon-Tattoo.jpg', '2020-06-15', 1),
(50, 'Shoot for the Moon', 'Tim Walker', '攝影', '好', '文學類', '北部', 3, 'images/123.jpg', '2020-06-15', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `bookorder`
--

CREATE TABLE `bookorder` (
  `orderID` int(100) NOT NULL,
  `user` int(50) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userbook` int(50) NOT NULL,
  `userbookName` varchar(200) NOT NULL,
  `userbookImg` varchar(200) NOT NULL,
  `pasuser` int(50) NOT NULL,
  `pasuserName` varchar(100) NOT NULL,
  `pasbook` int(50) NOT NULL,
  `pasbookName` varchar(200) NOT NULL,
  `pasbookImg` varchar(200) NOT NULL,
  `ucheck` int(11) NOT NULL DEFAULT 1,
  `pcheck` int(11) NOT NULL DEFAULT 0,
  `complete` int(11) NOT NULL DEFAULT 0,
  `deny` int(10) NOT NULL DEFAULT 0,
  `ordermsg` varchar(1000) NOT NULL,
  `updatetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `bookorder`
--

INSERT INTO `bookorder` (`orderID`, `user`, `userName`, `userbook`, `userbookName`, `userbookImg`, `pasuser`, `pasuserName`, `pasbook`, `pasbookName`, `pasbookImg`, `ucheck`, `pcheck`, `complete`, `deny`, `ordermsg`, `updatetime`) VALUES
(2, 3, '嗶啵', 2, '快打旋風秘笈', 'images/電玩浮世繪8.jpg', 7, '吽吽', 8, 'HEBE', 'images/1494415938-3835021064_l.jpg', 0, 0, 0, 0, '嗶啵:想要~X@@X', '2020-06-11 14:28:05'),
(3, 8, '莎莉', 10, '輝耀之山', 'images/getImage (1).jpg', 3, '嗶啵', 1, '寶可夢圖鑑', 'images/電玩浮世繪9.jpg', 0, 0, 0, 0, '莎莉:你好，我想換這本X@@X', '2020-06-11 14:45:06'),
(4, 3, '嗶啵', 1, '寶可夢圖鑑', 'images/電玩浮世繪9.jpg', 13, '姍姍', 6, '哈利波特外傳', 'images/2015090300011663135.jpg', 0, 0, 0, 0, '嗶啵:拜託跟我換X@@X', '2020-06-11 14:50:55'),
(5, 8, '莎莉', 10, '輝耀之山', 'images/getImage (1).jpg', 3, '嗶啵', 7, '聊齋', 'images/電玩浮世繪7.jpg', 0, 0, 1, 0, '莎莉:想要~X@@X嗶啵:漫畫些許髒污喔X@@X', '2020-06-11 14:51:26'),
(6, 8, '莎莉', 11, '莎士比亞植物圖鑑', 'images/getImage (2).jpg', 3, '嗶啵', 1, '寶可夢圖鑑', 'images/電玩浮世繪9.jpg', 0, 0, 1, 0, '莎莉:安安很喜歡這本書X@@X嗶啵:好的X@@X嗶啵:rrewfeX@@X嗶啵:jjjjX@@X嗶啵:OKOKX@@X嗶啵:塊唷X@@X嗶啵:OKOKX@@X', '2020-06-11 16:11:45'),
(7, 3, '嗶啵', 1, '寶可夢圖鑑', 'images/電玩浮世繪9.jpg', 13, '姍姍', 5, '羅蘭自傳', 'images/1582817876-312789021_wn.jpg', 0, 0, 0, 0, '嗶啵:拜託跟我換X@@X', '2020-06-11 17:29:55'),
(8, 8, '莎莉', 14, '黑人梵谷', 'images/635924178437967500.jpg', 3, '嗶啵', 2, '快打旋風秘笈', 'images/電玩浮世繪8.jpg', 0, 0, 0, 1, '莎莉:很有興趣X@@X', '2020-06-11 20:07:59'),
(9, 3, '嗶啵', 12, '環遊世界八十樹', 'images/getImage (3).jpg', 8, '莎莉', 14, '黑人梵谷', 'images/635924178437967500.jpg', 0, 0, 0, 0, '嗶啵:拜託跟我換X@@X嗶啵:你好X@@X', '2020-06-11 20:53:56'),
(10, 3, '嗶啵', 17, '馬力歐', 'images/getImage (1).jpg', 8, '莎莉', 14, '黑人梵谷', 'images/635924178437967500.jpg', 0, 0, 0, 0, '嗶啵:想要~X@@X', '2020-06-11 21:43:21'),
(11, 3, '嗶啵', 18, ' 瓜地馬拉手繪旅行', 'images/637255605560851250.jpg', 8, '莎莉', 14, '黑人梵谷', 'images/635924178437967500.jpg', 0, 0, 0, 0, '嗶啵:快快快X@@X', '2020-06-11 21:55:43'),
(12, 3, '嗶啵', 12, '環遊世界八十樹', 'images/getImage (3).jpg', 13, '姍姍', 6, '哈利波特外傳', 'images/2015090300011663135.jpg', 1, 0, 0, 0, '嗶啵:感覺很有趣X@@X', '2020-06-11 22:08:48'),
(13, 3, '嗶啵', 20, '蝦蟆的油', 'images/p.jpg', 7, '吽吽', 8, 'HEBE', 'images/1494415938-3835021064_l.jpg', 0, 0, 0, 0, '嗶啵:好特別的書~X@@X嗶啵:78955X@@X嗶啵:可以嗎X@@X', '2020-06-12 01:35:00'),
(14, 8, '莎莉', 14, '黑人梵谷', 'images/635924178437967500.jpg', 3, '嗶啵', 19, '寶可夢圖鑑', 'images/電玩浮世繪9.jpg', 1, 0, 0, 0, '莎莉:想要~X@@X', '2020-06-12 02:10:06'),
(15, 16, 'kuokuo', 26, '如何賺進一千萬', 'images/sql_join.png', 4, '安安', 25, '我想躲起來一下', 'images/637272301661805000.jpg', 0, 0, 0, 0, 'kuokuo:我想躲起來，BE太強X@@Xkuokuo:快給我X@@Xkuokuo:12134567sfX@@X', '2020-06-12 11:07:40'),
(16, 16, 'kuokuo', 26, '如何賺進一千萬', 'images/sql_join.png', 13, '姍姍', 5, '羅蘭自傳', 'images/1582817876-312789021_wn.jpg', 0, 0, 1, 0, 'kuokuo:教你賺錢 快跟我換X@@X姍姍:你太廢了X@@X姍姍:你書很爛耶X@@X姍姍:回我X@@X姍姍:郭快去改CSSX@@X', '2020-06-12 11:09:38'),
(18, 3, '嗶啵', 24, '戰略大歷史', 'images/637238326255968750.jpg', 4, '安安', 25, '我想躲起來一下', 'images/637272301661805000.jpg', 0, 0, 0, 0, '嗶啵:拜託跟我換X@@X', '2020-06-12 11:57:43'),
(19, 3, '嗶啵', 19, '寶可夢圖鑑', 'images/電玩浮世繪9.jpg', 16, 'kuokuo', 27, '如何賺進一億 (羅蘭強力推薦)', 'images/1582817876-312789021_wn.jpg', 1, 0, 0, 0, '嗶啵:拜託跟我換X@@X', '2020-06-12 13:29:24'),
(20, 13, '姍姍', 6, '哈利波特外傳', 'images/2015090300011663135.jpg', 7, '吽吽', 8, 'HEBE', 'images/1494415938-3835021064_l.jpg', 0, 0, 1, 0, '姍姍:拜託我真的很想要X@@X姍姍:你再不回我我就要取消了X@@X姍姍:快點X@@X姍姍:我要給你一星X@@X', '2020-06-12 14:07:50'),
(21, 16, 'kuokuo', 27, '如何賺進一億 (羅蘭強力推薦)', 'images/1582817876-312789021_wn.jpg', 13, '姍姍', 28, '小確幸-占卜今天的你', 'images/Tarot_3.png', 0, 0, 0, 1, 'kuokuo:c8 8 8c8 8c8 8c8c8 8 c8 8X@@Xkuokuo:快點好嗎X@@Xkuokuo:托台錢，你不換我要跟別人換了喔X@@Xkuokuo:不要以為你很強 就可以這樣X@@Xkuokuo:又在那邊SHOWX@@Xkuokuo:心很累X@@Xkuokuo:是要不要看留言阿X@@Xkuokuo:實在很脫 托台錢X@@Xkuokuo:網咖很貴耶X@@X姍姍:我要拒絕了掰掰X@@X姍姍:= =X@@X姍姍:你到底想怎樣X@@X', '2020-06-12 14:28:36'),
(22, 3, '嗶啵', 37, '猫を棄てる', 'images/637255622243351250.jpg', 4, '安安', 25, '我想躲起來一下', 'images/637272301661805000.jpg', 0, 0, 0, 0, '嗶啵:拜託跟我換X@@X', '2020-06-13 17:23:37'),
(23, 13, '姍姍', 28, '小確幸-占卜今天的你', 'images/Tarot_3.png', 8, '莎莉', 21, '美麗佳人', 'images/637267785374403750.jpg', 1, 0, 0, 0, '姍姍:想要~X@@X', '2020-06-13 17:27:39'),
(25, 3, '嗶啵', 20, '蝦蟆的油', 'images/p.jpg', 4, '安安', 25, '我想躲起來一下', 'images/637272301661805000.jpg', 0, 0, 0, 0, '嗶啵:喜歡~~X@@X', '2020-06-13 18:00:21'),
(26, 11, 'UNO', 42, '京都歷史迷走', 'images/637272882956805000.jpg', 3, '嗶啵', 37, '猫を棄てる', 'images/637255622243351250.jpg', 0, 0, 0, 1, 'UNO:感覺是很有趣的書呢X@@X', '2020-06-14 20:02:53'),
(28, 3, '嗶啵', 20, '蝦蟆的油', 'images/p.jpg', 19, 'HAHA', 43, 'Anne Frank', 'images/637268840273935000.jpg', 0, 0, 0, 0, '嗶啵:好像很不錯耶^^X@@X', '2020-06-14 20:39:45'),
(31, 3, '嗶啵', 20, '蝦蟆的油', 'images/p.jpg', 19, 'HAHA', 43, 'Anne Frank', 'images/637268840273935000.jpg', 1, 0, 0, 0, '嗶啵:拜託跟我換X@@X', '2020-06-15 12:06:29'),
(32, 3, '嗶啵', 50, 'Shoot for the Moon', 'images/123.jpg', 17, 'CC', 47, '我家的貓又在幹怪事了', 'images/636622292540918750.jpg', 0, 0, 1, 0, '嗶啵:hhhhhhX@@X', '2020-06-15 15:05:32');

-- --------------------------------------------------------

--
-- 資料表結構 `userinfo`
--

CREATE TABLE `userinfo` (
  `userID` int(16) NOT NULL,
  `userAccount` varchar(16) NOT NULL,
  `userName` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `userinfo`
--

INSERT INTO `userinfo` (`userID`, `userAccount`, `userName`, `password`, `email`) VALUES
(2, 'QQQ', '小Q', '1111', 'weqf@dfsarf.vom'),
(3, 'be', '嗶啵', '1111', 'ddda@hii.com'),
(4, 'hello', '安安', '1111', 'fewfwf@fww.ccom'),
(5, 'KK', '嘎嘎', '0000', 'fskelg@udj.com'),
(6, 'lglg', '安根', '1111', 'aaaaaa@dscsd.com'),
(7, 'pp', '吽吽', '1234', 'rfs@qwr.com'),
(8, 'popo', '莎莉', '0000', 'rfewf@dwf.com'),
(9, 'ttt77', 'SDO', '456', 'dwf@dscs.com'),
(10, 'lll', 'FOFRG', '1234', 'dwekk@wf.com'),
(11, 'uuu', 'UNO', '1111', 'wfsf@sfsf.com'),
(13, 'allison', '姍姍', '1234', 'a123@gmail.com'),
(16, '123456', 'kuokuo', '123456', 'ibthtrhe@gmail.com'),
(17, 'ccc', 'CC', '1111', 'regeg@veg.cob'),
(18, 'tzu', '阿姿', '1234', 'wfef@wfwf.com'),
(19, 'haha', 'HAHA', '1111', 'fee@dd'),
(20, 'jojo', '啾啾', '1234', 'sdf@dd'),
(21, 'daniel', '小丹尼', '1', 'daniel0914j@gmail.com');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `bookinfo`
--
ALTER TABLE `bookinfo`
  ADD PRIMARY KEY (`bookID`);

--
-- 資料表索引 `bookorder`
--
ALTER TABLE `bookorder`
  ADD PRIMARY KEY (`orderID`);

--
-- 資料表索引 `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bookinfo`
--
ALTER TABLE `bookinfo`
  MODIFY `bookID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bookorder`
--
ALTER TABLE `bookorder`
  MODIFY `orderID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
