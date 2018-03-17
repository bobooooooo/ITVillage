<?php
include('head.php');
include('bottom.php');
include('db/connection.php');
	$query = "SELECT username,games,win,lose FROM users WHERE date_deleted is NULL and games > 0 ORDER BY win DESC, games DESC";
	$result = mysqli_query($conn,$query);
	if($result){
		echo '<table border="1px solid black">';
		echo '<thead><tr><th>Потребител</th><th>Игри</th><th>Победи</th><th>Загуби</th></thead><tbody>';
		while($arr = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>".$arr['username']."</td>";
			echo "<td>".$arr['games']."</td>";
			echo "<td>".$arr['win']."</td>";
			echo "<td>".$arr['lose']."</td>";
			echo "</tr>";
	}//end of while
	echo "</tbody></table>";
}//end of if
?>
<a href="index.php">Начална</а>