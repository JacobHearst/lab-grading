-- User test data
INSERT INTO User (Id, IsProfessor, FirstName, LastName, Email, Pin) VALUES
    (1, False, "Eric", "Hovda", "hovdae0831@my.uwstout.edu",3252),
    (2, False, "Kiran", "Cotting", "cottingk3368@my.uwstout.edu",3734),
    (3, False, "Terence", "Regan", "regant4187@my.uwstout.edu",7315),
    (4, True, "Jocelyn", "Richardt", "richardtj@uwstout.edu",1317),
    (5, True, "Scott", "Turner", "turners@uwstout.edu",2315),
    (8, False, "Joseph", "Matzelle", "matzellej4550@my.uwstout.edu",6723),
    (9, False, "Caleb", "Rudolph", "rudolphc3824@my.uwstout.edu",2161),
    (10, False, "Alexander", "Trask", "traska6984@my.uwstout.edu",3217);

-- Course test data
INSERT INTO Course (Id, Name, UserId) VALUES
    (1, "Algorithms", 4),
    (2, "Data structure", 5),
    (3, "Networking fundamentals", 4),
    (4, "Web development", 5),
    (5, "Computer Science", 4),
    (6, "Software engineering principles", 5);

-- Section test data
INSERT INTO Section (Id, CourseId, DisplayName) VALUES
    (1, 1, "Section1"),
    (2, 2, "Section2"),
    (3, 3, "Section3"),
    (4, 4, "Section4"),
    (5, 5, "Section5"),
    (6, 6, "Section6");
    
-- UserSection test data
INSERT INTO UserSection (UserId, SectionId) VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (5, 4),
    (8, 5),
    (9, 6),
    (10, 1);

-- Lab test data
INSERT INTO Lab (Id, Name, Description, DueDate, Score, SectionId) VALUES
    (1, "Hello World","Student''s first lab.", STR_TO_DATE("2020-09-20", "%Y-%m-%d"),10, 1),
    (2, "Variables","\"Variable declaration, initialization, and calls.\"", STR_TO_DATE("2020-10-07", "%Y-%m-%d"),15, 2),
    (3, "Conditionals","\"If, else if, and else.\"", STR_TO_DATE("2020-10-28", "%Y-%m-%d"),15, 3),
    (4, "Hello World","Student''s first lab.", STR_TO_DATE("2020-09-20", "%Y-%m-%d"),10, 4),
    (5, "Loops","For and while loops.", STR_TO_DATE("2020-11-14", "%Y-%m-%d"),30, 5),
    (6, "Variables","\"Variable declaration, initialization, and calls.\"", STR_TO_DATE("2020-10-07", "%Y-%m-%d"),15, 6),
    (7, "Conditionals","\"If, else if, and else.\"", STR_TO_DATE("2020-10-28", "%Y-%m-%d"),15, 5),
    (8, "Loops","For and while loops.", STR_TO_DATE("2020-11-14", "%Y-%m-%d"),30, 4);

-- Grade test data
INSERT INTO Grade (UserId, LabId, Score) VALUES
	(1, 1, 10),
	(2, 2, 8),
	(3, 3, 3),
	(5, 4, 19),
	(8, 5, 5),
	(9, 6, 19),
	(10, 1, 15),
	(8, 7, 100),
	(5, 8, 90);

-- Skill test data
INSERT INTO Skill (Id, SectionId, Topic) VALUES
    (1, 1, "For loops"),
    (2, 2, "Inheritance"),
    (3, 3, "Polymorphism"),
    (4, 4, "Something e''lse"),
    (5, 5, "\"Another\" thing"),
    (6, 6, "For loops");

-- Notes test data
INSERT INTO Notes (Id, LabId, CreatedBy, Note) VALUES
    (1, 2, 1, "A sample lab note."),
    (2, 3, 2, "Another sample lab note."),
    (3, 3, 2, "Another sample lab note."),
    (4, 3, 2, "Here''s another sample lab note."),
    (5, 4, 1, "Yet another sample lab note."),
    (6, 4, 2, "Just keep rolling out the lab notes."),
    (7, 4, 4, "Even more lab notes."),
    (8, 5, 1, "\"Ah yes, another lab note.\""),
    (9, 5, 3, "This is the final lab note.");
	
-- Rubric test data
INSERT INTO Rubric (Id, LabId, Note, PointValue) VALUES
    (1, 1, "Code is completed and functioning", 90),
    (2, 1, "Comments", 10),
    (3, 2, "Database established and functioning", 50),
    (4, 2, "Front-end user interface working properly", 50),
    (5, 3, "Complete/Incomplete", 100),
    (6, 4, "Commenting", 30),
    (7, 4, "Linting/Style", 20),
    (8, 4, "Program functionality", 50),
    (9, 5, "Complete/Incomplete", 100),
    (10, 6, "Complete/Incomplete", 100),
    (11, 7, "Complete/Incomplete", 100),
    (12, 8, "Complete/Incomplete", 100);

-- Log test data
INSERT INTO Log (UserID, LogDate, Description) VALUES
    (1, STR_TO_DATE("2020-04-18, 10:03:22", "%Y-%m-%d, %h:%i:%s"),"GRADE"),
    (2, STR_TO_DATE("2020-04-18, 11:05:03", "%Y-%m-%d, %h:%i:%s"),"NOTE"),
    (3, STR_TO_DATE("2020-04-18, 11:30:45", "%Y-%m-%d, %h:%i:%s"),"GRADE"),
    (4, STR_TO_DATE("2020-04-19, 14:13:21", "%Y-%m-%d, %h:%i:%s"),"NOTE"),
    (5, STR_TO_DATE("2020-04-19, 16:53:14", "%Y-%m-%d, %h:%i:%s"),"GRADE");
