<?php
include('head.php');
include('bottom.php');
include('functions.php');
include('db/connection.php');
session_start();
//bootstrap container
echo '<div class="container"><div class="row mt-2 pt-2"><div class="col"></div><div class="col-6">';
//security check
if($_SESSION['authorization'] = 'true'){
//get user stats from db
	$query = "SELECT games,win,lose,coins FROM users WHERE username='".$_SESSION['user']."'";
	$result = mysqli_query($conn,$query);
	$stat = mysqli_fetch_assoc($result);
	$games = $stat['games'];
	$win = $stat['win'];
	$lose = $stat['lose'];
	$total_coins = $stat['coins'];
//dice
$dice = 0;
//$board = array('0','P','I','0','S','F','P','0','S','I','V','0','F','I','N','F'); za triene
$board = $_SESSION['board'];
if($_SESSION['coins'] >= 0 && $_SESSION['turns'] >= 1 && $_SESSION['vsowin'] == 0 && $_SESSION['mymotels'] < 3){
	${"field".($_SESSION['position'])} = 'field';
	?>
	<!--end of php and button start -->
 	<form id="dice" method="POST" action="">
 	<!--<button type="Submit" form="dice" name="Submit" value="Submit">Напред</button>-->
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
		echo '<span class="alert alert-success" role="alert">Спечелихте с помощта на VSO!</span>';
		echo "Имате ".$_SESSION['coins']." монети";	
		$games+=1;
		$win+=1;
		$total_coins+=$_SESSION['coins'];
		}//end of vso win
		elseif( $_SESSION['mymotels'] == 3){
		echo '<span class="alert alert-success" role="alert">Спечелихте! Притежавате всички мотели!</span>';
		echo "Имате ".$_SESSION['coins']." монети";	
		$games+=1;
		$win+=1;
		$total_coins+=$_SESSION['coins'];
		}//end of property win
		elseif( $_SESSION['coins'] <= 0){
		echo '<span class="alert alert-danger" role="alert">Фалит! Загубихте!</span>';
		echo "Нямате монети!";
		$games+=1;
		$lose+=1;
		$total_coins+=$_SESSION['coins'];	
		}//end of lose no coins
		elseif( $_SESSION['turns'] <= 0){
		echo '<span class="alert alert-danger" role="alert">Нямате повече ходове! Загубихте!</span>';
		echo "Имате ".$_SESSION['coins']." монети";	
		$games+=1;
		$lose+=1;
		$total_coins+=$_SESSION['coins'];
		}//end of lose no turns
		//add stats to db
		$query_add = "UPDATE users SET games=".$games.",win=".$win.",lose=".$lose.",coins=".$total_coins." WHERE username = '".$_SESSION['user']."'";
		$result_add = mysqli_query($conn,$query_add);
		// remove all session variables
	}//else game over
	//navigation

?>
<div class="">
<table class="table table-sm">
	<thead class="thead-light">
		<tr>
			<th>Играч</th>
			<th>Зар</th>
			<th>Ходове</th>
			<th>Монети</th>
			<th>Събития</th>
		</tr>	
	</thead>
	<tbody class="table-dark">
		<tr>
			<td><?php echo $_SESSION['user'];?></td>
			<td><?php echo $dice;?></td>
			<td><?php echo $_SESSION['turns'];?></td>
			<td><?php echo $_SESSION['coins'];?></td>
			<td><?php echo $_SESSION['event'];?></td>
		</tr>
	</tbody>
	</table>
	<!--prepare board table and fill it with fill_board func-->
	<div class="board mt-1 mb-1 pt-1 pb-1">
	<table class="table table-bordered table-sm table-responsive-md text-small text-centered">
		<tr>
			<td class="<?=$field4?>"><?=fill_board(($_SESSION['board']),4);?></td>
			<td class='<?=$field5?>'><?=fill_board(($_SESSION['board']),5)?></td>
			<td class='<?=$field6?>'><?=fill_board(($_SESSION['board']),6)?></td>
			<td class='<?=$field7?>'><?=fill_board(($_SESSION['board']),7)?></td>
			<td class='<?=$field8?>'><?=fill_board(($_SESSION['board']),8)?></td>
		</tr>
		<tr>
			<td class='<?=$field3?>'><?=fill_board(($_SESSION['board']),3)?></td>
			<td colspan='3' rowspan='3'><button type="Submit" form="dice" name="Submit" value="Submit" class="btn-primary btn-lg btn-block mt-5 pt-5 pb-5 mb-5">Напред</button></td>
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
</div>
<table class="table table-sm">
	<thead class="thead-dark">
		<tr>
			<th colspan="4">Вашият общ резултат</th>
		</tr>
		<tr>
			<th>Игри</th>
			<th>Загуби</th>
			<th>Победи</th>
			<th>Спечелени монети</th>
		</tr>	
	</thead>
	<tbody class="table-success">
		<tr>
			<td><?php echo $games;?></td>
			<td><?php echo $win;?></td>
			<td><?php echo $lose;?></td>
			<td><?php echo $total_coins;?></td>
		</tr>
	</tbody>
</table>
</div>
		<a href="stats.php" class="btn btn-primary btn-small ml-2 mr-2" role="button">Класиране</а>
		<a href="index.php" class="btn btn-primary btn-small ml-2 mr-2" role="button">Начало</а>
<?php


}
else{
	echo "Невалиден потребител";
	echo '<a href="index.php">Начална</а>';
}
//bootstrap equal end
echo '</div><div class=col></div></div></div>';

