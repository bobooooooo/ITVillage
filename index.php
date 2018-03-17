<?php
include('head.php');
include('bottom.php');
?>
<div>
<p>
<form id="login" method="POST" action="access.php">
	<label for="username">Потребителско име</label>
	<input id="username" type="text" name="username" value=""> 
	<label for="password">Парола</label>
	<input id="password" type="password" name="password" value="">
<button type="submit" form="login" value="Submit">Влез</button>
</form>
</p>
</div>
<div>
<form id="register" method="POST" action="register.php">
	<label for="rusername">Потребителско име</label>
	<input id="rusername" type="text" name="rusername" value=""> 
	<label for="rpassword">Парола</label>
	<input id="rpassword" type="password" name="rpass" value="">
	<label for="vpassword">Парола отново</label>
	<input id=v"password" type="password" name="vpass" value="">
	<label for="rname">Име</label>
	<input id="rname" type="text" name="name" value="">
	<label for="family">Фамилия</label>
	<input id="family" type="text" name="family" value="">
	<label for="mail">E-mail</label>
	<input id="mail" type="text" name="mail" value="">   
<button type="submit" form="register" value="Submit">Регистрирай се</button>
</form>
</div>
<a href="stats.php">Класиране</а>