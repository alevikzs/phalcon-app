<?php

namespace Rise\Tests\Unit;

use \PHPUnit_Framework_TestCase as TestCase,

    \Rise\RequestPayload\Collection,
    \Rise\RequestPayload\Collection\Order,
    \Rise\Mapper;

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

       $json = json_decode(json_encode($object));

       $objectMapped = (new Mapper\Object($json, $class))
           ->map();

       $this->assertEquals($objectMapped, $object);
   }

}