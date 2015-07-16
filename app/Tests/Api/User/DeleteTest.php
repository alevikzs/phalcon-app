<?php

namespace App\Tests\Api;

use \Rise\ApiTestCase,
    \Rise\Fixture\User as UserFixture,

    \App\Models\User;

/**
 * Class DeleteTest
 * @package App\Tests
 */
class DeleteTest extends ApiTestCase {

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

    public function testMain() {
        /** @var User $userToDelete */
        $userToDelete = User::findFirst();

        $response = $this->delete('/user/' . $userToDelete->getId());
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['id'], $userToDelete->getId());
        $this->assertEquals($responsePayload['data']['name'], $userToDelete->getName());
        $this->assertEquals($responsePayload['data']['email'], $userToDelete->getEmail());

        /** @var User|boolean $deletedUser */
        $deletedUser = User::findFirstById($userToDelete->getId());
        $this->assertFalse($deletedUser);
    }

}