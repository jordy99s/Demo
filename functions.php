<?php

function check_login($pdo)
{

	if(isset($_SESSION['UserId']))
	{

		$id = $_SESSION['UserId'];
		$query = "select * from usuarios where UserId = '$id' limit 1";

		$result = mysqli_query($pdo,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
}
