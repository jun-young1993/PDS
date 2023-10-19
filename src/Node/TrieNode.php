<?php

use PDS\HashTable\HashTable;
use PDS\Exceptions\InvalidInstanceException;

class TrieNode {
	private $children;
	private $character;
	private $isCompleteWord;
	public function __construct(string $character, bool $isCompleteWord = false)
	{
		$this->isCompleteWord = $isCompleteWord;
		$this->character = $character;
		$this->children = new HashTable();
		
	}

	public function isCompleteWord(): bool
	{
		return $this->isCompleteWord;
	}

	public function getCharacter(): string 
	{
		return $this->character;
	}

	public function toString(): string {
		return $this->getCharacter();
	}

	/**
	 * Undocumented function
	 *
	 * @return HashTable
	 */
	private function getChildren(): HashTable
	{
		return $this->children;
	}

	/**
	 * Undocumented function
	 *
	 * @param string $character
	 * @return string
	 */
	public function getChild(string $character)
	{
		return $this->getChildren()->get($character);
	}

	/**
	 * Undocumented function
	 *
	 * @param string $character
	 * @return boolean
	 */
	public function hasChild(string $character): bool
	{
		return $this->getChildren()->has($character);
	}

	public function addChild(string $character, $isCompleteWord = false) 
	{
		if(!$this->hasChild($character)){
			$this->getChildren()->set($character, new TrieNode($character, $isCompleteWord));
		}

		$childNode = $this->getChildren()->get($character);
		if(!$childNode instanceof TrieNode){
			throw new InvalidInstanceException($childNode,TrieNode::class);
		}
		$childNode->isCompleteWord = $childNode->isCompleteWord || $isCompleteWord;

		return $childNode;
	}
}