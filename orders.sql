create table if not exists `orders`(
	`orderID` int(11) unsigned not null auto_increment,
	`userID` int(11) unsigned not null,
	`bookID` int(11) unsigned not null,
	`quanitity` tinyint(4) default null,
	`amount` double(8,2) default null,
	`phone` varchar(16) default null,
	`address` varchar(255) default null,
	`orderdate` timestamp() default null,
	primary key(`orderID`),
    foreign key(`userID`) references user(`userID`),
	foreign key(`bookID`) references mybook(`bookID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;