<?php

namespace App\Tests\Api\User;

use \Rise\ApiTestCase,

    \App\Models\User;

/**
 * Class CollectionTest
 * @package App\Tests\Api\User
 */
class CollectionTest extends ApiTestCase {

    use TCommon;

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