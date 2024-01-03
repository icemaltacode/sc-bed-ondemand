-- Modifying Structure

CREATE TABLE Vendor(
    id              INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(20) NOT NULL,
    website         VARCHAR(50) NOT NULL,
    country         VARCHAR(30) NOT NULL,
    brandManager    INT NOT NULL,
    CONSTRAINT c_vendor_employee
        FOREIGN KEY(brandManager) REFERENCES Employee(id)
);

INSERT INTO Vendor(name, website, country, brandManager) VALUES
    ('Microsoft', 'https://microsoft.com', 'USA', 3),
    ('Linux Professional Institute', 'https://lpi.org', 'USA', 3),
    ('Digital Marketing Institute', 'https://digitalmarketinginstitute.com', 'Ireland', 2),
    ('Adobe', 'https://adobe.com', 'USA', 1);

SELECT * FROM Vendor;

ALTER TABLE Vendor
    CHANGE COLUMN name
    name VARCHAR(50) NOT NULL;

-- Modifying Constraints

DELETE FROM Employee WHERE Employee.id = 2;

ALTER TABLE Salary DROP CONSTRAINT c_salary_employee;

ALTER TABLE Salary
    ADD CONSTRAINT c_salary_employee
    FOREIGN KEY(employeeId) REFERENCES Employee(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE EmployeeDepartment DROP CONSTRAINT c_employeedepartment_employee;

ALTER TABLE EmployeeDepartment
    ADD CONSTRAINT c_employeedepartment_employee
    FOREIGN KEY(employeeId) REFERENCES Employee(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE Vendor
    CHANGE COLUMN brandManager
    brandManager INT;

ALTER TABLE Vendor DROP CONSTRAINT c_vendor_employee;

ALTER TABLE Vendor
    ADD CONSTRAINT c_vendor_employee
    FOREIGN KEY(brandManager) REFERENCES Employee(id)
    ON UPDATE CASCADE
    ON DELETE SET NULL;

SELECT * FROM Vendor;