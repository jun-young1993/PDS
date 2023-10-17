<?php

namespace PDS\HashTable;

use PDS\Node\Node;

use PDS\LinkedList\LinkedList;
use PDS\Node\NodeItem\NodeItem;
use PDS\Exceptions\NotFoundKeyException;



class HashTable {
	private $buckets;
	private $keys;

	public function __construct(int $defaultHashTableSize = 32)
	{
		$this->buckets = $this->makeBuckets($defaultHashTableSize);
		$this->keys = [];

	}

	public function getBucketLength(): int {
		$buckets = empty($this->buckets) ? [] : $this->buckets;
		return count($buckets);
	}

	/**
	 * initial buckets setting
	 *
	 * @param integer $length
	 * @return void
	 */
	private function makeBuckets(int $length): array
	{

		$fillArray = [];
		for($index = 0; $index<$length; $index++){
			$fillArray[] = new LinkedList();
		}
		
		return $fillArray;
	}

	/**
	 * hash
	 *
	 * @param string $key
	 * @return integer
	 */
	public function hash(string $key) : int
	{
		$initCode = 0;
		foreach(str_split($key) as $keySymbol) {
			$initCode += ord($keySymbol);
		};
		return $initCode%$this->getBucketLength();
	}

	private function setkey(String $key, int $hash): void
	{
		$this->keys[$key] = $hash;
		
	}

	private function getHashByKey(String $key): int
	{  
		if(!array_key_exists($key,$this->keys)){
			$hash = $this->hash($key);
			$this->setKey($key, $hash);
		}
		return $this->keys[$key];
	}

	private function getBucket(int $hash): LinkedList
	{
		return $this->buckets[$hash];
	}

	/**
	 * Undocumented function
	 *
	 * @param string $key
	 * @return Node|null
	 */
	private function getNodeByBucketKey(string $key): ?Node
	{
		$linkedList = $this->getBucket($this->getHashByKey($key));
		
		$node = $linkedList->find(function($node) use($key) {
			if($node instanceof Node && $node->getValue() instanceof NodeItem) {
				return $node->getValue()->equalKey($key);
			}
		});
		return $node;
	}

	public function getNodeItemByBucketKey(string $key): NodeItem
	{
		$node = $this->getNodeByBucketKey($key);
		if(is_null($node)){
			$nodeItem = new NodeItem(null, null);
		}else{
			$nodeItem = $node->getValue();
		}
		return $nodeItem;
	}

	
	/**
	 * set value
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	public function set(string $key, $value): void
	{
		$hash = $this->hash($key);
		$this->setkey($key,$hash);
		$linkedList = $this->getBucket($hash);
		$node = $this->getNodeByBucketKey($key);

		if(is_null($node)){
			$linkedList->append(new NodeItem($key, $value));
		}else{
			$this->getNodeItemByBucketKey($key)->setValue($value);
		}

	}

	/**
	 * Undocumented function
	 *
	 * @param string $key
	 * @return void
	 */
	public function get(string $key)
	{
		
		$node = $this->getNodeByBucketKey($key);
		if(is_null($node)){
			return null;
		}
		return $this->getNodeItemByBucketKey($key)->getValue();
	}

	
	
}