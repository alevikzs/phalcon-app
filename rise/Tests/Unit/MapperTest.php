<?php

namespace Rise\Tests\Unit;

use \stdClass,
    \PHPUnit_Framework_TestCase as TestCase,

    \Rise\Dummy\Tree,
    \Rise\Dummy\Branch,
    \Rise\Dummy\Leaf,
    \Rise\Mapper\Object,
    \Rise\Mapper\Object\Json;

/**
 * Class MapperTest
 * @package Rise\Tests\Unit
 */
class MapperTest extends TestCase {

    /**
     * @var Tree
     */
    private static $tree;

    /**
     * @return Tree
     */
    private static function getTree() {
        if (!self::$tree) {
            self::$tree = new Tree(2, 'Pear', new Branch( 1, [new Leaf(2, 3), new Leaf(1, 2)]));
        }

        return self::$tree;
    }

    public function testMain() {
        $class = '\Rise\Dummy\Tree';

        $object = self::getTree();

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

        $class = '\Rise\Dummy\Tree';

        $object = self::getTree();

        $jsonObject = json_decode(json_encode($object));

        $height = new stdClass();
        $height->foo = 1;
        $height->bar = 2;

        $jsonObject->height = $height;

        (new Object($jsonObject, $class))
            ->map();
    }

    public function testMustBeArrayException() {
        $this->setExpectedException('\Rise\Mapper\Exception\MustBeArray');

        $class = '\Rise\Dummy\Tree';

        $object = self::getTree();

        $jsonObject = json_decode(json_encode($object));


        $jsonObject->branch->leaves = new stdClass();

        (new Object($jsonObject, $class))
            ->map();
    }

    public function testMustBeObjectException() {
        $this->setExpectedException('\Rise\Mapper\Exception\MustBeObject');

        $class = '\Rise\Dummy\Tree';

        $object = self::getTree();

        $jsonObject = json_decode(json_encode($object));

        $jsonObject->branch = 1;

        (new Object($jsonObject, $class))
            ->map();
    }

    public function testUnknownFieldException() {
        $this->setExpectedException('\Rise\Mapper\Exception\UnknownField');

        $class = '\Rise\Dummy\Tree';

        $object = self::getTree();

        $jsonObject = json_decode(json_encode($object));

        $jsonObject->foo = 1;

        (new Object($jsonObject, $class))
            ->map();
    }

}