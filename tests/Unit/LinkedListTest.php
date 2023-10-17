<?php

use PDS\Node\Node;
use PHPUnit\Framework;
use PDS\LinkedList\LinkedList;

final class LinkedListTest extends Framework\TestCase 
{
	public function testDefaults(): void
	{
		$linkedList = new LinkedList();
		self::assertFalse(false, $linkedList->isHead());
		self::assertTrue($linkedList->isNonHead());
		self::assertFalse($linkedList->isTail());
		self::assertTrue($linkedList->isNonTail());

		$firstValue = 'first value';
		self::assertInstanceOf(LinkedList::class, $linkedList->append($firstValue));
		
		self::assertTrue($linkedList->isHead());
		self::assertFalse($linkedList->isNonHead());
		self::assertTrue($linkedList->isTail());
		self::assertFalse($linkedList->isNonTail());

		$head = $linkedList->getHead();
		self::assertInstanceOf(Node::class, $head);
		self::assertSame($firstValue,$head->getValue());

		$tail = $linkedList->getTail();
		self::assertInstanceOf(Node::class, $tail);
		self::assertSame($firstValue,$head->getValue());

		$secondValue = 'second value';
		$linkedList->append($secondValue); // PDS\LinkedList\LinkedList
		$head = $linkedList->gethead();
		$tail = $linkedList->getTail();
		self::assertSame($firstValue,$head->getValue());
		self::assertSame($secondValue,$tail->getValue());
		

	}

	public function testHeadOrTailNode(): void
	{
		$firstValue = 'first value';
		$linkedList = new LinkedList();
		self::assertInstanceOf(LinkedList::class, $linkedList->append($firstValue));
		
		self::assertTrue($linkedList->isHead());
		self::assertFalse($linkedList->isNonHead());

		$head = $linkedList->getHead();
		self::assertInstanceOf(Node::class, $head);
		self::assertSame($firstValue,$head->getValue());

		
		$tail = $linkedList->getTail();
		self::assertInstanceOf(Node::class, $tail);
		self::assertSame($firstValue,$head->getValue());

		
		$secondValue = 'second value';
		$linkedList->append($secondValue); // PDS\LinkedList\LinkedList
		$head = $linkedList->gethead(); // first node
		$tail = $linkedList->getTail(); // second node
		self::assertSame($firstValue,$head->getValue());
		self::assertSame($secondValue,$tail->getValue());


		$thirdValue = 'third value';
		$linkedList->append($thirdValue); // PDS\LinkedList\LinkedList
		$head = $linkedList->gethead(); // first node
		$tail = $linkedList->getTail(); 
		self::assertSame($firstValue,$head->getValue());
		self::assertSame($thirdValue,$tail->getValue());


	}


	public function testPrependHeadOrTail(): void
	{
		$linkedList = new LinkedList();
		$headValue = 'head value';
		$linkedList->prepend($headValue);
		self::assertSame($headValue,$linkedList->getHead()->getValue());
		self::assertSame($headValue,$linkedList->getTail()->getValue());

		$head2Value = 'head2 value';
		$linkedList->prepend($head2Value);
		self::assertSame($head2Value,$linkedList->getHead()->getValue());
		self::assertSame($headValue,$linkedList->getTail()->getValue());
	}

	public function testPrependValue(): void
	{
		$linkedList = new LinkedList();
		$number3 = 3;
		$linkedList->prepend($number3);
		self::assertSame($number3,$linkedList->getHead()->getValue());

		$number2 = 2;
		$linkedList->prepend($number2);
		self::assertSame($number2,$linkedList->getHead()->getValue());
		self::assertSame($number3,$linkedList->getHead()->getNextNode()->getValue());


		$number1 = 1;
		$linkedList->prepend($number1);
		self::assertSame($number1,$linkedList->getHead()->getValue());
		self::assertSame($number2,$linkedList->getHead()->getNextNode()->getValue());
		self::assertSame($number3,$linkedList->getHead()->getNextNode()->getNextNode()->getValue());

	}


	public function testGetHeadOrNull(): void
	{
		$linkedList = new LinkedList();
		
		self::assertNull($linkedList->getHeadOrNull());

		$number3 = 3;
		$linkedList->prepend($number3);
		self::assertInstanceOf(Node::class,$linkedList->getHeadOrNull());
	}

	public function testGetTailOrNull(): void
	{
		$linkedList = new LinkedList();
		
		self::assertNull($linkedList->getTailOrNull());

		$number3 = 3;
		$linkedList->prepend($number3);
		self::assertInstanceOf(Node::class,$linkedList->getTailOrNull());
	}

	public function testFindNode(): void
	{
		$linkedList = new LinkedList();
		$linkedList->append(1);
		$linkedList->append(2);
		$linkedList->append(3);
		$linkedList->append(100);
		$linkedList->append(1000);
		self::assertSame(1000,$linkedList->find(1000)->getValue());
		self::assertSame(100,$linkedList->find(100)->getValue());
		self::assertNull($linkedList->find(200));
		

	}

	
	public function testFindCallbackNode(): void
	{
		$linkedList = new LinkedList();
		$findValue1 = 1000;
		$linkedList->append(1);
		$linkedList->append(2);
		$linkedList->append(3);
		$linkedList->append(100);
		$linkedList->append($findValue1);
		
		self::assertSame(1000,$linkedList->find(function($value) use ($findValue1){
			return $value->getValue() === $findValue1;
		})->getValue());
		self::assertSame(100,$linkedList->find(function($value){
			return $value->getValue() === 100;
		})->getValue());
		self::assertNull($linkedList->find(function($value) {
			return $value->getValue() === 200;
		}));
		

	}
	
}