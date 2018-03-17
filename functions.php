<?php
//function game_position - computes $coins and etc. depending of location on board
function game_position($arr,$pos,$turns,$coins,$vsowin,$event){
	$mymotel = 0;
	switch ($arr[$pos]) {
		case '0':
			$event = "Празно Поле";
			break;
		case 'N':
			$event = "Печелите играта с помощта на VSO";
			$vsowin = 1;
			break;
		case 'V':
			$event = "Супер PHP! Монетите ви се увеличават x10";
			$coins*=10;
			break;
		case 'S':
			$event = "Буря! Губите два хода";
			$turns-=2;
			break;
		case 'F':
			$event = "Участвате в проект, +20 монети";
			$coins+=20;
			break;
		case 'I':
			if($coins>120){
				$coins-=100;
				$mymotel = 1;
				$arr[$pos] = 'IM';
				$event = "Купихте мотел, -100 монети";
			}//buy motel
			else{
				$event = "Мотел, -10 монети";
				$coins-=10;
			}//pay for room
			break;
		case 'IM':
			$еvent = "Мотел ваша собственост";
			//$coins-=5;
			break;
		case 'P':
			$event = "Кръчма, -5 монети";
			$coins-=5;
			break;
	}//end of switch
	return array($arr,$pos,$turns,$coins,$vsowin,$mymotel,$event);
}//end of function_position
//function board
function fill_board($array,$element){
	$output;
	switch ($array[$element]) {
		case '0':
			if($element < 4){
				$output= '<i class="fa fa-arrow-circle-up fa-3x" aria-hidden="true"></i>';
			}
			elseif($element >3 && $element <8){
				$output= '<i class="fa fa-arrow-circle-right fa-3x" aria-hidden="true"></i>';
			}
			elseif($element >7 && $element <12){
				$output= '<i class="fa fa-arrow-circle-down fa-3x" aria-hidden="true"></i>';
			}
			elseif($element >11 && $element <16){
				$output= '<i class="fa fa-arrow-circle-left fa-3x" aria-hidden="true"></i>';
			}
			break;
		case 'N':
			$output= '<i class="fa fa-star fa-3x" aria-hidden="true"></i>';
			break;
		case 'V':
			$output= '<i class="fa fa-money fa-3x" aria-hidden="true"></i>';
			break;
		case 'S':
			$output= '<i class="fa fa-cloud fa-3x" aria-hidden="true"></i>';
			break;
		case 'F':
			$output= '<i class="fa fa-eur fa-3x" aria-hidden="true"></i>';
			break;
		case 'I':
			$output= '<i class="fa fa-bed fa-3x" aria-hidden="true"></i>';
			break;
		case 'IM':
			$output= '<i class="fa fa-bed fa-3x" aria-hidden="true"></i>';
			break;
		case 'P':
			$output= '<i class="fa fa-beer fa-3x" aria-hidden="true"></i>';
			break;			
		}//end of switch
		return $output;
}//end of fill_board

