<?php

namespace Rise\Fixture;

use \Generator,

    \Rise\Fixture,

    \App\Models\User as UserModel;

/**
 * Class Fixture
 * @package Rise
 */
class User extends Fixture {

    /**
     * @return array
     */
    public function getFirstNames() {
        return ['Jackson', 'Emma', 'Lucas', 'Sophia', 'Oliver', 'Emily'];
    }

    /**
     * @return array
     */
    public function getLastNames() {
        return ['Smith', 'Williams', 'Brown', 'Jones', 'Miller', 'Wilson'];
    }

    /**
     * @return mixed
     */
    public function getFirstName() {
        return $this->getRandomValue($this->getFirstNames());
    }

    /**
     * @return mixed
     */
    public function getLastName() {
        return $this->getRandomValue($this->getLastNames());
    }

    /**
     * @param null|string $firstName
     * @param null|string $lastName
     * @return UserModel
     */
    public function getInstance($firstName = null, $lastName = null) {
        return (new UserModel())
            ->assign($this->getArray($firstName, $lastName));
    }

    /**
     * @param null|string $firstName
     * @param null|string $lastName
     * @return array
     */
    public function getArray($firstName = null, $lastName = null) {
        $firstName = $firstName ? $firstName : self::getFirstName();
        $lastName = $lastName ? $lastName : self::getLastName();
        $name = $firstName . ' ' . $lastName;
        $email = strtolower($firstName) . '.' . strtolower($lastName) . '@mail.com';

        return [
            'name' => $name,
            'email' => $email,
            'password' => $name
        ];
    }

    /**
     * @param int $number
     * @return Generator
     */
    public function getCollection($number = 5) {
        while ($number > 0) {
            $number--;
            yield self::getInstance();
        }
    }

}