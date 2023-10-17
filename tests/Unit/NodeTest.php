<?php



use PDS\Node\Node;
use PHPUnit\Framework;

final class NodeTest extends Framework\TestCase 
{
	public function testDefaults(): void
	{
		$node = new Node();
		self::assertSame(null, $node->getValue());
		self::assertSame(null, $node->getNextNode());
	}

	public function testNodeValue(): void 
	{
		$node1Value = 'node1';
		$node1 = new Node($node1Value);
		self::assertSame($node1Value, $node1->getValue());

		self::assertNull($node1->getNextNode());

		$node2Value = 'node2';
		$node2 = new Node($node2Value);
		$node1->setNextNode($node2);
		self::assertSame($node2Value,$node1->getNextNode()->getValue());

	}


	public function testNodeNextValue(): void 
	{
		$node1Value = 'node1';
		$node1 = new Node($node1Value);

		$node2Value = 'node2';
		$node2 = new Node($node2Value,$node1);

		$node3Value = 'node3';
		$node3 = new Node($node3Value,$node2);
		self::assertSame($node3Value, $node3->getValue());
		self::assertSame($node2Value, $node3->getNextNode()->getValue());
		self::assertSame($node1Value, $node3->getNextNode()->getNextNode()->getValue());
		

	}
	
	
}