<?php
if(isset($_GET["logout"]) and $_GET["logout"] == true)
{
	//starting session
	session_start();

	//session completely destroy
    unset($_SESSION["uname"]);
	unset($_SESSION["status"]);

	header('Location: index.php');

}
?>