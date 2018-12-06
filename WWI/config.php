<?php

define("ROOT_PATH", __DIR__);
session_start();
if (!isset($_SESSION["csrf"])){
    $_SESSION["csrf"] = md5(uniqid(mt_rand(), true));
}
?>
