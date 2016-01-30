<?php

namespace App\Tests\Api\User;

use \Phalcon\Security,

    \PhRest\ApiTestCase,

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
            ->getArray('Create Test');

        $response = $this->post('/user', $userFixture);
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['name'], $userFixture['name']);
        $this->assertEquals($responsePayload['data']['email'], $userFixture['email']);

        /** @var boolean|User $createdUser */
        $createdUser = User::findFirstById($responsePayload['data']['id']);
        $this->assertNotFalse($createdUser);
        $this->assertEquals($userFixture['name'], $createdUser->getName());
        $this->assertEquals($userFixture['email'], $createdUser->getEmail());
        $isValidPassword = (new Security())
            ->checkHash($userFixture['password'], $createdUser->getPassword());
        $this->assertTrue($isValidPassword);
    }

    public function testValidationEmailRequired() {
        $userFixture = (new UserFixture())
            ->getArray('Create Test');

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
            ->getArray('Create Test');

        $userFixture['email'] = 'invalid.email';

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
            ->getArray('Create Test');

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
            ->getArray('Create Test');

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