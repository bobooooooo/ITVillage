<?php
include('head.php');
include('bottom.php');
//bootstrap container
echo '<div class="container"><div class="row mt-5 pt-5"><div class="col"></div><div class="col">';
//check
if(empty($_POST['rusername']) || empty($_POST['rpass']) || empty($_POST['vpass']) || empty($_POST['name']) || empty($_POST['family']) || empty($_POST['mail'])){
	echo "Моля попълнете всички полета!";
	echo '<a class="btn btn-warning ml-2" role="button" href="index.php">Началo</а>';
}
elseif (($_POST['rpass']) != ($_POST['vpass'])) {
	echo "Въведените пароли трябва да са еднакви!";
	echo '<a class="btn btn-warning ml-2" role="button" href="index.php">Началo</а>';
}
elseif((strlen($_POST['rusername']) < 3) || (strlen($_POST['rpass']) <3) || (strlen($_POST['vpass']) <3) || (strlen($_POST['name']) < 3) || (strlen($_POST['family']) <3 ) || (strlen($_POST['mail'])<3)){
	echo "Всички полета трябва да съдържат минимум три символа!";
	echo '<a class="btn btn-warning ml-2" role="button" href="index.php">Началo</а>';
}
else{
	include('db/connection.php');
	//define variables needed
	$username =$_POST['rusername'];
	$password =$_POST['rpass'];
	$rep_password = $_POST['vpass'];
	$name = $_POST['name'];
	$family = $_POST['family'];
	$mail = $_POST['mail'];
	//prepared statement for username already in use
	$stmt = mysqli_stmt_init($conn);
	if(mysqli_stmt_prepare($stmt, 'SELECT username FROM users WHERE username =?')) {
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $result);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		if($result){
			echo "Потребител с това име вече съществува! Моля изберете друго име!";
			echo '<a class="btn btn-warning ml-2" role="button" href="index.php">Началo</а>';
		}// if already in use
		else{
			$password=password_hash($password, PASSWORD_BCRYPT);
			$stmt = mysqli_stmt_init($conn);
			if(mysqli_stmt_prepare($stmt, 'INSERT INTO users (name, family, username, password, email, games, win, lose, coins) VALUES (?,?,?,?,?,0,0,0,0)')) {
			mysqli_stmt_bind_param($stmt, "sssss", $name, $family, $username, $password, $mail);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			echo "Регистрацията е успешна! Моля въведете името и паролата си в началната страница!";
			echo '<a class="btn btn-primary ml-2" role="button"  href="index.php">Началo</а>';
			}//end if insert new user to db
			else{
				echo "Проблем! Моля опитайте отново по-късно....";
				echo '<a class="btn btn-warning ml-2" role="button" href="index.php">Началo</а>';
			}
		}//else register
	}//if prepared statement user name already in use
}//end of else
//bootstrap equal end
echo '</div><div class="col"></div></div></div>';