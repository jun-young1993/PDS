<?php




use PHPUnit\Framework;
use PDS\HashTable\HashTable;

final class HashTableTest extends Framework\TestCase 
{
	public function testDefaults(): void
	{
		
		$hashTable = new HashTable();
		self::assertSame(32,$hashTable->getBucketLength());

		$hashTable2 = new HashTable(64);
		self::assertSame(64,$hashTable2->getBucketLength());
		
	}

	public function testHash(): void
	{
		$hashTable = new HashTable();
		self::assertSame(1,$hashTable->hash("A"));
		self::assertSame(1,$hashTable->hash("a"));
		self::assertSame(2,$hashTable->hash("B"));
		self::assertSame(2,$hashTable->hash("b"));
		self::assertSame(3,$hashTable->hash("C"));
		self::assertSame(3,$hashTable->hash("c"));
		self::assertSame(10,$hashTable->hash("abcd"));
		
		
		$hashTable2 = new HashTable(3);
		self::assertSame(1,$hashTable2->hash("a"));
		self::assertSame(2,$hashTable2->hash("b"));
		self::assertSame(0,$hashTable2->hash("c"));
		self::assertSame(1,$hashTable2->hash("d"));
		
	}

	public function testGetOrSetValue(): void
	{
		$hashTable = new HashTable();
		$key = 'foo';
		$testValue = 'bar';

		self::assertNull($hashTable->get($key));
		
		$hashTable->set($key,$testValue);
		self::assertSame($testValue, $hashTable->get($key));
	}

	public function testCollision(): void
	{
		$hashTable = new HashTable(3);
		$hashTable->set('a','a');
		self::assertSame('a',$hashTable->get('a'));
		$hashTable->set('d','d');
		self::assertSame('a',$hashTable->get('a'));
		self::assertSame('d',$hashTable->get('d'));
	}

	public function testHas(): void
	{
		$hashTable = new HashTable(3);
		$key = 'a';
		self::assertFalse($hashTable->has($key));
		$hashTable->set($key,'test');
		self::assertTrue($hashTable->has($key));
	}
	
}