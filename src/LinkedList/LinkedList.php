<?php

namespace PDS\LinkedList;

use PDS\Comparator;
use PDS\Node\Node;

class LinkedList {
	private $head;
	private $tail;
	private $compare;
	public function __construct($compareFunction = null)
	{
		$this->head = null;
		$this->tail = null;
		$this->compare = new Comparator($compareFunction);
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

	public function getHeadOrNull(): ?Node 
	{
		if($this->isNonHead()){
			return null;
		}

		return $this->getHead();
	}

	public function getTailOrNull(): ?Node 
	{
		if($this->isNonTail()){
			return null;
		}

		return $this->getTail();
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

	/**
	 * Undocumented function
	 *
	 * @param callable|mixed $value
	 * 
	 * @return Node|null
	 */
	public function find($value): ?Node
	{
		$node = $this->getHeadOrNull();

		while($node instanceof Node){	
			if(is_callable($value) && $value($node)){
				return $node;
			}
			if(!is_callable($value) && isset($value) && $this->compare->equal($value,$node->getValue())){
				break;
			}
			$node = $node->getNextNode();
		}

		return $node;

	}
}

?>