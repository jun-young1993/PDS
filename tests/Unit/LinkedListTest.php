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
	
}