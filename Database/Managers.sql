CREATE TABLE Managers (
	manager_ID INT(4) PRIMARY KEY,
	facility_ID INT(4),
	FOREIGN KEY (manager_ID) REFERENCES Employees(employee_ID) ON DELETE CASCADE,
    FOREIGN KEY (facility_ID) REFERENCES Facilities(facility_ID)ON DELETE SET NULL
);

INSERT INTO Managers (manager_ID, facility_ID) 
VALUES 
('114','500'),
('167','501'),
('126','502'),
('118','503'),
('206','504'),
('181','505'),
('134','506'),
('178','507'),
('175','508'),
('110','509')
