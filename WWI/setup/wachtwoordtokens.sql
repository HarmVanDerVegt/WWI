CREATE TABLE WachtwoordTokens (
	PersonID INT(11),
	Token VARCHAR(30),
    ValidFrom DATE,
    ValidTo DATE,
    PRIMARY KEY (PersonID),
    FOREIGN KEY (PersonID) REFERENCES People(PersonID)
)