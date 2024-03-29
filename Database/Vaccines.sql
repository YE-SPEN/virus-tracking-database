create table Vaccines (
	employee_ID INT(4),
    type VARCHAR(20),
	vax_date DATE,
	facility_id INT(4),
    dose_number INT,
    FOREIGN KEY (employee_ID) REFERENCES Employees(employee_ID) ON DELETE CASCADE,
    PRIMARY KEY (employee_ID, dose_number)
);
insert into Vaccines (employee_ID, type, vax_date, facility_id, dose_number) 
values
('100','Pfizer','2022-02-11','502',1),
('102','Moderna','2021-09-03','504',1),
('102','Moderna','2021-12-08','506',2),
('103','Pfizer','2022-03-14','500',1),
('103','Moderna','2022-03-24','506',2),
('103','Pfizer','2022-08-20','507',3),
('103','Moderna','2022-05-21','509',4),
('104','Moderna','2023-01-03','500',1),
('104','Pfizer','2021-10-30','503',2),
('104','AstraZeneca','2023-02-02','503',3),
('104','Pfizer','2022-07-17','506',4),
('104','Moderna','2021-08-03','507',5),
('105','Pfizer','2021-11-08','504',1),
('105','Pfizer','2022-04-22','507',2),
('106','Pfizer','2022-12-20','507',1),
('106','Moderna','2022-12-06','507',2),
('107','AstraZeneca','2022-05-12','500',1),
('107','AstraZeneca','2021-07-13','507',2),
('108','Pfizer','2021-12-02','500',1),
('108','Pfizer','2022-05-26','500',2),
('108','Pfizer','2022-02-13','505',3),
('109','Moderna','2022-11-20','506',1),
('110','Pfizer','2021-09-05','500',1),
('110','Moderna','2021-10-30','502',2),
('110','AstraZeneca','2021-07-24','505',3),
('110','Pfizer','2022-08-15','507',4),
('111','Pfizer','2022-06-17','501',1),
('111','Johnson & Johnson','2022-01-31','502',2),
('111','Moderna','2022-04-24','503',3),
('112','Pfizer','2022-02-02','502',1),
('112','Pfizer','2022-09-20','507',2),
('112','Moderna','2022-03-15','507',3),
('114','Pfizer','2022-04-20','502',1),
('116','Pfizer','2022-05-05','500',1),
('116','Johnson & Johnson','2021-12-26','506',2),
('116','Pfizer','2022-11-30','508',3),
('117','Moderna','2021-11-15','501',1),
('117','Johnson & Johnson','2022-01-19','500',2),
('117','Moderna','2022-03-08','500',3),
('117','Pfizer','2022-11-24','506',4),
('117','AstraZeneca','2021-11-08','507',5),
('117','AstraZeneca','2022-10-19','508',6),
('118','Pfizer','2022-12-16','500',1),
('118','Johnson & Johnson','2022-08-06','506',2),
('119','Moderna','2022-08-24','501',1),
('119','AstraZeneca','2022-04-15','500',2),
('119','Moderna','2021-09-27','505',3),
('119','AstraZeneca','2021-08-18','507',4),
('120','Pfizer','2021-07-30','500',1),
('120','Moderna','2022-08-11','504',2),
('120','Moderna','2022-07-20','505',3),
('120','Johnson & Johnson','2021-07-26','501',4),
('120','Johnson & Johnson','2022-09-30','508',5),
('121','Moderna','2021-09-11','502',1),
('121','Moderna','2021-12-06','504',2),
('121','Johnson & Johnson','2022-05-22','508',3),
('123','Pfizer','2022-02-27','501',1),
('123','Pfizer','2021-12-08','500',2),
('123','AstraZeneca','2022-03-05','506',3),
('124','Moderna','2022-07-14','501',1),
('124','Moderna','2022-05-13','509',2),
('126','Pfizer','2022-08-06','507',1),
('128','AstraZeneca','2021-10-13','502',1),
('128','Pfizer','2021-07-09','507',2),
('129','AstraZeneca','2021-09-10','503',1),
('130','AstraZeneca','2022-09-01','503',1),
('130','Pfizer','2022-01-16','500',2),
('130','Moderna','2021-11-12','509',3),
('131','Moderna','2023-01-15','503',1),
('131','Johnson & Johnson','2022-12-17','504',2),
('131','Pfizer','2022-08-08','509',3),
('132','Moderna','2022-11-06','502',1),
('132','Pfizer','2022-04-13','507',2),
('132','Pfizer','2021-12-17','506',3),
('135','Moderna','2021-09-06','500',1),
('135','Pfizer','2022-06-20','501',2),
('135','Pfizer','2022-03-16','507',3),
('135','AstraZeneca','2021-09-01','506',4),
('136','Moderna','2022-03-17','500',1),
('136','Moderna','2022-04-22','500',2),
('136','Moderna','2022-05-15','504',3),
('138','AstraZeneca','2022-10-02','502',1),
('138','Moderna','2022-05-12','503',2),
('138','Pfizer','2022-09-07','505',3),
('138','Moderna','2021-07-27','502',4),
('138','Johnson & Johnson','2022-11-11','501',5),
('139','Moderna','2022-08-17','504',1),
('139','Pfizer','2022-09-30','502',2),
('139','AstraZeneca','2022-03-01','507',3),
('139','Moderna','2022-06-11','507',4),
('140','Pfizer','2022-08-09','501',1),
('140','AstraZeneca','2022-12-28','501',2),
('141','AstraZeneca','2021-11-02','500',1),
('141','Pfizer','2021-12-05','504',2),
('141','Pfizer','2022-02-12','506',3),
('142','Moderna','2022-02-12','509',1),
('142','Moderna','2022-09-02','509',2),
('143','Moderna','2022-02-10','501',1),
('143','Moderna','2023-01-31','506',2),
('143','Pfizer','2021-11-01','508',3),
('144','Pfizer','2022-02-07','504',1),
('144','AstraZeneca','2022-01-12','507',2),
('145','Pfizer','2022-10-05','501',1),
('145','Johnson & Johnson','2022-06-04','502',2),
('146','AstraZeneca','2022-01-18','503',1),
('146','Pfizer','2022-07-04','505',2),
('146','Johnson & Johnson','2022-06-02','502',3),
('147','Moderna','2022-01-07','504',1),
('147','AstraZeneca','2022-11-30','502',2),
('148','AstraZeneca','2022-01-04','503',1),
('148','AstraZeneca','2022-09-18','505',2),
('149','Pfizer','2022-07-14','508',1),
('150','Moderna','2022-10-25','503',1),
('152','AstraZeneca','2022-07-24','507',1),
('152','Pfizer','2022-03-02','506',2),
('153','Moderna','2022-05-16','502',1),
('153','Pfizer','2021-09-14','504',2),
('154','Moderna','2021-11-23','500',1),
('154','Moderna','2022-03-28','500',2),
('154','Pfizer','2022-09-23','508',3),
('154','Moderna','2021-09-01','509',4),
('156','AstraZeneca','2023-02-01','500',1),
('156','Moderna','2022-06-24','506',2),
('156','Moderna','2022-10-13','509',3),
('157','AstraZeneca','2022-09-25','507',1),
('159','Moderna','2021-08-25','500',1),
('159','Moderna','2022-12-21','506',2),
('160','Pfizer','2022-10-12','500',1),
('160','AstraZeneca','2022-10-25','501',2),
('160','Moderna','2022-12-01','507',3),
('160','Pfizer','2021-11-12','506',4),
('161','AstraZeneca','2022-03-13','508',1),
('162','Moderna','2021-08-04','501',1),
('162','Pfizer','2023-01-26','508',2),
('162','Pfizer','2021-09-15','509',3),
('163','Johnson & Johnson','2021-09-01','502',1),
('163','AstraZeneca','2022-04-03','503',2),
('165','AstraZeneca','2021-08-02','504',1),
('165','Moderna','2022-07-20','509',2),
('166','Pfizer','2021-07-07','504',1),
('166','Johnson & Johnson','2022-03-29','507',2),
('167','Moderna','2021-08-26','502',1),
('167','Johnson & Johnson','2021-09-20','502',2),
('167','Moderna','2022-05-25','502',3),
('168','Pfizer','2021-08-03','504',1),
('168','Moderna','2022-03-15','508',2),
('169','Pfizer','2021-11-30','503',1),
('169','Johnson & Johnson','2022-12-25','500',2),
('169','AstraZeneca','2021-09-21','507',3),
('169','Johnson & Johnson','2022-01-16','507',4),
('171','Moderna','2022-05-26','503',1),
('171','Moderna','2022-12-16','501',2),
('171','AstraZeneca','2021-10-04','506',3),
('172','Pfizer','2022-01-13','501',1),
('172','Pfizer','2021-08-28','506',2),
('173','Moderna','2021-10-12','504',1),
('173','AstraZeneca','2022-05-21','505',2),
('173','Pfizer','2021-07-20','509',3),
('174','Moderna','2022-06-21','506',1),
('175','Pfizer','2022-09-22','502',1),
('175','Moderna','2021-07-12','507',2),
('176','Moderna','2021-11-21','501',1),
('176','Pfizer','2022-07-15','503',2),
('176','Pfizer','2021-07-24','509',3),
('177','Moderna','2021-12-27','500',1),
('177','Moderna','2021-11-13','502',2),
('178','Pfizer','2022-03-19','506',1),
('178','Moderna','2021-07-04','508',2),
('179','AstraZeneca','2021-12-04','501',1),
('179','Moderna','2022-03-05','503',2),
('180','Moderna','2021-09-01','509',1),
('181','Pfizer','2022-06-11','505',1),
('181','Johnson & Johnson','2021-10-16','508',2),
('181','Pfizer','2022-04-01','509',3),
('182','Moderna','2022-12-10','500',1),
('182','Pfizer','2021-11-05','508',2),
('182','Pfizer','2021-11-15','508',3),
('183','Pfizer','2022-08-03','506',1),
('184','Pfizer','2022-04-05','501',1),
('185','AstraZeneca','2021-12-12','502',1),
('185','Moderna','2021-08-03','507',2),
('186','Moderna','2021-12-07','504',1),
('186','Moderna','2023-01-04','506',2),
('186','Moderna','2022-01-02','506',3),
('186','Pfizer','2021-10-01','508',4),
('188','Moderna','2022-01-21','504',1),
('188','Pfizer','2022-07-17','501',2),
('188','Pfizer','2022-10-25','506',3),
('188','Moderna','2021-10-21','509',4),
('189','Moderna','2022-04-06','501',1),
('189','Pfizer','2022-09-03','502',2),
('189','AstraZeneca','2022-11-11','503',3),
('190','Moderna','2022-01-20','503',1),
('190','Moderna','2021-10-23','506',2),
('191','AstraZeneca','2021-09-01','501',1),
('191','AstraZeneca','2022-01-05','500',2),
('191','Pfizer','2022-06-16','505',3),
('192','Moderna','2022-01-22','502',1),
('192','Moderna','2022-10-16','502',2),
('192','Moderna','2022-11-12','502',3),
('193','Moderna','2021-09-19','500',1),
('193','Pfizer','2022-09-01','500',2),
('193','Moderna','2022-04-24','506',3),
('194','AstraZeneca','2021-09-08','501',1),
('194','Moderna','2021-12-25','503',2),
('195','Moderna','2021-12-09','505',1),
('195','Moderna','2021-08-17','502',2),
('195','AstraZeneca','2022-07-14','506',3),
('197','Moderna','2022-09-25','501',1),
('198','Moderna','2022-05-21','501',1),
('198','Pfizer','2022-01-16','503',2),
('199','AstraZeneca','2022-11-10','509',1),
('200','Johnson & Johnson','2021-12-04','500',1),
('200','Pfizer','2021-09-01','509',2),
('201','Pfizer','2022-01-02','500',1),
('201','Moderna','2022-08-31','504',2),
('202','Johnson & Johnson','2022-08-06','504',1),
('202','Pfizer','2021-07-06','507',2),
('202','Moderna','2022-04-15','507',3),
('203','Pfizer','2022-06-06','500',1),
('203','Pfizer','2022-03-02','505',2),
('203','Moderna','2021-09-16','507',3),
('203','AstraZeneca','2022-06-10','507',4),
('204','Pfizer','2022-08-21','502',1),
('205','AstraZeneca','2022-08-06','507',1),
('206','Pfizer','2022-01-07','504',1),
('206','Pfizer','2023-01-21','504',2),
('206','AstraZeneca','2021-07-17','507',3),
('206','Moderna','2021-08-13','508',4),
('207','Pfizer','2021-09-17','500',1),
('208','Pfizer','2022-11-05','501',1),
('208','Johnson & Johnson','2022-03-18','506',2),
('208','AstraZeneca','2021-07-05','507',3),
('209','AstraZeneca','2021-11-16','500',1),
('209','AstraZeneca','2022-06-13','500',2),
('209','Moderna','2022-11-13','500',3),
('209','Moderna','2021-10-06','500',4),
('209','Pfizer','2022-07-15','500',5),
('209','Moderna','2021-09-18','506',6),
('209','AstraZeneca','2021-07-31','509',7),
('210','Pfizer','2022-04-02','500',1),
('210','Pfizer','2022-03-22','507',2),
('210','AstraZeneca','2022-09-16','507',3),
('210','Pfizer','2022-07-06','507',4),
('212','Pfizer','2022-03-14','500',1),
('212','Pfizer','2021-10-23','500',2),
('212','AstraZeneca','2022-08-07','507',3),
('213','Pfizer','2022-12-16','509',1),
('214','Johnson & Johnson','2021-10-02','501',1),
('214','Pfizer','2021-09-14','505',2),
('214','Johnson & Johnson','2022-06-01','502',3),
('214','Pfizer','2021-08-15','507',4),
('215','Johnson & Johnson','2022-08-23','504',1),
('215','Moderna','2022-09-24','507',2),
('215','Moderna','2021-08-09','509',3)

