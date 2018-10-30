<?php

include_once ROOT_PATH . "/config.php";

/*$sql = "SELECT ColorID, ColorName FROM Colors";

$db = createDB();

$result = $db->query($sql);
while ($row = $result->fetch_assoc()) {
    echo $row['ColorID'] . $row['ColorName'] . "<br>";
}*/

$table = "colors";

function getColorByID($id){

    global $table;

    $db = createDB();

    $sql = "SELECT ColorName
            FROM {$table}
            WHERE ColorID={$id}";

    $result = $db->query($sql);

    return $result->fetch_assoc();
}

?>