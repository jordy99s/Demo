<?php
// Initialize the session
session_start();
 

if(isset($_SESSION['UserId']))
{
	unset($_SESSION['UserId']);

}
 
// Redirect to index page
header("location: index.php");
exit;
?>