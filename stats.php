<?php
//bootstrap container
echo '<div class="container"><div class="row mt-5 pt-5"><div class="col"></div><div class="col">';
include('head.php');
include('bottom.php');
include('db/connection.php');
	$query = "SELECT username,games,win,lose,coins FROM users WHERE date_deleted is NULL and games > 0 ORDER BY win DESC, coins DESC, games DESC, lose ASC";
	$result = mysqli_query($conn,$query);
	if($result){
		echo '<table class="table">';
		echo '<thead class="thead-light"><tr><th>Потребител</th><th>Игри</th><th>Победи</th><th>Монети</th><th>Загуби</th></thead><tbody class="table-dark">';
		while($arr = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>".$arr['username']."</td>";
			echo "<td>".$arr['games']."</td>";
			echo "<td>".$arr['win']."</td>";
			echo "<td>".$arr['coins']."</td>";
			echo "<td>".$arr['lose']."</td>";
			echo "</tr>";
	}//end of while
	echo "</tbody></table>";
}//end of if
?>
<a class="btn btn-primary" role="button" href="index.php">Началo</а>
</div><div class="col"></div></div></div>