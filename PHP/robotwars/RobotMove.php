<?php

include_once "Utils.php";
/**
 * Class RobotMove
 */
class RobotMove{

	/**
	 * @var string
	 */
	private $name = "";

	/**
	 * @var int
	 */
	private $damage = 10;
	/**
	 * @var int
	 */
	private $softenBlow = 0;
	/**
	 * @var int
	 */
	private $cost = 10;

	/**
	 * @var int
	 */
	private $recoveredEnergy = 0;


	/**
	 * @param $name
	 * @param $damage
	 * @param $softenBlow
	 * @param $cost
	 * @param $recoveredEnergy
	 */
	function __construct($name, $damage, $softenBlow, $cost, $recoveredEnergy){
		$this->name = $name;
		$this->damage = $damage;
		$this->softenBlow = $softenBlow;
		$this->cost = $cost;
		$this->recoveredEnergy = $recoveredEnergy;
	}

	/**
	 * @return string
	 */
	function __toString(){
		return "{Name = $this->name,\n Damage = $this->damage,\n Bock = $this->softenBlow,\n Cost = $this->cost,\n RecoverEnergy = $this->recoveredEnergy} ";
	}

	/**
	 * @param int $damage
	 */
	public function addDamage($damage)
	{
		$this->damage += $damage;
	}

	/**
	 * @param int $damage
	 */
	public function decreaseDamage($damage)
	{
		$this->damage -= $damage;
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
	public function getDamage()
	{
		return $this->damage;
	}

	/**
	 * @param int $damage
	 */
	public function setDamage($damage)
	{
		$this->damage = $damage;
	}

	/**
	 * @return int
	 */
	public function getSoftenBlow()
	{
		return $this->softenBlow;
	}

	/**
	 * @param int $softenBlow
	 */
	public function setSoftenBlow($softenBlow)
	{
		$this->softenBlow = $softenBlow;
	}

	/**
	 * @return int
	 */
	public function getCost()
	{
		return $this->cost;
	}

	/**
	 * @param int $cost
	 */
	public function setCost($cost)
	{
		$this->cost = $cost;
	}

	/**
	 * @return int
	 */
	public function getRecoveredEnergy()
	{
		return $this->recoveredEnergy;
	}

	/**
	 * @param int $recoveredEnergy
	 */
	public function setRecoveredEnergy($recoveredEnergy)
	{
		$this->recoveredEnergy = $recoveredEnergy;
	}





}