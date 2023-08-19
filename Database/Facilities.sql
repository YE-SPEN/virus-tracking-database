CREATE TABLE Facilities (
	facility_ID INT(4) PRIMARY KEY,
	facility_name VARCHAR(50),
	type VARCHAR(20),
	active_employees INT,
	postal_code VARCHAR(8),
	capacity INT,
	web_URL VARCHAR(1000),
    FOREIGN KEY (postal_code) REFERENCES Locations(postal_code)
);

ALTER TABLE Facilities
  MODIFY facility_ID INT NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

INSERT INTO Facilities (facility_ID, facility_name, type, active_employees, postal_code, capacity, web_URL)
VALUES 
('500', 'Lehner-Schmidt Pharmacy', 'Pharmacy', 8,  'H5T 4R2', 10,  'https://lehnerschmidt.ca'),
('501', 'Kunde-Effertz Clinic', 'Clinic', 8,  'H1W 5W4', 15,  'https://KundeEffertz.com'),
('502', 'Cote-des-Neiges CLSC', 'CLSC', 7,  'H8D 1K2', 10,  'https://cotedesneigesclsc.gov'),
('503', 'Harriett Group', 'Special Installment', 7,  'H2E 3W1', 10,  'https://harriettgroup.ca'),
('504', 'Stamm Hospital', 'Hospital', 16,  'H5R 3R2', 25,  'http://stammhospital.ca'),
('505', 'Vandervort-Kulas Pharmacy', 'Pharmacy', 7,  'H4B 2W4', 10,  'https://vandervortkulas.com'),
('506', 'Greenholt Hospital', 'Hospital', 15,  'H8W 2D4', 25,  'https://greenholthospital.gov'),
('507', 'Ziemann-Stoltenberg Clinic', 'Clinic', 10,  'H1P 7G1', 15,  'http://ziemmannclinic.gov'),
('508', 'Russet Group CLSC', 'CLSC', 8,  'H3R 3R9', 10,  'https://russetgroup.com'),
('509', 'Jackson Avery Foundation', 'Special Installment', 7,  'H6T 3R2', 10,  'https://avery.ca')

