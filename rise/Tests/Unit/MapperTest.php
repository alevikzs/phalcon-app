<?php

namespace Rise\Tests\Unit;

use \PHPUnit_Framework_TestCase as TestCase,

    \Rise\RequestPayload\Collection,
    \Rise\RequestPayload\Collection\Order,
    \Rise\Mapper\Object,
    \Rise\Mapper\Object\Json;

/**
 * Class MapperTest
 * @package Rise\Tests\Unit
 */
class MapperTest extends TestCase {

   public function testMain()
   {
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

}