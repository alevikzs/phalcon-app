<?php

namespace Rise;

/**
 * Class Fixture
 * @package Rise
 */
abstract class Fixture {

    /**
     * @param array $list
     * @return mixed
     */
    public function getRandomValue(array $list) {
        $randomIndex = rand(0, count($list) - 1);

        return $list[$randomIndex];
    }

    /**
     * @return mixed
     */
    public abstract function getInstance();

    /**
     * @return array
     */
    public abstract function getArray();

    /**
     * @param int $number
     * @return mixed
     */
    public abstract function getCollection($number = 5);

}