<?php

define("ROOT_PATH", __DIR__);
session_start();
if (!isset($_SESSION["token"])){
    $_SESSION["token"] = md5(uniqid(mt_rand(), true));
}
?>
