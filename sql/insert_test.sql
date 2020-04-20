-- Notes test data
INSERT INTO Notes (LabId, CreatedBy, Note) VALUES
    (2,1,"A sample lab note."),
    (3, 2, "Another sample lab note."),
    (3,2,"Another sample lab note."),
    (3,2,"Here's another sample lab note."),
    (4,1,"Yet another sample lab note."),
    (4,2,"Just keep rolling out the lab notes."),
    (4,4,"Even more lab notes."),
    (5,1,"\"Ah yes, another lab note.\""),
    (5,3,"This is the final lab note.");

-- Lab test data
INSERT INTO Lab (Name, Description, DueDate, Score, SectionId) VALUES
    ("Hello World","Student's first lab.",2020-09-20,10,"CS 145-001"),
    ("Variables","\"Variable declaration, initialization, and calls.\"",2020-10-07,15,"CS 145-001"),
    ("Conditionals","\"If, else if, and else.\"",2020-10-28,15,"CS 145-001"),
    ("Hello World","Student's first lab.",2020-09-20,10,"CS 145-002"),
    ("Loops","For and while loops.",2020-11-14,30,"CS 145-002"),
    ("Variables","\"Variable declaration, initialization, and calls.\"",2020-10-07,15,"CS 145-002"),
    ("Conditionals","\"If, else if, and else.\"",2020-10-28,15,"CS 145-002"),
    ("Loops","For and while loops.",2020-11-14,30,"CS 145-001");

-- User test data
INSERT INTO User (IsProfessor, FirstName, LastName, Email, Pin) VALUES
    (False, "Eric", "Hovda","hovdae0831@my.uwstout.edu",3252),
    (False, "Kiran", "Cotting","cottingk3368@my.uwstout.edu",3734),
    (False, "Terence", "Regan","regant4187@my.uwstout.edu",7315),
    (False, "Jocelyn", "Richardt","richardtj@uwstout.edu",1317),
    (False, "Scott", "Turner","richardtj@uwstout.edu",2315),
    (False, "Joseph", "Matzelle","matzellej4550@my.uwstout.edu",6723),
    (False, "Caleb", "Rudolph","rudolphc3824@my.uwstout.edu",2161),
    (False, "Alexander", "Trask","traska6984@my.uwstout.edu",3217);

-- Log test data
INSERT INTO Log (UserID, LogDate, Description) VALUES
    ("2020-04-18, 10:03:22","GRADE"),
    ("2020-04-18, 11:05:03","NOTE"),
    ("2020-04-18, 11:30:45","GRADE"),
    ("2020-04-19, 14:13:21","NOTE"),
    ("2020-04-19, 16:53:14","GRADE");

-- Course test data

-- Section test data

-- Skill test data
