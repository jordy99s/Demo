<?php
/*
function check_login($link)
{

	if(isset($_SESSION['UserId']))
	{

		$id = $_SESSION['UserId'];
		$query = "select * from usuarios where UserId = '$id' limit 1";

		$result = mysqli_query($link,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
}
*/

function check_login(){
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: index.php");
		exit;
	}
}