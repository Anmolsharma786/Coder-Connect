USE gcc200419191; 
CREATE TABLE project(
    userid int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    email varchar(255),
    location varchar(255),
    skills varchar(255), 
    PRIMARY KEY (userid)
);