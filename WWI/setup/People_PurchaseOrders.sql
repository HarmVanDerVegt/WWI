CREATE TABLE peoplepurchaseorders
(
  PersonID        INT(11),
  PurchaseOrderID INT(11),
  PRIMARY KEY (PersonID, PurchaseOrderID),
  FOREIGN KEY (PersonID) REFERENCES People (PersonID),
  FOREIGN KEY (PurchaseOrderID) REFERENCES PurchaseOrders (PurchaseOrderID)
);