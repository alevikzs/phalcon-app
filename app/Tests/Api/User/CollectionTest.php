<?php

namespace App\Tests\Api;

use \Rise\ApiTestCase,
    \Rise\Fixture\User as UserFixture,

    \App\Models\User;

/**
 * Class CollectionTest
 * @package App\Tests
 */
class CollectionTest extends ApiTestCase {

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
        $users = array_map(
            function(User $user) {
                return $user->toArray();
            },
            $this->getStub()
        );

        $response = $this->post('/users', []);
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertEquals($responsePayload['data'], $users);
    }

}