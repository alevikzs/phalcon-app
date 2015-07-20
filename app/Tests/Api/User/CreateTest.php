<?php

namespace App\Tests\Api\User;

use \Phalcon\Security,

    \Rise\ApiTestCase,

    \App\Fixture\User as UserFixture,
    \App\Models\User;

/**
 * Class CreateTest
 * @package App\Tests\Api\User
 */
class CreateTest extends ApiTestCase {

    use TCommon;

    public function testMain() {
        $userFixture = (new UserFixture())
            ->getInstance('Create Test');

        $response = $this->post('/user', $userFixture->toArray());
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['name'], $userFixture->getName());
        $this->assertEquals($responsePayload['data']['email'], $userFixture->getEmail());

        /** @var boolean|User $createdUser */
        $createdUser = User::findFirstById($responsePayload['data']['id']);
        $this->assertNotFalse($createdUser);
        $this->assertEquals($userFixture->getName(), $createdUser->getName());
        $this->assertEquals($userFixture->getEmail(), $createdUser->getEmail());
        $isValidPassword = (new Security())
            ->checkHash($userFixture->getPassword(), $createdUser->getPassword());
        $this->assertTrue($isValidPassword);
    }

}