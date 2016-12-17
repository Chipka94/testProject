CREATE TABLE
	publisher (
		id INT(11) NOT NULL AUTO_INCREMENT,
		name VARCHAR(30) NOT NULL,
		link VARCHAR(30) NOT NULL,
		PRIMARY KEY(id)
	);

CREATE TABLE
	author (
		id INT(11) NOT NULL AUTO_INCREMENT,
		name VARCHAR(30) NOT NULL,
		PRIMARY KEY(id)
	);

CREATE TABLE
	book (
		id INT(11) NOT NULL AUTO_INCREMENT,
		name VARCHAR(30) NOT NULL,
		isbn VARCHAR(30) NOT NULL,
		pages INT(11) NOT NULL,
		publisher_id INT(11) NOT NULL,
		author_id INT(11) NOT NULL,
		PRIMARY KEY(id),
		FOREIGN KEY(publisher_id) REFERENCES publisher(id),
		FOREIGN KEY(author_id) REFERENCES author(id) 
	);