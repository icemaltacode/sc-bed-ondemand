
CREATE TABLE Department
(
  id   INT         NOT NULL,
  name VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Employee
(
  id       INT              NOT NULL AUTO_INCREMENT,
  name     VARCHAR(25)      NOT NULL,
  surname  VARCHAR(30)      NOT NULL,
  jobTitle VARCHAR(15)      NOT NULL,
  basis    ENUM('FT', 'PT') NOT NULL DEFAULT 'FT',
  PRIMARY KEY (id)
);

CREATE TABLE EmployeeDepartment
(
  id           INT NOT NULL AUTO_INCREMENT,
  departmentId INT NOT NULL,
  employeeId   INT NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Salary
(
  id         INT   NOT NULL AUTO_INCREMENT,
  fromDate   DATE  NOT NULL,
  toDate     DATE  NULL    ,
  amount     FLOAT NOT NULL,
  employeeId INT   NOT NULL,
  PRIMARY KEY (id)
);

ALTER TABLE Salary
  ADD CONSTRAINT FK_Employee_TO_Salary
    FOREIGN KEY (employeeId)
    REFERENCES Employee (id);

ALTER TABLE EmployeeDepartment
  ADD CONSTRAINT FK_Department_TO_EmployeeDepartment
    FOREIGN KEY (departmentId)
    REFERENCES Department (id);

ALTER TABLE EmployeeDepartment
  ADD CONSTRAINT FK_Employee_TO_EmployeeDepartment
    FOREIGN KEY (employeeId)
    REFERENCES Employee (id);
