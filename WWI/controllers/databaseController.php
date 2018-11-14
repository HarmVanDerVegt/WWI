<?php

function createDB()
{
    // Create connection
    $dbcon = mysqli_connect('localhost', 'root', '', 'wideworldimporters');

    // Check connection
    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }
    //echo "succes";

    return $dbcon;
}

//Geeft een rij uit de database terug als array.
//Gebruik: $result[attribute]
//Voorbeeld:    $item =  getRowByIntID("StockItemID", 'stockItems", 6);
//              $item["StockItemName"];
function getRowByIntID($ID, $table, $value)
{
    //Initieert de database.
    $db = createDB();

    //Geeft een error als de value geen int is.
    $value = (int)$value;

    //Prepared de SQL statement.
    $sql = "SELECT *
            FROM $table
            WHERE $ID = $value";

    //Voert de statement uit.
    $result = $db->query($sql);

    //Geeft de eerste rij terug als array en gaat naar de volgende rij, die er niet is.
    //Dit geeft dus maar één rij terug.
    $result = $result->fetch_assoc();
    $db->close();
    return $result;
}

function getAllRows($table)
{
    $db = createDB();

    $sql = "SELECT *
            FROM $table";

    $result = $db->query($sql);

    $array = [];

    while ($row = $result->fetch_assoc()) {
        $array[array_values($row)[0]] = $row;
    }

    return $array;
}

function getRowByForeignID($value, $table1, $table2, $joinID, $joinID2)
{

    $db = createDB();

    $sql = "SELECT *
            FROM $table1 AS t1
            JOIN $table2 AS t2
            ON t1.$joinID = t2.$joinID2
            WHERE t1.$joinID = $value";

    $result = $db->query($sql);

    $array = [];

    while ($row = $result->fetch_assoc()) {
        $array[array_values($row)[0]] = $row;
    }
    return $array;
}

function getHighestAttributeByIntID($ID, $table)
{
    $db = createDB();

    $sql = "SELECT MAX($ID) hoogste
            FROM $table";

    $result = $db->query($sql);

    return $result->fetch_assoc()["hoogste"];
}

function getLowestAttributeByIntID($ID, $table)
{
    $db = createDB();
    $sql = "SELECT MIN($ID) laagste
            FROM $table";

    $result = $db->query($sql);

    return $result->fetch_assoc()["laagste"];
}

function getRowByTwoForeignIDs($value, $table1, $table2, $table3, $joinID, $joinID2)
{

    $db = createDB();

    $sql = "SELECT *
            FROM $table1 AS t1
            JOIN $table2 AS t2
            ON t1.$joinID = t2.$joinID
            JOIN $table3 AS t3
            ON t2.$joinID2 = t3.$joinID2
            WHERE t1.$joinID = $value";


    $returnValue = $result->fetch_assoc();

    $db->close();

    return $returnValue;
}

function InsertNewUser($valuarray)
{
    $voornaam = $valuarray["Voornaam"];
    $achternaam = $valuarray["Achternaam"];
    $adres = $valuarray["Adres"];
    $straat = $valuarray["Straat"];
    $huisnummer = $valuarray["Huisnummer"];
    $postcode = $valuarray["Postcode"];
    $woonplaats = $valuarray["Woonplaats"];
    $Email = $valuarray["Email"];
    $password = $valuarray["Wachtwoord"];
    $verpassword = $valuarray["bevestig_wachtwoord"];
    $phone = $valuarray["Phone"];
    $date = date("Y/m/d");
    if ($password == $verpassword) {
        $passhash = hash(sha256, $password);
    } else {
        echo("Wachtwoorden zijn niet gelijk");
    }


    $db = createDB();
    $sql = "select max(PersonID)
from people";
    $max = $db->query($sql);
    $sql = "select CityID
from cities where CityName like '%.$woonplaats.%'";
    $cityid = $db->query($sql);


    $sql = "insert into people 
    SET wideworldimporters.people.LogonName = ('.$Email.'), wideworldimporters.people.HashedPassword = ('.$passhash.'), PersonID =(.$max + 1.), FullName = ('.$voornaam.' '.$achternaam.'),PreferredName =('.$voornaam.'),SearchName =('.$voornaam.' '.$achternaam.'), IsPermittedToLogon =(1), IsExternalLogonProvider =(0),IsSystemUser = (1),IsEmployee = (0), IsSalesperson = (0),PhoneNumber=('.$phone.'), LastEditedBy =(1),ValidFrom =($date .'23:59:00'),ValidTo =('9999-12-31 23:59:59')";
    $result = $db->query($sql);
    $sql = " insert into customers set CustomerID=($max + 1), PrimaryContactPersonID=($max + 1),CustomerName=('.$voornaam.' '.$achternaam.'),BillToCustomerID=($max + 1),CustomerCategoryID=(8),DeliveryMethodID=(1),DeliveryCityID=( $cityid ),PostalCityID=( $cityid ),AccountOpenedDate=(),StandardDiscountPercentage=(0),IsStatementSent=(0),PaymentDays=(7),FaxNumber=(000-000-0000),WebsiteURL=(NULL),DeliveryAddressLine1=(),DeliveryPostalCode=(),PostalAddressLine1=(),PostalPostalCode=(),LastEditedBy=(99),ValidFrom =($date .'23:59:00'),ValidTo =('9999-12-31 23:59:59')";
    $result = $db->query($sql);

}
