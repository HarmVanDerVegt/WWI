CREATE TABLE reviews (
	PersonID INT(11),
  StockItemID INT(11),
  Waarde INT(11),
  PRIMARY KEY (PersonID, StockItemID),
  FOREIGN KEY (PersonID) REFERENCES People(PersonID),
  FOREIGN KEY (StockItemID) REFERENCES StockItems(StockItemID)
);