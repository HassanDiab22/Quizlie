<?php
session_start();
$_SESSION[] = array(); 
unset($_SESSION["LoggedIN"]);
unset($_SESSION["Username"]);
unset($_SESSION["UserId"]);
unset($_SESSION["quizTitle"]);
unset($_SESSION["quiz_id"]);
unset( $_SESSION["questions_number"] );
unset($_SESSION["count"]);
unset($_SESSION["attempt_id"]);

session_destroy();

header("Location: index.php");
?>