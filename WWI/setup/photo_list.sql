USE wideworldimporters;

-- maak tabel photo_list aan
CREATE TABLE photo_list(
	photoID INT(11) NOT NULL,
    stockitemID INT(11) NOT NULL,
    photo LONGBLOB,
    PRIMARY KEY(photoID,stockitemID),
    FOREIGN KEY(stockitemID) REFERENCES stockitems(StockItemID)
);

-- je moet zelf wat fotos toevoegen