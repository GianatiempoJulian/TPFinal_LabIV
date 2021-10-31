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


