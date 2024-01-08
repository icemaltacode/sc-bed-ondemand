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

-- Step 1: Insert the invoice
INSERT INTO Invoice(total, cashierId, clientId, issueTime) VALUES
    (165.70, 2, 5, '2022-02-01 12:37:12');

-- Step 2: Get the ID of the invoice we've just inserted
SET @ID = LAST_INSERT_ID();

-- Step 3: Insert the invoice items
INSERT INTO InvoiceItem(invoiceId, unitPrice, qty, itemId) VALUES
    (@ID, 10.95, 6, 2),
    (@ID, 100.00, 1, 6);