<?php

namespace App\Tests\Api;

use \ArrayIterator,

    \App\Fixture\User as UserFixture,
    \App\Models\User;

/**
 * Class TUserStab
 * @package App\Tests\Api
 * @method ArrayIterator getStub()
 */
trait TUserStab {

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