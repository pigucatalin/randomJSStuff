<?php

/**
 * Prints $text in the terminal and reads user input and trims it
 * @param $text
 * @return trimmed user input string
 */
function readUserInput($text){
	return trim(readline("$text"));
}

/**
 * Take string input, explodes is by comma and validates that after explode we have $expectedNumberOfOptions
 * and that they all are in the array with valid options provided by $validOptions
 * @param $input
 * @param $expectedNumberOfOptions
 * @param $validOptions
 * @return if input respects number and is in valid options
 */
function validateUserInput($input, $expectedNumberOfOptions, $validOptions){
	$splits = explode(',', $input);

	$numberOfInputs = count($splits);
	if( $numberOfInputs != $expectedNumberOfOptions){
		println("Expected $expectedNumberOfOptions but found $numberOfInputs");
		return false;
	}

	$allValid = true;
	foreach($splits as $split){
		if (!in_array($split, $validOptions)){
			println("$split NOT VALID");
			$allValid = false;
		}
		else{
			println("$split validated");
		}
	}

	return $allValid;
}


/**
 * Prints message and adds \n at the end
 * @param $mess
 */
function println($mess){
	echo $mess."\n";
}

/**
 * Simulates coin toss and returns 1 or 0
 * @return int
 */
function coinToss(){
	return rand(3, 10000)%2;
}

/**
 * @param $menuTitle
 */
function printMenuHeader($menuTitle){
	println("\n\n");
	println("------------------------------");
	println($menuTitle);
	println("------------------------------");
}

function printStartGameOptions(){
	printMenuHeader("Welcome to the Wrestling Robots game menu:");
	println( "Option 1: Start a game");
	println("Option 2: Exit");
}

/**
 * @param $playerNo
 */
function printRobotOptions($playerNo){
	printMenuHeader("Player $playerNo, please configure your robot:");
	println("1. Block blocks 10 damage");
	println("2. Add +50 energy to robot");
	println("3. Add +10p to punch");
	println("4. Add +10p to kick");
	println("Please select 2 properties from the list displayed by entering when asked for input the numbers associated with the properties separated by comma (no spaces)");
}

/**
 * @param $playerNo
 */
function printMovesOptions($playerNo){
	printMenuHeader("Player $playerNo, please input moves for robot:");
	println("Moves:");
	println("0. Idle");
	println("1. Punch");
	println("2. Kick");
	println("3. Block");
	println("Please select 3 moves from the list displayed by entering when asked for input the numbers associated with the properties separated by comma (no spaces)");
}

function printStartRoundText($roundIndex){

	println("\n\n------------------------------");
	println("------------------------------");
	println("STARTING ROUND $roundIndex");
	println("------------------------------");
	println("------------------------------");

}

function printHurtLogText($robot){
	println("\n------------------------------");

	$name = $robot->getName();
	println("Player $name has been hurt in the following ways:\n");

	$events = $robot->getHurtLog();
	for($i=0; $i<count($events); $i++){
		echo $events[$i];
	}

}

function printWinnerText($name){
	$name = "$name IS THE WINNER!!!!!!!!";
	$totalNoOfStars = 50;
	$noOfStarRows = 2;

	println("\n");

	print(str_repeat(str_repeat('*',$totalNoOfStars)."\n",$noOfStarRows));

	$noOfStarsOnEachSide = ($totalNoOfStars - strlen($name)-4)/2;
	print(str_repeat('*',$noOfStarsOnEachSide)."  $name  ".str_repeat('*',$noOfStarsOnEachSide));
	echo "\n";
	print(str_repeat(str_repeat('*',$totalNoOfStars)."\n",$noOfStarRows));
}
