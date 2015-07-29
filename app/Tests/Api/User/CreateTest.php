<?php

namespace App\Tests\Api\User;

use \Phalcon\Security,

    \Rise\ApiTestCase,

    \App\Fixture\User as UserFixture,
    \App\Models\User,
    \App\Tests\Api\TUserStab;

/**
 * Class CreateTest
 * @package App\Tests\Api\User
 */
class CreateTest extends ApiTestCase {

    use TUserStab;

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

    public function testValidationEmailRequired() {
        $userFixture = (new UserFixture())
            ->getInstance('Create Test')
            ->toArray();

        unset($userFixture['email']);

        $response = $this->post('/user', $userFixture);
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
                    'message' => 'The e-mail is required',
                    'type' => 'PresenceOf',
                ],
                [
                    'field' => 'email',
                    'message' => 'The e-mail is not valid',
                    'type' => 'Email',
                ]
            ]
        );
    }

    public function testValidationEmailInvalid() {
        $userFixture = (new UserFixture())
            ->getInstance('Create Test')
            ->setEmail('invalid.email')
            ->toArray();

        $response = $this->post('/user', $userFixture);
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

    public function testValidationName() {
        $userFixture = (new UserFixture())
            ->getInstance('Create Test')
            ->toArray();

        unset($userFixture['name']);

        $response = $this->post('/user', $userFixture);
        $responsePayload = $response->json();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertFalse($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['message'], 'Validation error');
        $this->assertEquals(
            $responsePayload['data']['errors'],
            [
                [
                    'field' => 'name',
                    'message' => 'The name is required',
                    'type' => 'PresenceOf',
                ]
            ]
        );
    }

    public function testValidationPassword() {
        $userFixture = (new UserFixture())
            ->getInstance('Create Test')
            ->toArray();

        unset($userFixture['password']);

        $response = $this->post('/user', $userFixture);
        $responsePayload = $response->json();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertFalse($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['message'], 'Validation error');
        $this->assertEquals(
            $responsePayload['data']['errors'],
            [
                [
                    'field' => 'password',
                    'message' => 'The password is required',
                    'type' => 'PresenceOf',
                ]
            ]
        );
    }

}