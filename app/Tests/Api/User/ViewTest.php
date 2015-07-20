<?php

namespace App\Tests\Api\User;

use \Rise\ApiTestCase,

    \App\Models\User;

/**
 * Class ViewTest
 * @package App\Tests\Api\User
 */
class ViewTest extends ApiTestCase {

    use TCommon;

    public function testMain() {
        /** @var User $userToView */
        $userToView = $this->getStub()->offsetGet(0);

        $response = $this->get('/user/' . $userToView->getId());
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['id'], $userToView->getId());
        $this->assertEquals($responsePayload['data']['name'], $userToView->getName());
        $this->assertEquals($responsePayload['data']['email'], $userToView->getEmail());
    }

    public function testNotFound() {
        $notFoundId = User::getNextId();
        $response = $this->get('/user/' . $notFoundId);
        $responsePayload = $response->json();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals($responsePayload['data']['message'], 'User not found');
        $this->assertFalse($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
    }

}