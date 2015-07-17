<?php

namespace App\Tests\Api\User;

use \Phalcon\Security,

    \Rise\ApiTestCase,
    \Rise\Fixture\User as UserFixture,
    \Rise\Auth\Session,

    \App\Models\User;

/**
 * Class RegisterTest
 * @package App\Tests\Api\User
 */
class RegisterTest extends ApiTestCase {

    use TCommon;

    public function testMain() {
        $userFixture = (new UserFixture())
            ->getInstance('Create', 'Test');

        $response = $this->post('/user/register', $userFixture->toArray());
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['user']['name'], $userFixture->getName());
        $this->assertEquals($responsePayload['data']['user']['email'], $userFixture->getEmail());

        $tokenPayload = (new Session())->decode($responsePayload['data']['token']);
        $this->assertEquals($tokenPayload->id, $responsePayload['data']['user']['id']);

        /** @var boolean|User $createdUser */
        $createdUser = User::findFirstById($responsePayload['data']['user']['id']);
        $this->assertNotFalse($createdUser);
        $this->assertEquals($userFixture->getName(), $createdUser->getName());
        $this->assertEquals($userFixture->getEmail(), $createdUser->getEmail());
        $isValidPassword = (new Security())
            ->checkHash($userFixture->getPassword(), $createdUser->getPassword());
        $this->assertTrue($isValidPassword);
    }

}