CREATE DATABASE University;

use University;

CREATE TABLE CAREERS(
    id int not null,
    description varchar (100) not null,
    active boolean not null,
    CONSTRAINT PK_CAREERS PRIMARY KEY (id)
);

CREATE TABLE ADMINISTRATORS(
    id int not null AUTO_INCREMENT,
    firstname varchar(100) not null,
    lastname varchar(100) not null,
    email varchar(50) not null UNIQUE,
    password varchar(256) not null,
    CONSTRAINT PK_ADMINISTRATORS primary key (id)
);


CREATE TABLE STUDENTS(
    firstname varchar(100) not null,
    lastname varchar(100) not null,
    email varchar(50) not null,
    recordId int not null,
    careerId int not null,
    dni varchar(50) not null,
    fileNumber varchar(50) not null,
    gender varchar(50) not null,
    birthDate date not null,
    phoneNumber varchar(50) not null,
    active boolean not null,
    password varchar(50) not null,
    
    CONSTRAINT PK_STUDENTS PRIMARY KEY (recordId),
    CONSTRAINT FK_STUDENTS_CAREER FOREIGN KEY (careerId) REFERENCES CAREERS (id)
);


INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,id,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("julian","locura","gs@gmail.com",0,1,1,"44567921",12,"masculino",20010530,"2235444433",true,"123");
INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,id,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("julianxxxxx","studentxxxx","gianatiempoattorney@gmail.com",0,1005,1,"43456672",12,"masculino",20010530,"223",true,"123");

INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,id,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("goku","nose","gianatiempoattorney@icloud.com",0,1006,1,"43456672",12,"masculino",20010530,"223",true,"123");
INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,id,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("fede","estudiante","federicosoler256@gmail.com",0,1877,1,"43456672",12,"masculino",20010530,"223",true,"123");
INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,id,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("fedelol","estudiante","federicosoler25666@gmail.com",0,1008,1,"43456672",12,"masculino",20010530,"223",true,"123");
INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,id,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("fedeloffl","estudiante","federicosoler256636@gmail.com",0,1009,1,"43456672",12,"masculino",20010530,"223",true,"123");
INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,id,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("juliannuevo","estudiante","julian.a.gianatiempo@gmail.com",0,1010,1,"43456672",12,"masculino",20010530,"223",true,"123");


INSERT INTO CAREERS (id,description, active) VALUES (1,'Naval engineering', true);
INSERT INTO CAREERS (id,description, active) VALUES (2,'Fishing engineering', false);
INSERT INTO CAREERS (id,description, active) VALUES (3,'University technician in programming', true);
INSERT INTO CAREERS (id,description, active) VALUES (4,'University technician in computer systems', true);
INSERT INTO CAREERS (id,description, active) VALUES (5,'University technician in textile production', true);
INSERT INTO CAREERS (id,description, active) VALUES (6,'University technician in administration', true);
INSERT INTO CAREERS (id,description, active) VALUES (7,'Bachelor in environmental management', false);
INSERT INTO CAREERS (id,description, active) VALUES (8,'University technician in environmental procedures and technologies', true);

CREATE TABLE COMPANIES(
    id int not null AUTO_INCREMENT,
    name varchar (100) not null,
    type varchar (100) not null,
    active boolean not null,
    email varchar(50) not null,
    password varchar(256) not null,
    CONSTRAINT PK_COMPANIES PRIMARY KEY (id)
);




CREATE TABLE JOB_POSITION(
        id int not null,
        careerId int not null,
        description varchar (100) not null,
        CONSTRAINT PK_JOBPOSITION primary key (id),
        CONSTRAINT FK_JOBPOSITION_CAREER foreign key (careerId) references CAREERS (id)
);

INSERT INTO JOB_POSITION (id,careerId, description) VALUES (1,'1', 'Jr naval engineer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (2,'1', 'Ssr naval engineer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (3,'1', 'Sr naval engineer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (4,'2', 'Jr fisheries engineer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (5,'2', 'Ssr fisheries engineer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (6,'2', 'Sr fisheries engineer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (7,'3', 'Java Jr developer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (8,'3', 'PHP Jr developer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (9,'3', 'Ssr developer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (10,'4', 'Full Stack developer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (11,'4', 'Sr developer');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (12,'4', 'Project manager');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (13,'4', 'Scrum Master');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (14,'5', 'Jr textile operator');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (15,'5', 'Textile production assistant manager');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (16,'5', 'Textile design assistant');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (17,'5', 'Textile production supervisor');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (18,'6', 'Head of administration');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (19,'6', 'Management analyst');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (20,'6', 'Administration intern');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (21,'7', 'Environmental management specialist');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (22,'7', 'Environmental management coordinator');
INSERT INTO JOB_POSITION (id,careerId, description) VALUES (23,'8', 'Received technician');



CREATE TABLE  JOB_OFFERS(
        id int not null AUTO_INCREMENT,
        jobPositionId int not null,
        companyId int not null,
        date date not null,
        description varchar(100) not null,
        active boolean not null,
        image varchar(255),
        
        CONSTRAINT PK_JOBOFFER primary key (id),
        CONSTRAINT FK_JOBOFFER_JOBPOSITION foreign key (jobPositionId) references JOB_POSITION (id),
        CONSTRAINT FK_JOBOFFER_COMPANY foreign key (companyId) references COMPANIES (id),
);


CREATE TABLE STUDENT_X_JOB_OFFER(
     studentId int not null,
     jobOfferId int not null,
     CONSTRAINT PK_STUDENTXJOBOFFER primary key (studentId,jobOfferId),
     CONSTRAINT FK_STUDENTXJOBOFFER_STUDENT foreign key (studentId) references STUDENTS (recordId),
     CONSTRAINT FK_STUDENTXJOBOFFER_JOBOFFER foreign key (jobOfferId) references JOB_OFFER (id)
);

INSERT INTO JOB_OFFER (o_id,o_idJobPosition,o_idCompany,o_fecha,o_description,o_active) VALUES (12,2,2,"2021-05-10","Diseñador de niveles",true); 
 
INSERT INTO JOB_OFFER (o_id,o_idJobPosition,o_idCompany,o_fecha,o_description,o_active) VALUES (123,22,1,"2021-05-15","Verdulero",true); 
INSERT INTO JOB_OFFER (o_id,o_idJobPosition,o_idCompany,o_fecha,o_description,o_active) VALUES (13,22,1,"2021-05-15","Doctor",true); 
INSERT INTO JOB_OFFER (o_id,o_idJobPosition,o_idCompany,o_fecha,o_description,o_active) VALUES (133,22,3,"2021-05-15","Locutor",true); 


INSERT INTO JOB_OFFER (o_id,o_idJobPosition,o_idCompany,o_fecha,o_description,o_active) VALUES (7,15,4,"2021-05-25","Modelado de texturas",true); 
INSERT INTO JOB_OFFER (o_id,o_idJobPosition,o_idCompany,o_fecha,o_description,o_active) VALUES (777,15,4,"2021-05-25","Modelado de escenarios",true); 

insert into STUDENT_X_JOB_OFFER (o_id,recordId) VALUES (14,33);
INSERT INTO JOB_OFFER (o_id,o_idJobPosition,o_idCompany,o_fecha,o_description,o_active) VALUES (22,15,1,"2021-11-20","Email propa",true);
insert into STUDENT_X_JOB_OFFER (o_id,recordId) VALUES (22,33);


insert into STUDENT_X_JOB_OFFER (o_id,recordId) VALUES (127,999);

insert into STUDENT_X_JOB_OFFER (o_id,recordId) VALUES (1004,1005);
insert into STUDENT_X_JOB_OFFER (o_id,recordId) VALUES (1111,1008);
insert into STUDENT_X_JOB_OFFER (o_id,recordId) VALUES (2222,1009);
insert into STUDENT_X_JOB_OFFER (o_id,recordId) VALUES (9876,1006);

