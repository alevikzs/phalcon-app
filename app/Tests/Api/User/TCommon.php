<?php

namespace App\Tests\Api\User;

use \ArrayIterator,

    \App\Fixture\User as UserFixture,
    \App\Models\User;

/**
 * Class TCommon
 * @package App\Tests\Api\User
 * @method ArrayIterator getStub()
 */
trait TCommon {

    protected function saveStub() {
        /** @var User $user */
        foreach ($this->getStub() as $user) {
            $user->save();
        }
    }

    protected function clearStub() {
        (new User())->truncate();
    }

    /**
     * @return array
     */
    protected function createStub() {
        return (new UserFixture())
            ->getCollection();
    }

}