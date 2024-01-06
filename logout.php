<?php
session_start();
$_SESSION[] = array(); // empty all sessions
unset($_SESSION["LoggedIN"]);
unset($_SESSION["Username"]);
unset($_SESSION["UserId"]);
unset($_SESSION["quizTitle"]);
unset($_SESSION["quiz_id"]);
unset( $_SESSION["questions_number"] );
unset($_SESSION["count"]);
session_destroy();

header("Location: index.php");
?>