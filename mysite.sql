// Add in database name "mysite"


CREATE TABLE `assignedusers` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `projectID` int(11) NOT NULL,
 `username` varchar(128) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `taskdata` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `title` varchar(128) NOT NULL,
 `content` longtext NOT NULL,
 `status` varchar(20) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `users` (
 `userid` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(150) NOT NULL,
 `email` varchar(100) NOT NULL,
 `password` varchar(100) NOT NULL,
 PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1