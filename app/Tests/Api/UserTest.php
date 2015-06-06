<?php

namespace App\Tests\Api;

use \Phalcon\Mvc\Model\Resultset\Simple,

    \App\Rise\ApiTestCase,
    \App\Models\User;

/**
 * Class UserTest
 * @package App\Tests
 */
class UserTest extends ApiTestCase {

    protected function saveStub() {

    }

    protected function clearStub() {
        User::find()->delete();
    }

    /**
     * @return array
     */
    protected function createStub() {
        for ($index = 0; $index < 10; $index++) {
            $name = $this->getUniqueName('userName');
            yield [
                'name' => $name,
                'email' => $name . '@email.com'
            ];
        }
    }

    public function testCreate() {
        $id = User::getNextId();
        $name = $this->getUniqueName('userName');
        $data = [
            'name' => $name,
            'email' => $name . '@email.com'
        ];
        $response = $this->post('/user', $data);

        $this->assertEmptyStr($response->json());
        $this->assertEquals(200, $response->getStatusCode());

        /** @var User $user */
        $user = User::findFirst($id);
        $this->assertNotFalse($user);
        $this->assertEquals($data['name'], $user->getName());
        $this->assertEquals($data['email'], $user->getEmail());
    }

    public function testUpdate() {
        /** @var User $user */
        $user = User::findFirst();
        $newName = $this->getUniqueName('userName');
        $data = [
            'name' => $newName,
            'email' => $newName . '@email.com'
        ];
        $response = $this->put('/user/' . $user->getId(), $data);
        $this->assertEmptyStr($response->json());
        $this->assertEquals(200, $response->getStatusCode());

        /** @var User $user */
        $user = User::findFirst($user->getId());
        $this->assertNotFalse($user);
        $this->assertEquals($data['name'], $user->getName());
        $this->assertEquals($data['email'], $user->getEmail());
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