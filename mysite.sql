
CREATE TABLE `assignedusers` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `taskID` int(11) NOT NULL,
 `username` varchar(128) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4


CREATE TABLE `projectdata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `projectname` varchar(128) NOT NULL,
 `creater` varchar(128) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4


CREATE TABLE `taskdata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `pid` int(11) NOT NULL,
 `title` varchar(128) NOT NULL,
 `content` longtext NOT NULL,
 `deadline` datetime NOT NULL,
 `status` varchar(20) NOT NULL,
 `createdOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 `creater` varchar(128) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4


CREATE TABLE `users` (
 `userid` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(150) NOT NULL,
 `email` varchar(100) NOT NULL,
 `password` varchar(100) NOT NULL,
 PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1