<?php

namespace PDS\LinkedList;

use PDS\Node\Node;

class LinkedList {
	private $head = null;
	private $tail = null;
	public function __construct()
	{
		$this->head = null;
		$this->tail = null;
	}

	/**
	 * is head
	 *
	 * @return boolean
	 */
	public function isHead(): bool
	{
		return $this->getHead() === null ? false : true;
	}

	/**
	 * is non head
	 *
	 * @return boolean
	 */
	public function isNonHead(): bool 
	{
		return !$this->isHead();
	}

	/**
	 * is tail
	 *
	 * @return boolean
	 */
	public function isTail(): bool
	{
		return $this->getTail() === null ? false : true;
	}

	/**
	 * is non tail
	 *
	 * @return boolean
	 */
	public function isNonTail(): bool
	{
		return !$this->isTail();
	}


	/**
	 * prepend value
	 * insert at the first
	 * 
	 * @param mixed $value
	 * @return void
	 */
	public function prepend($value){
		$node = new Node($value,$this->getHead());
		$this->setHead($node);

		if($this->isNonTail()){
			$this->setTail($node);
		}

		return $this;
	}

	/**
	 * append value
	 * insert at the end
	 *
	 * @param mixed $value
	 * @return LinkedList
	 */
	public function append($value): LinkedList
	{
		$node = new Node($value);

		if($this->isNonHead()){
			$this->setHead($node);
			$this->setTail($node);
			return $this;
		}

		$this->getTail()->setNextNode($node);
		$this->setTail($node);
		
		return $this;
	}

	/**
	 * set head node
	 *
	 * @param Node $node
	 * @return Node
	 */
	private function setHead(Node $node): Node
	{
		return $this->head = $node;
	}

	/**
	 * set tail node
	 *
	 * @param Node $node
	 * @return Node
	 */
	private function setTail(Node $node): Node
	{
		return $this->tail = $node;
	}

	

	/**
	 * get head node
	 *
	 * @return Node|null
	 */
	public function getHead(): ?Node
	{
		return $this->head;
	}

	/**
	 * get tail node
	 *
	 * @return Node|null
	 */
	public function getTail(): ?Node
	{
		return $this->tail;
	}
}

?>