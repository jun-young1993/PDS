<?php




use PHPUnit\Framework;
use PDS\HashTable\HashTable;

final class TrieNodeTest extends Framework\TestCase 
{
	public function testDefaults(): void
	{
		$value = 'root';
		$node = new TrieNode($value);
		
		self::assertSame($value, $node->getCharacter());
		self::assertFalse($node->isCompleteWord());
		
	}


}