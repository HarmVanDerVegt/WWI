<?php
include_once "databaseController.php";


function getUser($logonName, $password)
{
//start database connectie
    $db = createDB();

// sql voor controleren van gebuikersnaam
    $sql = "SELECT *
            FROM people
            WHERE logonName=\"$logonName\"
            ";


    $result = $db->query($sql);
// waarde van array to string
    $result = $result->fetch_assoc();

// controlleren van het wachtwoord en sluiten database connectie
    $db->close();
    $resultww = password_verify($password, $result['HashedPassword']);
    if ($resultww == TRUE) {

        $result['Succes'] = $resultww;
        return $result;
    } else {
        $result['Succes'] = FALSE;
    }
    return false;
}

function getUserByID($ID)
{
    return getRowByIntID("PersonID", "people", $ID);
}

function getUserByLogOnName($email)
{

    //Initieert de database.
    $db = createDB();

    //Prepared de SQL statement.
    $sql = "SELECT PersonID
            FROM people
            WHERE LogonName = '$email'";

    //Voert de statement uit.
    $result = $db->query($sql);

    //Geeft de eerste rij terug als array en gaat naar de volgende rij, die er niet is.
    //Dit geeft dus maar één rij terug.
    $result = $result->fetch_assoc();
    $db->close();

    return $result["PersonID"];

}


function getCustomerByID($ID)
{

//verkijg een cumtomer bij customerID
    return getRowByIntID('PrimaryContactPersonID', 'Customers', $ID);
}

function getCityByID($ID)
{

//verkijg een cumtomer bij cityID
    return getRowByIntID('CityID', 'cities', $ID);

}

function insertRecoveryToken($token, $ID)
{

    $db = createDB();

    $user = getUserByID($ID)["PersonID"];
    if ($user == null) {
        $user = 5;
    }

    $today = date("y-m-d-H-i");
    $tomorrow = date("y-m-d-H-i", time() + 86400);

    $today = "\"" . $today . "\"";
    $tomorrow = "\"" . $tomorrow . "\"";
    $token = "\"" . $token . "\"";

    $sql = "INSERT INTO WachtwoordTokens
            VALUES($user, $token, $today, $tomorrow)
            ON DUPLICATE KEY UPDATE Token=$token";

    $db->query($sql);

    $db->close();

    return true;
}

function mailRecoveryToken($token, $mail, $ID)
{

    $link = "http://localhost:63342/WWI/WWI/pages/wachtwoordReset.php?token=" . $token . "&userID=" . $ID;

    $message = "Beste gebruiker,\n
                \n
                U heeft een nieuw wachtwoord opgevraagd, u kunt de link in deze mail volgen om een nieuw wachtwoord aan te vragen.\n
                Let op: deze link is 24 uur geldig.\n
                \n
                $link \n
                \n
                We hopen u binnenkort weer te zien!\n
                \n
                Met vriendelijke groet,\n
                Wide World Importers.";
    $message = wordwrap($message, 70, "\n");

    return mail($mail, "Wachtwoord vergeten", $message);
}

function checkRecoveryToken($token, $ID)
{
    $db = createDB();

    //$token = "\"" . $token . "\"";

    $sql = "SELECT Token, ValidTo
            FROM WachtwoordTokens
            WHERE PersonID=$ID";

    $result = $db->query($sql);

    $result = $result->fetch_assoc();

    //Check of 24 uur verstreken zijn.
    if ($result["ValidTo"] < date("y-m-d-H-i")) {
        return false;
    }

    $db->close();

    return $result["Token"] == $token;
}

function resetPassword($ID, $password)
{
    $password = password_hash($password, PASSWORD_DEFAULT);
    $db = createDB();

    $sql = "UPDATE people SET hashedpassword = '$password' WHERE PersonID = '$ID'";
    
     $result = $db->query($sql);

    $db->close();

    return $result;
}

function InsertNewUser($valuarray){
//    verkrijg data van array
    $voornaam = $valuarray["Voornaam"];
    $achternaam = $valuarray["Achternaam"];
    $straat = $valuarray["Straat"];
    $huisnummer = $valuarray["Huisnummer"];
    $postcode = $valuarray["Postcode"];
    $woonplaats = $valuarray["Woonplaats"];
    $Email = $valuarray["Email"];
    $password = $valuarray["Wachtwoord"];
    $verpassword = $valuarray["bevestig_wachtwoord"];
    $phone = $valuarray["Phone"];
    $Provincie = $valuarray["Provincie"];
    $date = date("Y/m/d");

    if (empty($valuarray["Voornaam"])
        or empty($valuarray["Achternaam"])
        or empty($valuarray["Straat"])
        or empty($valuarray["Huisnummer"])
        or empty($valuarray["Postcode"])
        or empty($valuarray["Email"])
        or empty($valuarray["Wachtwoord"])
        or empty($valuarray["bevestig_wachtwoord"])
        or empty($valuarray["Provincie"])){
        echo "vul alle velden";
    }

//    controlleer ww
    if ($password == $verpassword) {
        $passhash = password_hash($password, PASSWORD_DEFAULT);
    } else {
        return ("Wachtwoorden zijn niet gelijk");
    }
    //set phone number to zero if empty
    if (isset($phone)) {
        $phone = 000000;
    }
//     start database connectie
    $db = createDB();
//    verkrijg personid van database
    $maxsql = "select max(PersonID) +1 from people";
    $maxresult = $db->query($maxsql);
    $maxidresultar = $maxresult->fetch_assoc();
// verkrijg customerid van database
    $customeridsql = "select max(CustomerID) +1 from customers";
    $customerresult = $db->query($customeridsql);
    $customerresultar = $customerresult->fetch_assoc();
//verkrijg cityid van database
    $citysql = "select CityID 
                from cities 
                where CityName = '$woonplaats'";
    $cityid = $db->query($citysql);
    $cityidresultar = $cityid->fetch_assoc();


    // Create new city if it does not exist
    if (!$cityidresultar) {
        $maxcityidsql = "select max(CityID) +1 from cities";
        $maxrcityidesult = $db->query($maxcityidsql);
        $maxcityidresultar = $maxrcityidesult->fetch_assoc();
        foreach ($maxcityidresultar as $maxcityarresult) {
            $cityidresult = $maxcityarresult;
        }
// verkijg provincieid van database
        $getprovincieid = "select StateProvinceID 
                          from stateprovinces 
                          where StateProvinceName 
                          like '%$Provincie%'";
        $getprovincieidresult = $db->query($getprovincieid);
        $getprovincieidresultar = $getprovincieidresult->fetch_assoc();
        foreach ($getprovincieidresultar as $provinceidresultar) {
            $provinceid = $provinceidresultar;
        }
//        voeg stad toe als deze niet bestaat
        $createcitysql = "insert into cities
                          set CityID=($cityidresult),
                          CityName=('$woonplaats'), 
                          StateProvinceID=($provinceid),
                          LastEditedBy=(1),
                          ValidFrom =('$date 01:00:00'),
                          ValidTo =('9999-12-31 23:59:59')";
//        verkijg de id van de nieuwe city
        $db->query($createcitysql);
        $citysql = "select CityID 
                from cities 
                where CityName = '$woonplaats'";
        $cityid = $db->query($citysql);
        $cityidresultar = $cityid->fetch_assoc();
    }
    //array to value conversion
    foreach ($maxidresultar as $maxarresult) {
        $maxidresult = $maxarresult;
    }
    foreach ($cityidresultar as $cityarresult) {
        $cityidresult = $cityarresult;
    }
    foreach ($customerresultar as $customerarresult) {
        $customerID = $customerarresult;
    }
// voeg de waardes toe aan de people table
    $peoplesql = "insert into people
                  SET wideworldimporters.people.LogonName = ('$Email'),
                  wideworldimporters.people.HashedPassword = ('$passhash'),
                  PersonID =('$maxidresult'),
                  FullName = ('$voornaam ' '$achternaam'),
                  PreferredName =('$voornaam'),
                  SearchName =('$voornaam ' '$achternaam'),
                  IsPermittedToLogon =(1),
                  IsExternalLogonProvider =(0),
                  IsSystemUser = (1),
                  IsEmployee = (0),
                  IsSalesperson = (0),
                  PhoneNumber=('$phone'),
                  LastEditedBy =(1),
                  ValidFrom =('$date  01:00:00'),
                  ValidTo =('9999-12-31 23:59:59')";
    $db->query($peoplesql);

// voeg de waardes toe aan de cumtomers table
    $customersql = " insert into customers 
                    set CustomerID=($customerID),
                    PrimaryContactPersonID=($maxidresult),
                    CustomerName=('$voornaam ' '$achternaam'),
                    BillToCustomerID=($customerID),
                    CustomerCategoryID=(8),
                    DeliveryMethodID=(1),
                    DeliveryCityID=($cityidresult),
                    PostalCityID=($cityidresult),
                    AccountOpenedDate=('$date  00:00:00'),
                    StandardDiscountPercentage=(0),
                    IsStatementSent=(0),
                    PaymentDays=(7),
                    FaxNumber=(000-000-0000),
                    WebsiteURL=('nullwebsite'),
                    DeliveryAddressLine1=('$straat ' ' $huisnummer'),
                    DeliveryPostalCode=('$postcode'),
                    PostalAddressLine1=('$straat ' ' $huisnummer'),
                    PostalPostalCode=('$postcode'),
                    LastEditedBy=(1),
                    ValidFrom =('$date 01:00:00'),
                    ValidTo =('9999-12-31 23:59:59'),
                    IsOnCreditHold=(0),
                    PhoneNumber=($phone)";
    $db->query($customersql);


    $_SESSION["Voornaam"] = $voornaam;
    $_SESSION["achternaam"] = $achternaam;
    $_SESSION["Email"] = $Email;
    echo "<meta http-equiv=\"refresh\" content=\"0; url=/WWI/WWI/pages/confirmregister.php\" />";

}
