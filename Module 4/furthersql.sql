USE POS;

-- Views
CREATE VIEW vwSoldItems AS 
SELECT
    Item.name, InvoiceItem.unitPrice, InvoiceItem.qty
FROM
    Item
    JOIN InvoiceItem ON InvoiceItem.itemId = Item.id;

SELECT * FROM vwSoldItems;

-- Transactions

START TRANSACTION;

-- Step 1: Insert the invoice
INSERT INTO Invoice(total, cashierId, clientId, issueTime) VALUES
    (165.70, 2, 5, NOW());

-- Step 2: Get the ID of the invoice we've just inserted
SET @ID = LAST_INSERT_ID();

-- Step 3: Insert the invoice items
INSERT INTO InvoiceItem(invoiceId, unitPrice, qty, itemId) VALUES
    (@ID, 10.95, 6, 2),
    (@ID, 100.00, 1, 6);

COMMIT;

SELECT * FROM Invoice;

SELECT * FROM InvoiceItem;

DELETE FROM Invoice WHERE id = 4;

-- BOOLEAN Logic

SELECT
    Invoice.*,
    CASE
        WHEN Invoice.total >= 1000 THEN 'High Value'
        ELSE 'Normal Value'
    END AS invoiceValue
FROM
    Invoice;

-- Debtors view
CREATE VIEW vwDebtors AS 
SELECT
    T.*,
    CASE
        WHEN T.balance <= 499 THEN 'Sales'
        ELSE 'Finance'
    END AS Department
FROM
    (
        SELECT 
            Client.id, Client.name, Client.surname,
            (SELECT SUM(Invoice.total) FROM Invoice WHERE Invoice.clientId = Client.id) - 
            (SELECT SUM(Payment.total) FROM Payment WHERE Payment.clientId = Client.id) AS balance
        FROM 
            Client
        HAVING
            balance IS NOT NULL
    ) AS T;

SELECT * FROM vwDebtors;

-- Simple Case Expression
SELECT
    InvoiceItem.id, InvoiceItem.unitPrice, Item.name, Category.catCode,
    CASE Category.catCode
        WHEN 'ENT' THEN 'Parcel - Large'
        WHEN 'CUT' THEN 'Parcel - Small'
        WHEN 'CRK' THEN 'Parcel (Fragile)'
        WHEN 'APP' THEN 'Van'
        ELSE 'Delivery not available'
    END AS DeliveryMode
FROM
    InvoiceItem
    JOIN Item ON Item.id = InvoiceItem.itemId
    JOIN Category ON Category.id = Item.categoryId;

-- Joinig Boolean Expressions

SELECT
    InvoiceItem.id, InvoiceItem.unitPrice, Item.name, Category.catCode,
    CASE 
        WHEN Category.catCode = 'ENT' AND InvoiceItem.unitPrice <= 999 THEN 'Parcel - Large'
        WHEN Category.catCode = 'ENT' AND InvoiceItem.unitPrice >= 1000 THEN 'Van'
        WHEN Category.catCode = 'CUT' OR Category.catCode = 'CRK' THEN 'Parcel (Fragile)'
        WHEN Category.catCode = 'APP' THEN 'Van'
        ELSE 'Delivery not available'
    END AS DeliveryMode
FROM
    InvoiceItem
    JOIN Item ON Item.id = InvoiceItem.itemId
    JOIN Category ON Category.id = Item.categoryId;

-- IF function
SELECT
    Invoice.*,
    IF(Invoice.total >= 1000, 'High Value', 'Normal Value') AS invoiceValue
FROM
    Invoice;

-- Using COALESCE
SELECT * FROM vwDebtors;

SELECT * FROM Invoice;

SELECT * FROM Payment;


SELECT 
    (SELECT SUM(Invoice.total) FROM Invoice WHERE Invoice.clientId = 5) - 
    (SELECT SUM(Payment.total) FROM Payment WHERE Payment.clientId = 5) AS balance;


SELECT SUM(Invoice.total) FROM Invoice WHERE Invoice.clientId = 5;

SELECT SUM(Payment.total) FROM Payment WHERE Payment.clientId = 5;


DROP VIEW vwDebtors;

CREATE VIEW vwDebtors AS 
SELECT
    T.*,
    CASE
        WHEN T.balance <= 499 THEN 'Sales'
        ELSE 'Finance'
    END AS Department
FROM
    (
        SELECT 
            Client.id, Client.name, Client.surname,
            (SELECT SUM(Invoice.total) FROM Invoice WHERE Invoice.clientId = Client.id) - 
            COALESCE((SELECT SUM(Payment.total) FROM Payment WHERE Payment.clientId = Client.id), 0) AS balance
        FROM 
            Client
        HAVING
            balance IS NOT NULL
    ) AS T;

SELECT * FROM vwDebtors;