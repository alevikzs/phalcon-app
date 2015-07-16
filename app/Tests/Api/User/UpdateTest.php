<?php

namespace App\Tests\Api;

use \Phalcon\Security,

    \Rise\ApiTestCase,
    \Rise\Fixture\User as UserFixture,

    \App\Models\User;

/**
 * Class UpdateTest
 * @package App\Tests
 */
class UpdateTest extends ApiTestCase {

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
     * @return array
     */
    protected function createStub() {
        return (new UserFixture())
            ->getCollection();
    }

    public function testMain() {
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

}