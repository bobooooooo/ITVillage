<?php
include('head.php');
include('bottom.php');
include('functions.php');
include('db/connection.php');
//bootstrap container
echo '<div class="container"><div class="row mt-5 pt-5"><div class="col"></div><div class="col">';
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
				//$_SESSION['totalcoins'] = 0;
				$_SESSION['turns'] = $turns;
				$_SESSION['vsowin'] = 0;
				$_SESSION['position'] = 0;
				$_SESSION['mymotels'] = 0;
				$_SESSION['event'] = 'Начало на играта';
				//start game
				echo '<p class="h1 text-center">Влязохте успешно!</p>';
				echo '<p><a class="btn btn-primary mr-1" role="button" href="gameplay.php">Започнете играта</а>';
				echo '<a class="btn btn-warning ml-2 " role="button"  href="index.php">Начална Страница</а><p>';
				
			}
			else{
			echo '<p class="h3 text-center">Невалиден потребител или парола</p>';
			echo '<a class="btn btn-warning ml-2" role="button" href="index.php">Началo</а>';
			}//wrong pass	
		}//result is ok, check pass and continue 
		else{
			echo '<p class="h3 text-center">Невалиден потребител или парола</p>';
			echo '<a class="btn btn-warning ml-2" role="button" href="index.php">Начална</а>';
		}
	}
}//end of isset if
else{
	echo '<a href="index.php">Начало</а>';
}
//bootstrap equal end
echo '</div><div class="col"></div></div></div>';

	

