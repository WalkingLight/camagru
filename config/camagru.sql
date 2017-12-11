
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Insert comments
--

INSERT INTO `comments` (`id`, `username`, `user_comment`, `image_name`, `created`) VALUES
(1, 'test', 'This is a test comment', 'img/user/test13.jpg', '2017-11-27 11:56:24'),
(2, 'test', 'cool pic', 'img/user/test13.jpg', '2017-11-28 13:16:00'),
(3, 'ryan', 'I like it', 'img/user/test13.jpg', '2017-11-28 13:16:22'),
(4, 'test', 'this is a doggie', 'img/user/test12.jpg', '2017-11-28 13:16:59'),
(5, 'test', 'test', 'img/user/test13.jpg', '2017-11-29 13:13:19'),
(6, 'test', 'hello', 'img/user/test12.jpg', '2017-11-29 13:13:26'),
(7, 'test', 'ayyyyyyy', 'img/user/test13.jpg', '2017-11-29 13:13:34'),
(8, 'test', 'It works', 'img/user/test13.jpg', '2017-11-29 13:13:38'),
(9, 'test', 'Sick ride bru', 'img/user/test11.jpg', '2017-11-29 13:14:24'),
(10, 'test', 'Sunday with the boi&#039;s', 'img/user/test10.jpg', '2017-11-29 13:14:42'),
(11, 'test', 'It&#039;s a tree doggo', 'img/user/test1.jpg', '2017-11-29 13:14:58'),
(12, 'test', 'THis is a reaaaalllllllllllllllllllllllllyyyyyyyyyyyyyyyyyyyyyyy long test commmmmmmmeeeennnnntttt so does it work?', 'img/user/test13.jpg', '2017-11-29 13:28:28'),
(13, 'test', 'birdy', 'img/user/test12.jpg', '2017-11-29 13:30:11'),
(14, 'test', 'test', 'img/user/test1.jpg', '2017-11-29 13:31:04'),
(15, 'test', 'test', 'img/user/test12.jpg', '2017-11-29 14:18:18'),
(16, 'test', 'moon moon', 'img/user/test5.jpg', '2017-11-29 14:18:32'),
(17, 'test', 'Just bear in there', 'img/user/test2.jpg', '2017-11-29 14:18:43'),
(18, 'ryan', 'sick pic', 'img/user/test13.jpg', '2017-11-29 14:26:02'),
(19, 'ryan', 'why hello there', 'img/user/test11.jpg', '2017-11-29 14:33:22'),
(20, 'test', 'lmao', './img/user/test1.png', '2017-11-29 14:38:24'),
(21, 'ryan', 'dat me roflmao', './img/user/test1.png', '2017-11-29 14:38:47'),
(22, 'ryan', '#cannonball', 'img/user/test7.jpg', '2017-11-29 14:39:34'),
(23, 'ryan', 'email validation', './img/user/test1.png', '2017-11-29 14:42:58'),
(24, 'ryan', 'linuts', './img/user/ryan1.png', '2017-11-29 14:45:52'),
(25, 'hello', 'sup', 'img/user/test13.jpg', '2017-11-29 14:53:35'),
(26, 'hello', '10/10', './img/user/hello1.png', '2017-11-30 07:28:27'),
(27, 'ryan', 'Dat cat doe', './img/user/hello3.png', '2017-11-30 07:55:59');

-- --------------------------------------------------------

--
-- Insert Images
--

INSERT INTO `images` (`id`, `username`, `image_name`, `created`) VALUES
(13, 'test', 'img/user/test1.jpg', '2017-11-20 13:42:24'),
(14, 'test', 'img/user/test2.jpg', '2017-11-20 13:42:41'),
(15, 'test', 'img/user/test3.jpg', '2017-11-20 13:42:52'),
(17, 'test', 'img/user/test4.jpg', '2017-11-20 13:47:51'),
(18, 'test', 'img/user/test5.jpg', '2017-11-20 13:47:58'),
(19, 'test', 'img/user/test6.jpg', '2017-11-20 13:48:08'),
(20, 'test', 'img/user/test7.jpg', '2017-11-20 13:48:13'),
(21, 'test', 'img/user/test8.jpg', '2017-11-20 13:48:20'),
(22, 'test', 'img/user/test9.jpg', '2017-11-20 13:48:25'),
(23, 'test', 'img/user/test10.jpg', '2017-11-20 13:48:33'),
(24, 'test', 'img/user/test11.jpg', '2017-11-20 13:48:40'),
(25, 'test', 'img/user/test12.jpg', '2017-11-20 13:48:46'),
(26, 'test', 'img/user/test13.jpg', '2017-11-20 13:48:51'),
(28, 'hello', './img/user/hello1.png', '2017-11-30 07:28:18'),
(30, 'hello', './img/user/hello3.png', '2017-11-30 07:55:27');

-- --------------------------------------------------------

--
-- Insert likes
--

INSERT INTO `likes` (`id`, `username`, `image_name`, `created`) VALUES
(1, 'test', 'img/user/test13.jpg', '2017-11-29 13:58:49'),
(2, 'test', 'img/user/test12.jpg', '2017-11-29 13:58:52'),
(3, 'test', 'img/user/test11.jpg', '2017-11-29 14:05:41'),
(4, 'test', 'img/user/test10.jpg', '2017-11-29 14:05:47'),
(5, 'test', 'img/user/test5.jpg', '2017-11-29 14:08:44'),
(6, 'test', 'img/user/test9.jpg', '2017-11-29 14:12:07'),
(7, 'test', 'img/user/test6.jpg', '2017-11-29 14:12:23'),
(8, 'test', 'img/user/test8.jpg', '2017-11-29 14:14:08'),
(9, 'test', 'img/user/test4.jpg', '2017-11-29 14:14:14'),
(10, 'test', 'img/user/test1.jpg', '2017-11-29 14:14:18'),
(11, 'test', 'img/user/test7.jpg', '2017-11-29 14:25:18'),
(12, 'ryan', 'img/user/test3.jpg', '2017-11-29 14:26:58'),
(13, 'ryan', 'img/user/test2.jpg', '2017-11-29 14:27:05'),
(14, 'ryan', 'img/user/test13.jpg', '2017-11-29 14:32:59'),
(15, 'ryan', 'img/user/test12.jpg', '2017-11-29 14:33:01'),
(16, 'ryan', 'img/user/test1.jpg', '2017-11-29 14:33:05'),
(17, 'ryan', 'img/user/test11.jpg', '2017-11-29 14:33:25'),
(18, 'ryan', './img/user/test1.png', '2017-11-29 14:38:50'),
(19, 'ryan', 'img/user/test6.jpg', '2017-11-29 14:39:07'),
(20, 'ryan', './img/user/ryan1.png', '2017-11-29 14:45:53'),
(21, 'test', './img/user/ryan1.png', '2017-11-29 14:46:12'),
(22, 'hello', 'img/user/test13.jpg', '2017-11-29 14:53:31'),
(23, 'hello', './img/user/hello1.png', '2017-11-30 07:28:29'),
(24, 'hello', 'img/user/test2.jpg', '2017-11-30 07:54:19'),
(25, 'hello', 'img/user/test1.jpg', '2017-11-30 07:54:22'),
(26, 'hello', './img/user/hello3.png', '2017-11-30 07:55:36');

-- --------------------------------------------------------

--
-- Insert Users
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `create_date`, `token`, `verified`) VALUES
(2, 'ryan', 'ryan.heukelman@gmail.com', '8c9ec9f0ac6ad6fea526dad1171e7507262d0ea9541a2e6ddcc5767a239d1da9edea948dbde5494bb7fb27df24d6ac5dfc3ad47cc52af76a7e9146c5125c6cf5', '2017-11-08 12:08:54', '8f468c873a32bb0619eaeb2050ba45d1', 1),
(4, 'test1', 'test1@gmail.com', '989bac194dc428df07bd8f455326765ad001c7b3909c86b63400641fddc9bc4a205ca18458e112e978e6c9576a6a397fa2203cf458ca0412886b57c23b386f76', '2017-11-08 13:01:35', 'e7f8a7fb0b77bcb3b283af5be021448f', 0),
(6, 'test', 'walkinglight1@gmail.com', '8c9ec9f0ac6ad6fea526dad1171e7507262d0ea9541a2e6ddcc5767a239d1da9edea948dbde5494bb7fb27df24d6ac5dfc3ad47cc52af76a7e9146c5125c6cf5', '2017-11-20 13:23:35', '839ab46820b524afda05122893c2fe8e', 1),
(7, 'hello', 'test@test.com', '3e128b3b88dfa5f4f84a88c7cc88f0f6a1470b7fb2d454891dfa72525784411f8027cdaf11c6b438fff1eba25ab31e3a8b6112a6729214523c2e1b6cdb15bd24', '2017-11-29 14:52:58', '182be0c5cdcd5072bb1864cdee4d3d6e', 1);
