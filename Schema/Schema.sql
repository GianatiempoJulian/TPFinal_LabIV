CREATE DATABASE University;

use University;

/*CREATE TABLE students 
{
    recordId int not null primary key,
    firstName nvarchar(100) not null;
    lastName nvarchar(100) not null;

}Engine=InnoDB;*/

CREATE TABLE STUDENTS(
    recordId int not null,
    firstName varchar(100) not null,
    lastname varchar(100) not null,
    type_us int not null,
    email varchar(100) not null,
    careerId int not null,
    dni int not null,
    fileNumber int not null,
    gender varchar(50) not null,
    birthDate date not null,
    phoneNumber int not null,
    active boolean not null,
    CONSTRAINT PK_STUDENTS PRIMARY KEY (recordId)
);


CREATE TABLE CAREERS(
    careerId int not null,
    carrer_description varchar (100) not null,
    active boolean not null,
    CONSTRAINT PK_CAREERS PRIMARY KEY (careerId)
);

INSERT INTO CAREERS (careerId,carrer_description, active) VALUES (1,'Naval engineering', true);
INSERT INTO CAREERS (careerId,carrer_description, active) VALUES (2,'Fishing engineering', false);
INSERT INTO CAREERS (careerId,carrer_description, active) VALUES (3,'University technician in programming', true);
INSERT INTO CAREERS (careerId,carrer_description, active) VALUES (4,'University technician in computer systems', true);
INSERT INTO CAREERS (careerId,carrer_description, active) VALUES (5,'University technician in textile production', true);
INSERT INTO CAREERS (careerId,carrer_description, active) VALUES (6,'University technician in administration', true);
INSERT INTO CAREERS (careerId,carrer_description, active) VALUES (7,'Bachelor in environmental management', false);
INSERT INTO CAREERS (careerId,carrer_description, active) VALUES (8,'University technician in environmental procedures and technologies', true);

CREATE TABLE COMPANIES(
    comp_id int not null,
    comp_name varchar (100) not null,
    comp_type varchar (100) not null,
    CONSTRAINT PK_COMPANIES PRIMARY KEY (comp_id)
);