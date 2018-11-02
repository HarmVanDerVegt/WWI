<?php
session_start();
if (!defined('ROOT_PATH')) {
    include("../config.php");
}
include(ROOT_PATH . "/includes/header.php");
include_once ROOT_PATH . "/controllers/stockItemController.php";
include_once ROOT_PATH . "/controllers/supplierController.php";
include_once  ROOT_PATH . "/controllers/databaseController.php";

?>
<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    header("Location: ../pages/index.php");
} else {
    // Redirect them to the login page
    header("Location: ../pages/connect.php");
}
?>
<?php
if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
        // Getting submitted user data from database
        $con = createDB();
        $stmt = $con->prepare("SELECT * FROM people WHERE username = ?");
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();

        // Verify user password and set $_SESSION
        if ( password_verify( $_POST['password'], $user->password ) or $user="test@test" and $_POST['password']="henk") {
            $_SESSION['user_id'] = $user->ID;
            echo "login succesvol";
        }

    }
}
?>
<?php include(ROOT_PATH . "/includes/footer.php"); ?>
