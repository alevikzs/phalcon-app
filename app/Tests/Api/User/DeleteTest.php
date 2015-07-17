<?php

namespace App\Tests\Api\User;

use \Rise\ApiTestCase,

    \App\Models\User;

/**
 * Class DeleteTest
 * @package App\Tests\Api\User
 */
class DeleteTest extends ApiTestCase {

    use TCommon;

    public function testMain() {
        /** @var User $userToDelete */
        $userToDelete = $this->getStub()->offsetGet(0);

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

    public function testNotFound() {
        $notFoundId = User::getNextId();
        $response = $this->delete('/user/' . $notFoundId);
        $responsePayload = $response->json();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals($responsePayload['data']['message'], 'User not found');
        $this->assertFalse($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
    }

}