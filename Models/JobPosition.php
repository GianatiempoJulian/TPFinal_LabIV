<?php 

	namespace Models;


class JobPosition{

		
	private $id;
	private $carrerId;
	private $description;


	
	public function __construct(){}

	

	/**
	 * Get the value of id
	 */ 
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of carrerId
	 */ 
	public function getCarrerId()
	{
		return $this->carrerId;
	}

	/**
	 * Set the value of carrerId
	 *
	 * @return  self
	 */ 
	public function setCarrerId($carrerId)
	{
		$this->carrerId = $carrerId;

		return $this;
	}

	/**
	 * Get the value of description
	 */ 
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set the value of description
	 *
	 * @return  self
	 */ 
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}
}

?>