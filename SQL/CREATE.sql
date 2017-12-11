CREATE DATABASE IF NOT EXISTS police_db;
USE police_db;
create table PERSONNEL (
	pid INT AUTO_INCREMENT,
	ssn BIGINT NOT NULL UNIQUE,
	last_name VARCHAR(50) NOT NULL,
	first_name VARCHAR(50) NOT NULL,
	middle_name VARCHAR(50),
	phone_number BIGINT NOT NULL,
	street_address VARCHAR(50) NOT NULL,
	zip_code INT NOT NULL,
	dob DATE NOT NULL,
	start_date DATE NOT NULL,
	end_date DATE,
	station_id INT,
	salary DECIMAL(9,2),
	rank VARCHAR(16),
	vacation BOOLEAN NOT NULL DEFAULT false,
	employee_type VARCHAR(16) NOT NULL,
	us_citizen BOOLEAN NOT NULL,
	password VARCHAR(50),
	admin BOOLEAN NOT NULL DEFAULT false,
	PRIMARY KEY(pid)
);
create table STATION (
	id INT AUTO_INCREMENT,
	zip_code INT NOT NULL,
	street_address VARCHAR(50) NOT NULL,
	phone_number BIGINT,
	captain_pid INT,
	spokesperson_pid INT,
	officer_manager_pid INT,
	PRIMARY KEY(id)
);
create table ZIP (
	city VARCHAR(50) NOT NULL,
	state VARCHAR(50) NOT NULL,
	#Currently set to NOT NULL AUTO_INC due to mock data limitations
	zip_code INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(zip_code)
);
create table DETAINEE (
	id INT,
	first_name VARCHAR(50),
	last_name VARCHAR(50),
	dob DATE,
	street_address VARCHAR(50),
	zip_code INT,
	phone_number BIGINT,
	detaining_pid INT,
	bail DECIMAL(9,2),
	station_id INT NOT NULL,
	PRIMARY KEY(id)
);
create table CITATIONS (
	id INT,
	fine DECIMAL(9,2) NOT NULL,
	pid INT,
	notes TEXT,
	PRIMARY KEY(id)
);
ALTER TABLE PERSONNEL ADD FOREIGN KEY (zip_code) REFERENCES ZIP(zip_code);
ALTER TABLE PERSONNEL ADD FOREIGN KEY (station_id) REFERENCES STATION(id);
ALTER TABLE STATION ADD FOREIGN KEY (captain_pid) REFERENCES PERSONNEL(pid);
ALTER TABLE STATION ADD FOREIGN KEY (spokesperson_pid) REFERENCES PERSONNEL(pid);
ALTER TABLE STATION ADD FOREIGN KEY (officer_manager_pid) REFERENCES PERSONNEL(pid);
ALTER TABLE DETAINEE ADD FOREIGN KEY (detaining_pid) REFERENCES PERSONNEL(pid);
ALTER TABLE DETAINEE ADD FOREIGN KEY (station_id) REFERENCES STATION(id);
ALTER TABLE CITATIONS ADD FOREIGN KEY (pid) REFERENCES PERSONNEL (pid);
ALTER TABLE ZIP AUTO_INCREMENT = 10000;







