<?php
namespace PDS\Node\NodeItem;
class NodeItem {
	private $key;
	private $value;
	public function __construct(?string $key, $value)
	{
		$this->key = $key;
		$this->value = $value;
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Undocumented function
	 *
	 * @param [type] $value
	 * @return void
	 */
	public function setValue($value): void
	{
		$this->value = $value;
	}
	
	public function equalKey(string $key){
		return $this->key === $key;
	}
}