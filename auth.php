<?php
require_once 'Config.php';
session_start();
if (!isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"]!=1) {
  header("Location: login.php");
}

?>