<?php

namespace Rise\Tests\Unit;

use \stdClass,
    \PHPUnit_Framework_TestCase as TestCase,

    \Rise\RequestPayload\Collection,
    \Rise\RequestPayload\Collection\Order,
    \Rise\Mapper\Object,
    \Rise\Mapper\Object\Json;

/**
 * Class MapperTest
 * @package Rise\Tests\Unit
 */
class MapperTest extends TestCase {

   public function testMain() {
       $class = '\Rise\RequestPayload\Collection';

       $object = new Collection(30, 2, [
           new Order('some0', 0),
           new Order('some1', 1)
       ]);

       $jsonString = json_encode($object);
       $jsonObject = json_decode($jsonString);

       $objectMapped = (new Json($jsonString, $class))
           ->map();
       $this->assertEquals($objectMapped, $object);

       $objectMapped = (new Object($jsonObject, $class))
           ->map();
       $this->assertEquals($objectMapped, $object);
   }

    public function testMustBeSimpleException() {
        $this->setExpectedException('\Rise\Mapper\Exception\MustBeSimple');

        $class = '\Rise\RequestPayload\Collection';

        $object = new Collection(30, 2, [
            new Order('some0', 0),
            new Order('some1', 1)
        ]);

        $jsonObject = json_decode(json_encode($object));

        $limit = new stdClass();
        $limit->foo = 1;
        $limit->bar = 2;

        $jsonObject->limit = $limit;

        (new Object($jsonObject, $class))
            ->map();
    }

    public function testMustBeObjectException() {
        $this->setExpectedException('\Rise\Mapper\Exception\MustBeObject');
    }

    public function testMustBeArrayException() {
        $this->setExpectedException('\Rise\Mapper\Exception\MustBeArray');
    }

    public function testUnknownFieldException() {
        $this->setExpectedException('\Rise\Mapper\Exception\UnknownField');

        $class = '\Rise\RequestPayload\Collection';

        $object = new Collection(30, 2, [
            new Order('some0', 0),
            new Order('some1', 1)
        ]);

        $jsonObject = json_decode(json_encode($object));

        $jsonObject->foo = 1;

        (new Object($jsonObject, $class))
            ->map();
    }

}