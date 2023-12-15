CREATE DATABASE University;

use University;

/*CREATE TABLE students 
{
    recordId int not null primary key,
    firstName nvarchar(100) not null;
    lastName nvarchar(100) not null;

}Engine=InnoDB;*/

CREATE TABLE CAREERS(
    careerId int not null,
    carrer_description varchar (100) not null,
    active boolean not null,
    CONSTRAINT PK_CAREERS PRIMARY KEY (careerId)
);

CREATE TABLE USERS(
    u_firstName varchar(100) not null,
    u_lastName varchar(100) not null,
    u_email varchar(50) not null,
    u_password varchar(256) not null,
    u_type int not null,
    CONSTRAINT pk_users_email primary key (u_email)
);

  INSERT INTO USERS(u_firstName,u_lastName,u_email,u_password,u_type) VALUES ("ju","lian","g@gmail.com","123",1);

CREATE TABLE STUDENTS(
    firstName varchar(100) not null,
    lastName varchar(100) not null,
    email varchar(50) not null,
    type_us int not null,
    recordId int not null,
    careerId int not null,
    dni varchar(50) not null,
    fileNumber varchar(50) not null,
    gender varchar(50) not null,
    birthDate date not null,
    phoneNumber varchar(50) not null,
    active boolean not null,
    s_password varchar(50) not null,
    
    CONSTRAINT PK_STUDENTS PRIMARY KEY (recordId),
    CONSTRAINT FK_CAREER FOREIGN KEY (careerId) REFERENCES CAREERS (careerId)
   
    
   
);
 /*CONSTRAINT FK_USER FOREIGN KEY (u_email) REFERENCES USERS (u_email)*/

INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,careerId,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("julian","locura","gs@gmail.com",0,1,1,"44567921",12,"masculino",20010530,"2235444433",true,"123");
INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,careerId,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("julianxxxxx","studentxxxx","gianatiempoattorney@gmail.com",0,1005,1,"43456672",12,"masculino",20010530,"223",true,"123");

INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,careerId,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("goku","nose","gianatiempoattorney@icloud.com",0,1006,1,"43456672",12,"masculino",20010530,"223",true,"123");
INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,careerId,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("fede","estudiante","federicosoler256@gmail.com",0,1877,1,"43456672",12,"masculino",20010530,"223",true,"123");
INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,careerId,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("fedelol","estudiante","federicosoler25666@gmail.com",0,1008,1,"43456672",12,"masculino",20010530,"223",true,"123");
INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,careerId,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("fedeloffl","estudiante","federicosoler256636@gmail.com",0,1009,1,"43456672",12,"masculino",20010530,"223",true,"123");
INSERT INTO STUDENTS(firstName,lastName,email,type_us,recordId,careerId,dni,fileNumber,gender,birthDate,phoneNumber,active,s_password) VALUES ("juliannuevo","estudiante","julian.a.gianatiempo@gmail.com",0,1010,1,"43456672",12,"masculino",20010530,"223",true,"123");


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
    comp_active boolean not null,
    comp_email varchar(50) not null,
    comp_pass varchar(256) not null,
    comp_type_int int not null,
    CONSTRAINT PK_COMPANIES PRIMARY KEY (comp_id)
);




CREATE TABLE JOB_POSITION(
        p_id int not null,
        p_careerId int not null,
        p_description varchar (100) not null,
        CONSTRAINT PK_POSITION_ID primary key (p_id),
        CONSTRAINT fk_position_careerId foreign key (p_careerId) references CAREERS (careerId)
);

INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (1,'1', 'Jr naval engineer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (2,'1', 'Ssr naval engineer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (3,'1', 'Sr naval engineer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (4,'2', 'Jr fisheries engineer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (5,'2', 'Ssr fisheries engineer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (6,'2', 'Sr fisheries engineer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (7,'3', 'Java Jr developer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (8,'3', 'PHP Jr developer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (9,'3', 'Ssr developer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (10,'4', 'Full Stack developer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (11,'4', 'Sr developer');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (12,'4', 'Project manager');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (13,'4', 'Scrum Master');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (14,'5', 'Jr textile operator');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (15,'5', 'Textile production assistant manager');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (16,'5', 'Textile design assistant');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (17,'5', 'Textile production supervisor');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (18,'6', 'Head of administration');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (19,'6', 'Management analyst');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (20,'6', 'Administration intern');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (21,'7', 'Environmental management specialist');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (22,'7', 'Environmental management coordinator');
INSERT INTO JOB_POSITION (p_id,p_careerId, p_description) VALUES (23,'8', 'Received technician');



CREATE TABLE  JOB_OFFER(
        o_id int not null AUTO_INCREMENT,
        o_idJobPosition int not null,
        o_idCompany int not null,
        o_fecha date not null,
        o_description varchar(100) not null,
        o_active boolean not null,
        o_image varchar(255),
        
        CONSTRAINT pk_offer_id primary key (o_id),
        CONSTRAINT fk_offer_position foreign key (o_idJobPosition) references JOB_POSITION (p_id),
        CONSTRAINT fk_offer_company foreign key (o_idCompany) references COMPANIES (comp_id)
);


CREATE TABLE STUDENT_X_JOB_OFFER(
     o_id int not null,
     recordId int not null,
     CONSTRAINT pk_jb_x_student primary key (o_id,recordId),
     CONSTRAINT fk_jb_id foreign key (o_id) references JOB_OFFER (o_id),
     CONSTRAINT fk_stu_id foreign key (recordId) references STUDENTS (recordId)
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

