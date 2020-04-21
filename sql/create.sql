CREATE TABLE User (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    IsProfessor bit DEFAULT 0,
    FirstName nvarchar(30) NOT NULL,
    LastName nvarchar(30) NOT NULL,
    Email nvarchar(50),
    Pin int
);

CREATE TABLE Course (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserId int NOT NULL,
    Name nvarchar(50),
    FOREIGN KEY (UserId) REFERENCES User(Id)
);

CREATE TABLE Section (
    Id nvarchar(30) NOT NULL PRIMARY KEY,
    CourseId int NOT NULL,
    DisplayName nvarchar(30),
    FOREIGN KEY (CourseId) REFERENCES Course(Id)
);

CREATE TABLE Lab (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name nvarchar(50),
    Description nvarchar(200),
    DueDate DateTime,
    Score TINYINT,
    SectionId nvarchar(30),
    FOREIGN KEY (SectionId) REFERENCES Section(Id)
);

CREATE TABLE Grade (
    LabId int NOT NULL,
    UserId int NOT NULL,
    Score TINYINT,
    FOREIGN KEY (UserId) REFERENCES User(Id),
    FOREIGN KEY (LabId) REFERENCES Lab(Id)
);

CREATE TABLE Skill (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    SectionId nvarchar(30),
    Topic nvarchar(50),
    FOREIGN KEY (SectionID) REFERENCES Section(Id)
);

CREATE TABLE Notes (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    LabId int,
    SkillId int,
    CreatedBy int NOT NULL,
    Note nvarchar(100),
    FOREIGN KEY (LabId) REFERENCES Lab(Id),
    FOREIGN KEY (CreatedBy) REFERENCES User(Id),
    FOREIGN KEY (SkillId) REFERENCES Skill(Id)
);

CREATE TABLE Log (
    UserID int NOT NULL,
    LogDate DateTime DEFAULT CURRENT_TIMESTAMP,
    Description nvarchar(200),
    FOREIGN KEY (UserId) REFERENCES User(Id)
);
