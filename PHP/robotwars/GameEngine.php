<?php

include "Utils.php";
include_once "Robot.php";

/**
 * Class GameEngine
 */
class GameEngine {

	/** @var $first_robot Robot */
	private $first_robot;
	/** @var $second_robot Robot */
	private $second_robot;

	/**
	 * @var int
	 */
	private $coinTossWinner = 0;


	function __construct() {
		$this->startingMenu();

		$this->coinTossWinner = coinToss();

		$this->robotCreatorMenu(1);
		$this->robotCreatorMenu(2);

		$roundNumber = 1;
		while($this->first_robot->isNotDead() and $this->second_robot->isNotDead()){
			$this->doRound($roundNumber);
			$roundNumber++;
		}

		if($this->first_robot->isNotDead()){
			printWinnerText($this->first_robot->getName());
		}else{
			printWinnerText($this->second_robot->getName());
		}


		printHurtLogText($this->first_robot);
		printHurtLogText($this->second_robot);

	}

	/**
	 * @param $which
	 * @return Robot
	 */
	private function getRobot($which){
		if($which == "first"){
			switch($this->coinTossWinner){
				case 0:
					return $this->first_robot;
				default:
					return $this->second_robot;
			}
		}else{
			switch($this->coinTossWinner){
				case 0:
					return $this->second_robot;
				default:
					return $this->first_robot;
			}
		}
	}


// ---------------------- Starting menu ---------------------------

	private function startingMenu(){
		printStartGameOptions();
		$line = readUserInput("Input: ");
		if($line != '1'){
			println("ABORTING!\n");
			exit;
		}

		println("Thank you, continuing...");
		println("Initiating game......");
	}

// ---------------------- Robot customization ---------------------------

	/**
	 * @param $playerNo
	 */
	function robotCreatorMenu($playerNo){
		do{
			printRobotOptions($playerNo);
			$input = readUserInput("Input robot options: ");
		}while(!validateUserInput($input, 2, range(1,4)));

		println("ROBOT CONFIGURED!!!!!!!!!!");

		if($playerNo == 1){
			$this->first_robot = new Robot("Player $playerNo", explode(",", $input));
		}else{
			$this->second_robot = new Robot("Player $playerNo", explode(",", $input));
		}

	}



// ---------------------- Round .. Fight ---------------------------

	/**
	 * @param $playerNo
	 */
	private function inputRobotMovesMenu($playerNo){
		do{
			printMovesOptions($playerNo);
			$input = readUserInput("Input robot moves: ");
		}while(!validateUserInput($input, 3, range(0,3)));

		println("Moves accepted!!");

		if($playerNo == 1){
			$this->first_robot->addMovesInMoveList(explode(",", $input));
		}else{
			$this->second_robot->addMovesInMoveList(explode(",", $input));
		}

	}

	/**
	 * @param $roundIndex
	 */
	private function doRound($roundIndex){

		$fRobot = $this->getRobot("first");
		$lRobot = $this->getRobot("second");

		printStartRoundText($roundIndex);

		$this->inputRobotMovesMenu(1);
		$this->inputRobotMovesMenu(2);

		while($fRobot->isNotDead() and $fRobot->hasMoreMoves()){
			$fRobot->inflictMove($lRobot);

			if($lRobot->isNotDead()){
				$lRobot->inflictMove($fRobot);
			}else{
				return;
			}
		}

		$this->printRoundScore();

	}

	private function printRoundScore(){
		$fRobot = $this->first_robot;
		$lRobot = $this->second_robot;
		println("\n".$fRobot->getName().'   |   '.$lRobot->getName());
		$noOfSpaces = strlen($fRobot->getName())-strlen($fRobot->getEnergy());
		println(str_repeat(' ',$noOfSpaces ).$fRobot->getEnergy().'   |   '.$lRobot->getEnergy());
	}


}

$gameEngine = new GameEngine();
