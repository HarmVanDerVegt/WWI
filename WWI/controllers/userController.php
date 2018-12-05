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
            VALUES($user, $token, $today, $tomorrow)";

    print $sql;

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

    $token = "\"" . $token . "\"";

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