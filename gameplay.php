<?php
include('head.php');
include('bottom.php');
include('functions.php');
include('db/connection.php');
session_start();
//security check
if($_SESSION['authorization'] = 'true'){
//get user stats from db
	$query = "SELECT games,win,lose FROM users WHERE username='".$_SESSION['user']."'";
	$result = mysqli_query($conn,$query);
	$stat = mysqli_fetch_assoc($result);
	$games = $stat['games'];
	$win = $stat['win'];
	$lose = $stat['lose'];
//dice
$dice = 0;
//$board = array('0','P','I','0','S','F','P','0','S','I','V','0','F','I','N','F'); za triene
$board = $_SESSION['board'];
if($_SESSION['coins'] >= 0 && $_SESSION['turns'] >= 1 && $_SESSION['vsowin'] == 0 && $_SESSION['mymotels'] < 3){
	${"field".($_SESSION['position'])} = 'field';
	?>
	<!--end of php and button start -->
 	<form id="dice" method="POST" action="">
 	<button type="Submit" form="dice" name="Submit" value="Submit">Напред</button>
 	</form>	
<?php //php starts here
	if(isset($_POST['Submit'])){
		//dice
		$dice = mt_rand(1,6);
		$_SESSION['turns']-=1;
		//echo "Хвърлихте ".$dice." !";
		unset($_POST['Submit']);
		//echo " Имате ".$_SESSION['turns']. " оставащи хода ";
		//start game 
		$_SESSION['position'] = ($_SESSION['position']+$dice);
		if(($_SESSION['position']) < count($board)){
			$session = $_SESSION['position'];
			//echo " позиция ".$board[$_SESSION['position']]." ";
			$arr=game_position($board,$session,($_SESSION['turns']),($_SESSION['coins']),($_SESSION['vsowin']),($_SESSION['event']));
			//var_dump($arr);
			$_SESSION['board'] = $arr[0];
			$_SESSION['turns'] = $arr[2];
			$_SESSION['coins'] = $arr[3];
			$_SESSION['vsowin'] = $arr[4];
			$_SESSION['mymotels'] += $arr[5];
			$_SESSION['event'] = $arr[6];
			$turn = $arr[1];
			${"field".($_SESSION['position'])} = 'field';
		} //end of if positions 0-15
		else{
			$_SESSION['position'] =(($_SESSION['position']) - count($board)); 
			$session = $_SESSION['position'];
			$arr=game_position($board,$session,($_SESSION['turns']),($_SESSION['coins']),($_SESSION['vsowin']),($_SESSION['event']));
			$_SESSION['board'] = $arr[0];
			$_SESSION['turns'] = $arr[2];
			$_SESSION['coins'] = $arr[3];
			$_SESSION['vsowin'] = $arr[4];
			$_SESSION['mymotels'] += $arr[5];
			$_SESSION['event'] = $arr[6];
			$turn = $arr[1];
			${"field".($_SESSION['position'])} = 'field';
		} // еnd of else positions
	}//end of if
}
	else{
		if( $_SESSION['vsowin'] != 0){
		echo "Спечелихте с помощта на VSO!";
		echo "Имате ".$_SESSION['coins']." монети";	
		$games+=1;
		$win+=1;
		}//end of vso win
		elseif( $_SESSION['mymotels'] == 3){
		echo "Спечелихте! Притежавате всички мотели! ";
		echo "Имате ".$_SESSION['coins']." монети";	
		$games+=1;
		$win+=1;
		}//end of property win
		elseif( $_SESSION['coins'] <= 0){
		echo "Фалит! Загубихте! ";
		echo "Нямате монети!";
		$games+=1;
		$lose+=1;	
		}//end of lose no coins
		elseif( $_SESSION['turns'] <= 0){
		echo "Нямате повече ходове! Загубихте! ";
		echo "Имате ".$_SESSION['coins']." монети";	
		$games+=1;
		$lose+=1;
		}//end of lose no turns
		//add stats to db
		$query_add = "UPDATE users SET games=".$games.",win=".$win.",lose=".$lose." WHERE username = '".$_SESSION['user']."'";
		$result_add = mysqli_query($conn,$query_add);
	}//else game over
	//navigation

?>
<table>
	<thead>
		<tr>
			<th>Играч</th>
			<th>Зар</th>
			<th>Ходове</th>
			<th>Монети</th>
			<th>Събития</th>
		</tr>	
	</thead>
	<tbody>
		<tr>
			<td><?php echo $_SESSION['user'];?></td>
			<td><?php echo $dice;?></td>
			<td><?php echo $_SESSION['turns'];?></td>
			<td><?php echo $_SESSION['coins'];?></td>
			<td><?php echo $_SESSION['event'];?></td>
		</tr>
	</tbody>
	<!--prepare board table and fill it with fill_board func-->
	<table>
		<tr>
			<td class="<?=$field4?>"><?=fill_board(($_SESSION['board']),4);?></td>
			<td class='<?=$field5?>'><?=fill_board(($_SESSION['board']),5)?></td>
			<td class='<?=$field6?>'><?=fill_board(($_SESSION['board']),6)?></td>
			<td class='<?=$field7?>'><?=fill_board(($_SESSION['board']),7)?></td>
			<td class='<?=$field8?>'><?=fill_board(($_SESSION['board']),8)?></td>
		</tr>
		<tr>
			<td class='<?=$field3?>'><?=fill_board(($_SESSION['board']),3)?></td>
			<td colspan='3' rowspan='3'></td>
			<td class='<?=$field9?>'><?=fill_board(($_SESSION['board']),9)?></td>		
		</tr>
		<tr>
			<td class='<?=$field2?>'><?=fill_board(($_SESSION['board']),2)?></td>
			<td class='<?=$field10?>'><?=fill_board(($_SESSION['board']),10)?></td>
		</tr>
		<tr>
			<td class='<?=$field1?>'><?=fill_board(($_SESSION['board']),1)?></td>
			<td class='<?=$field11?>'><?=fill_board(($_SESSION['board']),11)?></td>	
		</tr>
		<tr>
			<td class="<?=$field0?>"><?=fill_board(($_SESSION['board']),0)?></td>
			<td class='<?=$field15?>'><?=fill_board(($_SESSION['board']),15)?></td>
			<td class='<?=$field14?>'><?=fill_board(($_SESSION['board']),14)?></td>
			<td class='<?=$field13?>'><?=fill_board(($_SESSION['board']),13)?></td>
			<td class='<?=$field12?>'><?=fill_board(($_SESSION['board']),12)?></td>
		</tr>
	</table>
</table>
<table>
	<thead>
		<tr>
			<th colspan="3">Статистика</th>
		</tr>
		<tr>
			<th>Игри</th>
			<th>Загуби</th>
			<th>Победи</th>
		</tr>	
	</thead>
	<tbody>
		<tr>
			<td><?php echo $games;?></td>
			<td><?php echo $win;?></td>
			<td><?php echo $lose;?></td>
		</tr>
	</tbody>
		<a href="access.php">Нова Игра</а>
		<a href="stats.php">Класиране</а>
		<a href="index.php">Начало</а>
<?php


}
else{
	echo "Невалиден потребител";
	echo '<a href="index.php">Начална</а>';
}

