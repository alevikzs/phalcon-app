<?php

namespace App\Tests\Api\User;

use \Phalcon\Security,

    \Rise\ApiTestCase,

    \App\Fixture\User as UserFixture,
    \App\Models\User,
    \App\Tests\Api\TUserStab;

/**
 * Class UpdateTest
 * @package App\Tests\Api\User
 */
class UpdateTest extends ApiTestCase {

    use TUserStab;

    public function testMain() {
        /** @var User $userToUpdate */
        $userToUpdate = $this->getStub()->offsetGet(0);

        $userFixture = (new UserFixture())
            ->getArray('Update Test');

        $response = $this->put('/user/' . $userToUpdate->getId(), $userFixture);
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['name'], $userFixture['name']);
        $this->assertEquals($responsePayload['data']['email'], $userFixture['email']);

        /** @var User|boolean $userAfterUpdate */
        $userAfterUpdate = User::findFirstById($responsePayload['data']['id']);
        $this->assertNotFalse($userAfterUpdate);
        $this->assertEquals($userFixture['name'], $userAfterUpdate->getName());
        $this->assertEquals($userFixture['email'], $userAfterUpdate->getEmail());
        $isValidPassword = (new Security())
            ->checkHash($userFixture['password'], $userAfterUpdate->getPassword());
        $this->assertTrue($isValidPassword);
    }

    public function testPasswordNotChange() {
        /** @var User $userToUpdate */
        $userToUpdate = $this->getStub()->offsetGet(0);

        $userFixture = (new UserFixture())
            ->getArray('Update Test');
        unset($userFixture['password']);

        $response = $this->put('/user/' . $userToUpdate->getId(), $userFixture);
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['name'], $userFixture['name']);
        $this->assertEquals($responsePayload['data']['email'], $userFixture['email']);

        /** @var User|boolean $userAfterUpdate */
        $userAfterUpdate = User::findFirstById($responsePayload['data']['id']);
        $this->assertNotFalse($userAfterUpdate);
        $this->assertEquals($userFixture['name'], $userAfterUpdate->getName());
        $this->assertEquals($userFixture['email'], $userAfterUpdate->getEmail());
        $this->assertEquals($userToUpdate->getPassword(), $userAfterUpdate->getPassword());
    }

    public function testNotFound() {
        $notFoundId = User::getNextId();
        $response = $this->put('/user/' . $notFoundId);
        $responsePayload = $response->json();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals($responsePayload['data']['message'], 'User not found');
        $this->assertFalse($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
    }

    public function testInvalidEmail() {
        $userToUpdate = $this->getStub()->offsetGet(0);

        $userFixture = (new UserFixture())
            ->getArray('Update Test');

        $userFixture['email'] = 'invalid.email';

        $response = $this->put('/user/' . $userToUpdate->getId(), $userFixture);
        $responsePayload = $response->json();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertFalse($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['message'], 'Validation error');
        $this->assertEquals(
            $responsePayload['data']['errors'],
            [
                [
                    'field' => 'email',
                    'message' => 'The e-mail is not valid',
                    'type' => 'Email',
                ]
            ]
        );
    }

}