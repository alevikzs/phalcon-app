<?php

namespace App\Tests\Api\User;

use \PhRest\ApiTestCase,
    \PhRest\RequestPayload\Collection\Order,

    \App\Models\User,
    \App\Tests\Api\TUserStab;

/**
 * Class CollectionTest
 * @package App\Tests\Api\User
 */
class CollectionTest extends ApiTestCase {

    use TUserStab;

    public function testDefault() {
        $users = [];
        /** @var User $user */
        foreach ($this->getStub() as $user) {
            $users[] = $user->toArray();
        }

        $response = $this->post('/users');
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertEquals($responsePayload['data'], $users);
        $this->assertEquals($responsePayload['meta']['total'], $this->getStub()->count());
        $this->assertEquals($responsePayload['meta']['page'], 1);
        $this->assertEquals($responsePayload['meta']['limit'], 20);
        $this->assertFalse($responsePayload['meta']['hasNext']);
    }

    public function testLimit() {
        $users = [];

        $requestPayload = [
            'limit' => 2,
        ];

        /** @var User $user */
        foreach ($this->getStub() as $index => $user) {
            if ($index < $requestPayload['limit']) {
                $users[] = $user->toArray();
            } else {
                break;
            }
        }

        $response = $this->post('/users', $requestPayload);
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertEquals($responsePayload['data'], $users);
        $this->assertEquals($responsePayload['meta']['total'], $this->getStub()->count());
        $this->assertEquals($responsePayload['meta']['page'], 1);
        $this->assertEquals($responsePayload['meta']['limit'], $requestPayload['limit']);
        $this->assertTrue($responsePayload['meta']['hasNext']);
    }

    public function testPage() {
        $users = [];

        $requestPayload = [
            'limit' => 2,
            'page' => 2,
        ];

        /** @var User $user */
        foreach ($this->getStub() as $index => $user) {
            if ($index >= $requestPayload['limit'] && $index < $requestPayload['limit'] * $requestPayload['page']) {
                $users[] = $user->toArray();
            }
        }

        $response = $this->post('/users', $requestPayload);
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertEquals($responsePayload['data'], $users);
        $this->assertEquals($responsePayload['meta']['total'], $this->getStub()->count());
        $this->assertEquals($responsePayload['meta']['page'], $requestPayload['page']);
        $this->assertEquals($responsePayload['meta']['limit'], $requestPayload['limit']);
        $this->assertTrue($responsePayload['meta']['hasNext']);
    }

    public function testOrder() {
        $users = [];

        $requestPayload = [
            'order' => [
                [
                    'field' => 'email',
                    'direction' => Order::ORDER_DIRECTION_ASC
                ],
                [
                    'field' => 'id',
                    'direction' => Order::ORDER_DIRECTION_DESC
                ]
            ]
        ];

        $this->getStub()->uasort(function(User $user1, User $user2) {
            if ($user1->getEmail() === $user2->getEmail()) {
                return ($user1->getId() < $user2->getId()) ? 1 : -1;
            }

            return ($user1->getEmail() < $user2->getEmail()) ? -1 : 1;
        });

        /** @var User $user */
        foreach ($this->getStub() as $index => $user) {
            $users[] = $user->toArray();
        }

        $response = $this->post('/users', $requestPayload);
        $responsePayload = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responsePayload['success']);
        $this->assertEquals($responsePayload['data'], $users);
        $this->assertEquals($responsePayload['meta']['total'], $this->getStub()->count());
        $this->assertEquals($responsePayload['meta']['page'], 1);
        $this->assertEquals($responsePayload['meta']['limit'], 20);
        $this->assertFalse($responsePayload['meta']['hasNext']);
    }

}