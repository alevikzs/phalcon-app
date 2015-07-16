<?php

namespace App\Tests\Api;

use \Rise\ApiTestCase,
    \Rise\Fixture\User as UserFixture,

    \App\Models\User;

/**
 * Class ViewTest
 * @package App\Tests
 */
class ViewTest extends ApiTestCase {

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
        /** @var User $userToView */
        $userToView = User::findFirst();

        $response = $this->get('/user/' . $userToView->getId());
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertNull($responsePayload['meta']);
        $this->assertEquals($responsePayload['data']['id'], $userToView->getId());
        $this->assertEquals($responsePayload['data']['name'], $userToView->getName());
        $this->assertEquals($responsePayload['data']['email'], $userToView->getEmail());
    }

}