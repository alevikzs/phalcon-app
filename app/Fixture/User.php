<?php

namespace App\Fixture;

use \ArrayIterator,

    \Rise\Fixture,

    \App\Models\User as UserModel;

/**
 * Class Fixture
 * @package App\Fixture
 */
class User extends Fixture {

    /**
     * @return array
     */
    public function getNames() {
        return [
            'Emma Williams', 'Lucas Brown', 'Sophia Jones', 'Oliver Miller', 'Emily Wilson', 'Lucas Brown',
            'Sophia Smith', 'Oliver Williams', 'Lucas Miller', 'Lucas Brown'
        ];
    }

    /**
     * @param null|string $name
     * @return UserModel
     */
    public function getInstance($name) {
        return (new UserModel())
            ->assign($this->getArray($name));
    }

    /**
     * @param string $name
     * @return array
     */
    public function getArray($name) {
        $email = strtolower(str_replace(' ', '.', $name)) . '@mail.com';

        return [
            'name' => $name,
            'email' => $email,
            'password' => $name
        ];
    }

    /**
     * @return ArrayIterator
     */
    public function getCollection() {
        $iterator = new ArrayIterator();

        foreach ($this->getNames() as $name) {
            $iterator->append($this->getInstance($name));
        }

        return $iterator;
    }

}