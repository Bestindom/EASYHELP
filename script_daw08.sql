drop database if exists daw08;

create database daw08;

use daw08;

create table `types` (
id int auto_increment not null,
`name` varchar(60) not null,
primary key (id)
);

create table users (
id int auto_increment not null,
username varchar(50) UNIQUE not null,
`password` varchar(250),
type_id int not null,
primary key (id),
FOREIGN KEY (type_id) REFERENCES `types` (id)
);

create table admins (
user_id INT PRIMARY KEY,
FOREIGN KEY (user_id) REFERENCES users (id)
);

create table riders (
user_id INT PRIMARY KEY,
FOREIGN KEY (user_id) REFERENCES users (id)
);

create table providers (
user_id INT PRIMARY KEY,
menus INT NOT NULL,
`name` VARCHAR(255),
street VARCHAR(255),
img VARCHAR(255),
FOREIGN KEY (user_id) REFERENCES users (id)
);

create table homeless (
id int auto_increment not null,
amount int not null,
eated boolean not null,
primary key (id)
);

create table points (
id INT PRIMARY KEY auto_increment,
latitud VARCHAR(100) NOT NULL,
longitud VARCHAR(100) NOT NULL
);

create table orders (
id INT AUTO_INCREMENT PRIMARY KEY,
menus int not null,
picked int not null,
timePicked timestamp,
rider_id int not null,
provider_id int,
comedor_id int,
FOREIGN KEY (rider_id) REFERENCES `riders` (`user_id`),
FOREIGN KEY (provider_id) REFERENCES `providers` (`user_id`)
);

create table deliveries (
id INT AUTO_INCREMENT PRIMARY KEY,
menus int not null,
delivered int not null,
timeDelivered timestamp,
rider_id int not null,
homeless_id int not null,
FOREIGN KEY (rider_id) REFERENCES riders (`user_id`),
FOREIGN KEY (homeless_id) REFERENCES homeless (`id`)
);

INSERT INTO `types` VALUES (1, 'admin'), (2, 'rider'), (3, 'provider'), (4, 'comedor');