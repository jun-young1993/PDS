<?php

namespace PDS\Node;

class Node {
	private $value;
	private $next;

	public function __construct($value = null, ?Node $next = null)
	{
		$this->value = $value;
		$this->next = $next;
	}

	/**
	 * get node value
	 *
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * set next node
	 *
	 * @return Node
	 */
	public function setNextNode(Node $node): Node
	{	
		return $this->next = $node;
	}

	/**
	 * get next node or null
	 *
	 * @return Node|null
	 */
	public function getNextNode(): ?Node
	{
		return $this->next;
	}
}

?>