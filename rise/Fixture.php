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
     * @param null $firstName
     * @param null $lastName
     * @return mixed
     */
    public abstract function getInstance($firstName = null, $lastName = null);

    /**
     * @param null|string $firstName
     * @param null|string $lastName
     * @return array
     */
    public abstract function getArray($firstName = null, $lastName = null);

    /**
     * @param int $number
     * @return mixed
     */
    public abstract function getCollection($number = 5);

}