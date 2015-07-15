<?php

namespace App\Tests\Api;

use \Generator,

    \Phalcon\Mvc\Model\Resultset\Simple,
    \Phalcon\Security,

    \Rise\ApiTestCase,
    \Rise\Fixture\User as UserFixture,

    \App\Models\User;

/**
 * Class UserTest
 * @package App\Tests
 */
class UserTest extends ApiTestCase {

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
     * @return Generator
     */
    protected function createStub() {
        return (new UserFixture())
            ->getCollection();
    }

    public function testCreate() {
        $userFixture = (new UserFixture())
            ->getInstance('Create', 'Test');

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

    public function testUpdate() {
        /** @var User $userToUpdate */
        $userToUpdate = User::findFirst();

        $userFixture = (new UserFixture())
            ->getArray('Update', 'Test');

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

    public function testView() {
        /** @var User $user */
        $user = User::findFirst();
        $response = $this->get('/user/' . $user->getId());
        $responseUser = $response->json();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($user->getId(), $responseUser['id']);
        $this->assertEquals($user->getName(), $responseUser['name']);
        $this->assertEquals($user->getEmail(), $responseUser['email']);
    }

    public function testCollection() {
        /** @var Simple $userQuery */
        $userQuery = User::find();
        $expected = [
            'list' => $userQuery->toArray(),
            'count' => $userQuery->count()
        ];
        $response = $this->get('/users');
        $this->assertEquals($expected, $response->json());
    }

    public function testDelete() {
        /** @var User $user */
        $user = User::findFirst();
        $response = $this->delete('/user/' . $user->getId());
        $this->assertEmptyStr($response->json());
        $this->assertEquals(200, $response->getStatusCode());

        /** @var User $user */
        $user = User::findFirst($user->getId());
        $this->assertFalse($user);
    }

}