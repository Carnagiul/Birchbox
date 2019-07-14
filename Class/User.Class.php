<?php

Class User
{
	private $name;
	private $age;

	public function __construct()
	{

	}

	public function __destruct()
	{

	}

	public function toJSON()
	{
		return (json_encode($this->toArray()));
	}

	public function toArray(): array
	{
		$ret = null;
		$ret["name"] = $this->name;
		$ret["age"] = $this->age;

		return ($ret);
	}

	public function setName($name): self
	{
		$this->name = $name;
		return ($this);
	}

	public function getName(): String
	{
		return ($this->name);
	}

	public function setAge($age): self
	{
		$this->age = $age;
		return ($this);
	}

	public function getAge(): int 
	{
		return (intval($this->age));
	}
}

?>