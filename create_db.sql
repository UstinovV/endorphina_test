CREATE table `user_bonuses` (id int NOT NULL AUTO_INCREMENT, user_id int not null, amount int DEFAULT 0, PRIMARY KEY (id));
CREATE table `user_money` (id int NOT NULL AUTO_INCREMENT, user_id int not null, amount int DEFAULT 0, PRIMARY KEY (id));
CREATE TABLE `items` (id int NOT NULL AUTO_INCREMENT, title varchar(256) not null, PRIMARY KEY (id));

INSERT INTO `items` (title) values ('car');
INSERT INTO `items` (title) values ('book');
INSERT INTO `items` (title) values ('PC');
INSERT INTO `items` (title) values ('toy');

INSERT INTO `user_bonuses` (user_id, amount) values (100, 0);
INSERT INTO `user_bonuses` (user_id, amount) values (101, 0);
INSERT INTO `user_bonuses` (user_id, amount) values (102, 0);

INSERT INTO `user_money` (user_id, amount) values (100, 0);
INSERT INTO `user_money` (user_id, amount) values (101, 0);
INSERT INTO `user_money` (user_id, amount) values (102, 0);