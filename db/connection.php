<?php
	$conn = mysqli_connect('localhost','root','','itvillage');
	mysqli_set_charset($conn,"utf8");
		if(!$conn){
		die("error! ".mysqli_connect_error());
	}
	else{
		//echo "connected";
	}
