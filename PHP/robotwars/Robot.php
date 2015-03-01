<?php

include_once "RobotMove.php";
include_once "Utils.php";


/**
 * Class Robot
 */
class Robot {


	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var int
	 */
	private $energy = 100;
	/**
	 * @var $myMoves RobotMove[]
	 */
	private $myMoves = array();

	/**
	 * @var $moveList int[]
	 */
	private $moveList = array();

	/**
	 * @var int
	 */
	private $currentMoveIndex = 0;


	/**
	 * @var $hurtLog = RobotMove[]
	 */
	private $hurtLog = array();



	public function addToHurtLog($move){
		$this->hurtLog[] = $move;
	}


	/**
	 * @param $name
	 * @param $options
	 */
	public function __construct($name, $options){

		$this->name = $name;

		$this->myMoves[] = new RobotMove("Idle", 0, 0, 0, 10);
		$this->myMoves[] = new RobotMove("Punch", 10, 0, 10, 0);
		$this->myMoves[] = new RobotMove("Kick", 20, 0, 15, 0);
		$this->myMoves[] = new RobotMove("Block", 0, 5, 5, 0);


		foreach($options as $option){
			switch($option){
				case 1:
					$this->myMoves[3]->setSoftenBlow(10);
					break;
				case 2:
					$this->addEnergy(50);
					break;
				case 3:
					$this->myMoves[1]->addDamage(10);
					break;
				case 4:
					$this->myMoves[2]->addDamage(10);
					break;
				default:
					break;
			}
		}
	}

	/**
	 *
	 */
	public function __toString()
	{
		$energy = $this->energy;
		$moveList = join(',', $this->moveList);
		$myMoves = join(',', $this->myMoves);

		return "{ Name =$this->name,\n Energy = $energy,\n Movelist = $moveList,\n My moves = $myMoves,\n Index=$this->currentMoveIndex} ";
	}

	/**
	 * @param $qty
	 */
	public function addEnergy($qty){
		$this->energy+=$qty;
	}

	/**
	 * @param $qty
	 */
	public function decreaseEnergy($qty){
		$this->energy-=$qty;
	}

	/**
	 * Pushes moves in move list
	 * @param $moveList
	 */
	public function addMovesInMoveList($moveList){
		for($i=0;$i<3;$i++){
			$this->moveList[] = $moveList[$i];
		}
//		array_push($moveList, $this->moveList);
	}

	/**
	 * @return RobotMove
	 */
	public function getCurrentMove(){
		$moveIndex = $this->moveList[$this->currentMoveIndex];
		return $this->myMoves[$moveIndex];
	}

	/**
	 *
	 */
	public function doneMove(){
		$this->currentMoveIndex++;
	}

	/**
	 * @return bool
	 */
	public function isNotDead(){
		return $this->energy > 0;
	}

	/**
	 * @return bool
	 */
	public function hasMoreMoves(){
		return $this->currentMoveIndex<count($this->moveList)-1;
	}

	/**
	 *
	 */
	public function forceDoIdle(){
		$this->addEnergy($this->myMoves[0]->getRecoveredEnergy());
	}


	/**
	 * @param $robot
	 */
	public function inflictMove($robot){

		$move = $this->getCurrentMove();
		$moveName = $move->getName();
		$robotName = $robot->getName();

		if($this->getEnergy() - $move->getCost() <=0 ){
			println("Move $moveName would kill robot $robotName due to move cost. Move not possible. Robot will idle now");
			$this->forceDoIdle();
			$robot->addToHurtLog($this->myMoves[0]);

		}else{
			$this->decreaseEnergy($move->getCost());

			$move->decreaseDamage($robot->getCurrentMove()->getSoftenBlow());

			$robot->decreaseEnergy($move->getDamage());

			$this->addEnergy($move->getRecoveredEnergy());

			$robot->addToHurtLog($move);
		}


		$this->doneMove();
	}







//	-------------------------------------------------- Getters and Setters -------------------------------------------


	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getEnergy()
	{
		return $this->energy;
	}

	/**
	 * @param int $energy
	 */
	public function setEnergy($energy)
	{
		$this->energy = $energy;
	}

	/**
	 * @return RobotMove[]
	 */
	public function getMyMoves()
	{
		return $this->myMoves;
	}

	/**
	 * @param RobotMove[] $myMoves
	 */
	public function setMyMoves($myMoves)
	{
		$this->myMoves = $myMoves;
	}

	/**
	 * @return int[]
	 */
	public function getMoveList()
	{
		return $this->moveList;
	}

	/**
	 * @param int[] $moveList
	 */
	public function setMoveList($moveList)
	{
		$this->moveList = $moveList;
	}

	/**
	 * @return int
	 */
	public function getCurrentMoveIndex()
	{
		return $this->currentMoveIndex;
	}

	/**
	 * @param int $currentMoveIndex
	 */
	public function setCurrentMoveIndex($currentMoveIndex)
	{
		$this->currentMoveIndex = $currentMoveIndex;
	}

	/**
	 * @return mixed
	 */
	public function getHurtLog()
	{
		return $this->hurtLog;
	}

	/**
	 * @param mixed $hurtLog
	 */
	public function setHurtLog($hurtLog)
	{
		$this->hurtLog = $hurtLog;
	}







}