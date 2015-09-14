<?php

namespace App\Tests\Api\User;

use \Phalcon\Security,

    \Rise\ApiTestCase,
    \Rise\Auth\Session,

    \App\Fixture\User as UserFixture,
    \App\Models\User,
    \App\Tests\Api\TUserStab;

/**
 * Class RegisterTest
 * @package App\Tests\Api\User
 */
class RegisterTest extends ApiTestCase {

    use TUserStab;

    public function testMain() {
        $userFixture = (new UserFixture())
            ->getArray('Register Test');

        $response = $this->post('/user/register', $userFixture);
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['user']['name'], $userFixture['name']);
        $this->assertEquals($responsePayload['data']['user']['email'], $userFixture['email']);

        $tokenPayload = (new Session())->decode($responsePayload['data']['token']);
        $this->assertEquals($tokenPayload->id, $responsePayload['data']['user']['id']);

        /** @var boolean|User $createdUser */
        $createdUser = User::findFirstById($responsePayload['data']['user']['id']);
        $this->assertNotFalse($createdUser);
        $this->assertEquals($userFixture['name'], $createdUser->getName());
        $this->assertEquals($userFixture['email'], $createdUser->getEmail());
        $isValidPassword = (new Security())
            ->checkHash($userFixture['password'], $createdUser->getPassword());
        $this->assertTrue($isValidPassword);
    }

    public function testValidationEmailRequired() {
        $userFixture = (new UserFixture())
            ->getArray('Register Test');

        unset($userFixture['email']);

        $response = $this->post('/user/register', $userFixture);
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
            ->getArray('Register Test');

        $userFixture['email'] = 'invalid.email';

        $response = $this->post('/user/register', $userFixture);
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
            ->getArray('Register Test');

        unset($userFixture['name']);

        $response = $this->post('/user/register', $userFixture);
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
            ->getArray('Register Test');

        unset($userFixture['password']);

        $response = $this->post('/user/register', $userFixture);
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