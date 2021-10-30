START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `is_active` BOOLEAN DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_type`, `is_active`, `created_at`, `updated_at`) VALUES
(7, 'Nababurbd', 'nababurbd@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', 'super_admin', 1, '2020-03-12 16:23:01', '2020-03-12 16:23:01'),
(12, 'Rayhan', 'rayhankabir@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', 'admin', 1, '2020-03-12 18:20:24', '2020-03-12 18:20:24'),
(15, 'Sanjida', 'sanjida@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', 'user', 1, '2020-03-12 19:32:27', '2020-03-12 19:32:27'),
(16, 'Abid', 'abid@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', 'user', 1, '2020-03-13 05:08:26', '2020-03-13 05:08:26'),
(17, 'Rouf', 'rouf@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', 'user', 1, '2020-03-13 05:08:53', '2020-03-13 05:08:53'),
(18, 'Maruf', 'maruf@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', 'admin', 1, '2020-03-13 05:09:18', '2020-03-13 05:09:18'),
(19, 'Munna', 'munna@gmail.com', '66c3241204bea40578eb993f41f7c4b1ab982dab', 'user', 1, '2020-03-13 05:09:49', '2020-03-13 05:09:49'),
(20, 'Rashed', 'rashed@gmail.com', '188000e1f0fb4075ae1c659697b96296f982cdc4', 'user', 1, '2020-03-13 05:10:24', '2020-03-13 05:10:24'),
(21, 'Millon', 'millon@gmail.com', '05c19fb114728eabf85f47c858914ca42ddd2dae', 'user', 1, '2020-03-13 05:11:02', '2020-03-13 05:11:02');


CREATE TABLE `tasks` (
  `id` int(11) NOT NULL COMMENT 'task_id',
  `category` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `done` BOOLEAN DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB;

INSERT INTO `tasks` (`id`, `category`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'supply', 'Купи пива', '2 бочёнка тёмного и один светлого', '2020-03-12 16:23:01', '2020-03-12 16:23:01'),
(12, 'read', 'Прочьти книгу', 'Ромео и Джульетта, всё как полагается', '2020-04-12 10:20:24', '2020-03-12 18:20:24'),
(15, 'contact', 'Встреть Сашу', 'Она приезжает в 8 в аэропорт', '2020-05-12 19:32:27', '2020-03-12 19:32:27'),
(16, 'to_do', 'Зделай зарядку', '3 подхода по 5 повторений и не меньше!', '2020-04-01 05:08:26', '2020-03-13 05:08:26');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


COMMIT;