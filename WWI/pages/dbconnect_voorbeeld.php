<html>
<body>
<?php


// Create connection
$dbcon = mysqli_connect('localhost', 'root', '', 'wideworldimporters');

// Check connection
if ($dbcon->connect_error) {
    die("Connection failed: " . $dbcon->connect_error);
}
echo "succes";

$sql = "SELECT ColorID, ColorName FROM Colors";
$result = $dbcon->query($sql);
while ($row = $result->fetch_assoc()) {
    echo $row['ColorID'] . $row['ColorName'] . "\n";
}
?>

</body>
</html>
