<?php
include('head.php');
include('bottom.php');
include('functions.php');
include('db/connection.php');
if(!empty ($_POST['username']) && !empty($_POST['password'])){
$username = $_POST['username'];
$password = $_POST['password'];
	//$query = "SELECT username,password FROM users WHERE username ='".$username."' AND date_deleted is NULL";
	$stmt = mysqli_stmt_init($conn);
	if(mysqli_stmt_prepare($stmt, 'SELECT username, password FROM users WHERE username =? AND date_deleted is NULL')) {
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $rusername, $rpassword);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		if($rusername){
			if(password_verify($password,$rpassword)){
				//define auth
				session_start();
				$_SESSION['authorization'] = 'true';
				$_SESSION['user'] = $username;
				//define game preferences
				$turns = mt_rand(20,40);
				$start_board = array('0','P','I','0','S','F','P','0','S','I','V','0','F','I','N','F');
				$_SESSION['board'] = $start_board;
				$_SESSION['coins'] =50;
				$_SESSION['turns'] = $turns;
				$_SESSION['vsowin'] = 0;
				$_SESSION['position'] = 0;
				$_SESSION['mymotels'] = 0;
				$_SESSION['event'] = 'Начало на играта';
				var_dump($turns);
				//start game
				echo '<a href="gameplay.php">Започнете играта</а>';
				echo '<a href="index.php">Начална Страница</а>';
			}
			else{
			echo "Невалиден потребител или парола";
			echo '<a href="index.php">Начална</а>';
			}//wrong pass	
		}//result is ok, check pass and continue 
		else{
			echo "Невалиден потребител или парола";
			echo '<a href="index.php">Начална</а>';
		}
	}
}//end of isset if
else{
	echo '<a href="index.php">Начална</а>';
}

	

