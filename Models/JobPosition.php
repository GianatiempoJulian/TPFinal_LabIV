<?php 

	namespace Models;


class JobPosition{

		
	private $id;
	private $careerId;
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
	 * Get the value of careerId
	 */ 
	public function getCareerId()
	{
		return $this->careerId;
	}

	/**
	 * Set the value of careerId
	 *
	 * @return  self
	 */ 
	public function setCareerId($careerId)
	{
		$this->careerId = $careerId;

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