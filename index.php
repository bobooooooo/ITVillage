<?php
include('head.php');
include('bottom.php');
?>
<div class="container">
  <div class="row">
    <div class="col">
    	<h1 class="display-4 text-center">Добре дошли в ИТ Село</h1>
    </div>
  </div>  
  <div class="row offset-md-0.5 mt-1 pt-1">
    <div class="col">
    	<h4>Вход</h4>
    	<form id="login" method="POST" action="access.php">
    	<div class="form-group">
			<label for="username">Потребителско име</label>
			<input class="form-control" id="username" type="text" name="username" value="">
		</div>
		 <div class="form-group">	 
			<label for="password">Парола</label>
			<input class="form-control" id="password" type="password" name="password" value="">
		</div>
		<div class="form-group">	
			<button class="btn btn-primary" type="submit" form="login" value="Submit">Вход</button>
		</div>
		<div class="h3 text-center">
			<p>Нямате регистрация?</p>
			<i class="fa fa-arrow-right fa-4x" aria-hidden="true"></i>
			<p>Регистрирайте се!</p>
		</div>
	</form> 
	<div class="mt-5">
    	<a class="btn btn-primary mt-5" role="button" href="stats.php">Класиране</a>
   	</div>
   </div>
    <div class="col border-left ">
    	<h4>Регистрация</h4>
        <form id="register" method="POST" action="register.php">
          <div class="form-group">	
			<label for="rusername">Потребителско име</label>
			<input  class="form-control" id="rusername" type="text" name="rusername" value="">
		</div>
		<div class="form-group"> 
			<label for="rpassword">Парола</label>
			<input class="form-control" id="rpassword" type="password" name="rpass" value="">
		</div>
		<div class="form-group">
			<label for="vpassword">Парола отново</label>
			<input class="form-control" id=v"password" type="password" name="vpass" value="">
		</div>
		<div class="form-group">
			<label for="rname">Име</label>
			<input class="form-control" id="rname" type="text" name="name" value="">
		</div>
		<div class="form-group">
			<label for="family">Фамилия</label>
			<input class="form-control" id="family" type="text" name="family" value="">
		</div>
		  <div class="form-group">
			<label for="mail">E-mail</label>
			<input class="form-control" id="mail" type="text" name="mail" value="">
		</div>
		<div class="form-group">   
			<button class="btn btn-primary" type="submit" form="register" value="Submit">Регистрирай се</button>
		</div>
		</form>
    </div>
  </div>
</div>