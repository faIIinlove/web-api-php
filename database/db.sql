CREATE DATABASE IF NOT EXISTS MD18101;
USE MD18101;

-- TẠO BẢNG
-- tạo bảng users {id, email, password, name, phone, gender, student_code, picture, address, role}
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `student_code` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- tạo bảng topics (id, name, description)
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- tạo bảng news (id, title, content, created_at, topic_id, user_id)
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`),
  CONSTRAINT `news_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- thêm dữ liệu vào bảng users
INSERT INTO `users` (`id`, `email`, `password`, `name`, `phone`, `gender`, `student_code`, `picture`, `address`, `role`) VALUES
(1, 'phongphi@gmail.com', '123456', 'Phong Phi', '0123456789', 'Nam', 'PH123456', 'https://firebasestorage.googleapis.com/v0/b/aniflix-958d2.appspot.com/o/%E1%BA%A2nh%2FPhi.jpg?alt=media&token=b2255ba9-7712-41cb-8cd9-eb709736ed10', 'Hà Nội', 'user'),
(2, 'anhduy@gmail.com', '123456', 'Anh Duy', '0123456789', 'Nam', 'PH123456', 'https://firebasestorage.googleapis.com/v0/b/aniflix-958d2.appspot.com/o/%E1%BA%A2nh%2Fanh.jpg?alt=media&token=1bb0f3bd-c49b-4cb5-a55e-fade4f027b68', 'Hà Nội', 'user'),
(3, 'cuphuc@gmail.com', '123456', 'Cụ Phúc', '0123456789', 'Nam', 'PH123456', 'https://firebasestorage.googleapis.com/v0/b/aniflix-958d2.appspot.com/o/%E1%BA%A2nh%2Fc%E1%BB%A5.jpg?alt=media&token=49266b7b-0277-47ed-822d-26e4810111de', 'Hà Nội', 'user'),
(4, 'qui@gmail.com', '123456', 'Quí', '0123456789', 'Nam', 'PH123456', 'https://firebasestorage.googleapis.com/v0/b/aniflix-958d2.appspot.com/o/%E1%BA%A2nh%2Fdaubuoi.jpg?alt=media&token=0cfcb1d6-34a6-40e6-9f69-45c3f6e7798c', 'Hà Nội', 'user'),
(5, 'phap@gmail.com', '123456', 'Pháp', '0123456789', 'Nam', 'PH123456', 'https://firebasestorage.googleapis.com/v0/b/aniflix-958d2.appspot.com/o/%E1%BA%A2nh%2Fngu.jpg?alt=media&token=ba030c9a-99cd-4169-8f9a-f728669551ab', 'Hà Nội', 'user'),
(6, 'phucnamvan123@gmail.com', '123456', 'Văn Nam Phúc', '0123456789', 'Nam', 'PS25452', 'https://lh3.googleusercontent.com/ogwAKPQZvx53PP6RhecpAqg5Ig9Y79L6mg3-LduaWLlGctWSw=s720-c-mo', 'Hà Nội', 'admin');

-- thêm dữ liệu vào bảng topics
INSERT INTO `topics` (`id`, `name`, `description`) VALUES
(1, 'Thời sự', 'Tin tức thời sự'),
(2, 'Thể thao', 'Tin tức thể thao'),
(3, 'Giải trí', 'Tin tức giải trí');

-- thêm dữ liệu vào bảng news
INSERT INTO `news` (`id`, `title`, `content`, `created_at`, `topic_id`, `user_id`) VALUES
(1, 'Tin tức 1', 'Nội dung tin tức 1', '2020-11-01 00:00:00', 1, 1),
(2, 'Tin tức 2', 'Nội dung tin tức 2', '2020-11-01 00:00:00', 1, 1),
(3, 'Tin tức 3', 'Nội dung tin tức 3', '2020-11-01 00:00:00', 1, 1),
(4, 'Tin tức 4', 'Nội dung tin tức 4', '2020-11-01 00:00:00', 2, 1),
(5, 'Tin tức 5', 'Nội dung tin tức 5', '2020-11-01 00:00:00', 2, 1),
(6, 'Tin tức 6', 'Nội dung tin tức 6', '2020-11-01 00:00:00', 2, 1),
(7, 'Tin tức 7', 'Nội dung tin tức 7', '2020-11-01 00:00:00', 3, 1),
(8, 'Tin tức 8', 'Nội dung tin tức 8', '2020-11-01 00:00:00', 3, 1),
(9, 'Tin tức 9', 'Nội dung tin tức 9', '2020-11-01 00:00:00', 3, 1),
(10, 'Tin tức 10', 'Nội dung tin tức 10', '2020-11-01 00:00:00', 1, 2);