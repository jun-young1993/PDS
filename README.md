# PDS
php data structure

### Node
---
```shell
$ composer test tests/Unit/NodeTest
```
```php
use PDS\Node\Node;

$node1Value = 'node1';
$node1 = new Node($node1Value);

$node2Value = 'node2';
$node2 = new Node($node2Value,$node1);

$node3Value = 'node3';
$node3 = new Node($node3Value,$node2);

$node3->getValue(); // node3
$node3->getNextNode()->getValue(); // node2
$lastNode = $node3->getNextNode()->getNextNode()->getValue(); //node1


// set next node
$lastNode->getNextNode(); // nul
$node4Value = 'node2';
$node4 = new Node($node4Value);
$node1->setNextNode($node4);
$node1->getNextNode()->getValue(); //node2

```

### LinkedList
---
```shell
$ composer test tests/Unit/LinkedList
```
```php
use PDS\LinkedList\LinkedList;

$linkedList = new LinkedList();

$linkedList->isHead(); // false
$linkedList->isNonHead(); // true

$firstValue = 'first value';
$linkedList->append($firstValue); // PDS\LinkedList\LinkedList

$haed = $linkedList->getHead(); // PDS\Node\Node
$head->getValue(); // 'first value';

$tail = $linkedList->getTail(); // PDS\Node\Node
$tail->getValue(); // 'first value';


/**
 * append
 */
$secondValue = 'second value';
$linkedList->append($secondValue); // PDS\LinkedList\LinkedList
$head = $linkedList->gethead(); // PDS\Node\Node
$tail = $linkedList->getTail(); // PDS\Node\Node
$head->getValue(); //first value 
$tail->getValue(); // second value

$thirdValue = 'thirdValue';
$linkedList->append($thirdValue); // PDS\LinkedList\LinkedList
$head = $linkedList->gethead();  // PDS\Node\Node
$tail = $linkedList->getTail(); // PDS\Node\Node
$head->getValue(); //first value 
$tail->getValue(); // third value

/**
 * prepend
 */
$linkedList = new LinkedList();
$number3 = 3;
$linkedList->prepend($number3);
$linkedList->getHead()->getValue(); // 3

$number2 = 2;
$linkedList->prepend($number2);
$linkedList->getHead()->getValue(); //2
$linkedList->getHead()->getNextNode()->getValue(); // 3


$number1 = 1;
$linkedList->prepend($number1);
$linkedList->getHead()->getValue(); // 1
$linkedList->getHead()->getNextNode()->getValue(); // 2
$linkedList->getHead()->getNextNode()->getNextNode()->getValue();// 3


```
