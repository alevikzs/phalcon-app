<?php

namespace App\Tests\Api\Login;

use \Rise\ApiTestCase,
    \Rise\Auth\Session,

    \App\Models\User,
    \App\Tests\Api\TUserStab;

/**
 * Class InnerTest
 * @package App\Tests\Api\Login
 */
class InnerTest extends ApiTestCase {

    use TUserStab;

    public function testMain() {
        /** @var User $userFixture */
        $userFixture = $this->getStub()->offsetGet(0);

        $requestPayload = [
            'email' => $userFixture->getEmail(),
            'password' => $userFixture->getName()
        ];

        $response = $this->post('/login/inner', $requestPayload);
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['user']['id'], $userFixture->getId());
        $this->assertEquals($responsePayload['data']['user']['name'], $userFixture->getName());
        $this->assertEquals($responsePayload['data']['user']['email'], $userFixture->getEmail());

        $tokenPayload = (new Session())->decode($responsePayload['data']['token']);
        $this->assertEquals($tokenPayload->id, $responsePayload['data']['user']['id']);
    }

    public function testWrongPassword() {
        /** @var User $userFixture */
        $userFixture = $this->getStub()->offsetGet(0);

        $requestPayload = [
            'email' => $userFixture->getEmail(),
            'password' => 'wrong password'
        ];

        $response = $this->post('/login/inner', $requestPayload);
        $responsePayload = $response->json();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertFalse($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['message'], 'Wrong password');
    }

    public function testUserNotFound() {
        $requestPayload = [
            'email' => 'user.not.found@email.com',
            'password' => 'wrong password'
        ];

        $response = $this->post('/login/inner', $requestPayload);
        $responsePayload = $response->json();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertFalse($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['message'], 'User not found');
    }

}