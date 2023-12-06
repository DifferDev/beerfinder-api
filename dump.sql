CREATE TABLE `beers` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `name` varchar(255) NOT NULL,
     `brand` varchar(255) NOT NULL,
     `type` varchar(255) NOT NULL,
     `price` decimal(11,8) NOT NULL,
     PRIMARY KEY (`id`)
);

CREATE TABLE `locations` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `type` varchar(255) NOT NULL,
    `latitude` decimal(11,8) NOT NULL,
    `longitude` decimal(11,8) NOT NULL,
    PRIMARY KEY (`id`)
);